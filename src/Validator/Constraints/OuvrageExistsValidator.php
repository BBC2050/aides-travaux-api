<?php

namespace App\Validator\Constraints;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use App\Entity\Ouvrage;

class OuvrageExistsValidator extends ConstraintValidator
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof OuvrageExists) {
            throw new UnexpectedTypeException($constraint, OuvrageExists::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        $entity = $this->em->getRepository(Ouvrage::class)->find($value);

        if (!$entity) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
