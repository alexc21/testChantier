<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PointageValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /**
         * @var $constraintPoint \App\Validator\Pointage 
        */


        // TODO: implement the validation here
        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }

    public function validPointageHeureSemaine( Constraint $constraint)
    {
        

       

    }
    public function validPointageJourChantier(Constraint $constraint)
    {

    }
}
