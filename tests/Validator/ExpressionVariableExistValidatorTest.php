<?php

namespace App\Tests\Validator;

use App\Validator\ExpressionVariableExists;
use App\Validator\ExpressionVariableExistsValidator;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilderInterface;

class ExpressionVariableExistValidatorTest extends TestCase
{
    public function testValid()
    {
        $constraint = new ExpressionVariableExists();
        $this->getValidator(false, ['$MA_VARIABLE'])->validate('$MA_VARIABLE', $constraint);
    }

    public function testInvalid()
    {
        $constraint = new ExpressionVariableExists();
        $this->getValidator(true, [])->validate('$MA_VARIABLE', $constraint);
    }

    private function getValidator($expectedViolation = false, $dbVariables = [])
    {
        $repository = $this->createMock(ObjectRepository::class);
        $repository->expects($this->any())
            ->method('findOneBy')
            ->willReturn($dbVariables);

        $objectManager = $this->createMock(EntityManagerInterface::class);
        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($repository);

        $validator = new ExpressionVariableExistsValidator($objectManager);
        $context = $this->getContext($expectedViolation);
        $validator->initialize($context);

        return $validator;
    }

    /**
     * @return ExecutionContextInterface
     **/
    private function getContext(bool $expectedViolation)
    {
        $context = $this->getMockBuilder(ExecutionContextInterface::class)->getMock();

        if ($expectedViolation) {
            $violation = $this->getMockBuilder(ConstraintViolationBuilderInterface::class)->getMock();
            $violation->expects($this->any())->method('setParameter')->willReturn($violation);
            $violation->expects($this->once())->method('addViolation');
            $context
                ->expects($this->once())
                ->method('buildViolation')
                ->willReturn($violation);
        } else {
            $context
                ->expects($this->never())
                ->method('buildViolation');
        }
        return $context;
    }

}
