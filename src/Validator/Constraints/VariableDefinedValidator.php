<?php

namespace App\Validator\Constraints;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use App\Model\Ouvrage;

class VariableDefinedValidator extends ConstraintValidator
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function validate($protocol, Constraint $constraint)
    {
        if (!$constraint instanceof VariableDefined) {
            throw new UnexpectedTypeException($constraint, VariableDefined::class);
        }
        if (!$protocol instanceof Ouvrage) {
            return;
        }

        $variables = $this->em->getRepository(\App\Entity\Variable::class)->findByAidesAndOuvrage(
            $protocol->getId(), $protocol->getSimulation()->getAides()->map(function($aide) {
                return $aide->getId();
            })->getValues()
        );

        foreach ($variables as $variable) {
            $getter = \App\Utils\VariableToMethodTransformer::transform(
                $variable->getNom()
            );
            $property = \lcfirst(\str_replace('get', '', $getter));
            if ($protocol->$getter() === null || $protocol->$getter() === '') {
                $this->context->buildViolation($constraint->message)
                    ->atPath($property)
                    ->setParameter('{{ name }}', $property)
                    ->addViolation();
                return;
            }
        }
    }
}
