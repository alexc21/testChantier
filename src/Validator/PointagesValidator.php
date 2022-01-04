<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use App\Repository\PointagesRepository;
use Symfony\Component\Form\Extension\Core\Type\WeekType;

class PointagesValidator extends ConstraintValidator
{
    private $pointagesRepository;

    public function __construct(PointagesRepository $pointagesRepository)
    {
        $this->pointagesRepository = $pointagesRepository;
    }

    public function validate($protocol, Constraint $constraint){

        

        $existPointage = $this->pointagesRepository->findOneBy([
            'date'       => $protocol->getDate(),
            'utilisateur'=> $protocol->getUtilisateur(),
            'chantier'   => $protocol->getChantier(),
 
        ]);
 
 
        /*if ($value->getFoo() != $value->getBar()) {
         $this->context->buildViolation($constraint->message)
             ->atPath('foo')
             ->addViolation();
             ->select('sum(phs.duree)as dureeTotalPointage')
            ->select('week(date) as semaine')
        }*/

        if($existPointage)
        {
            $this->context->buildViolation($constraint->message)
            ->setParameter('votre utilisateur a deja pointer sur ce chantier aujourd\'hui', $protocol->getUtilisateur()->getNom())
            ->addViolation();        
        }

        $nombreHeureSemaine = $this->pointagesRepository->pointagesHeureSemaine( $protocol->getUtilisateur());
        
        var_dump($nombreHeureSemaine);
        
        
        if($nombreHeureSemaine['date'] === date_format($protocol->getDate(), 'w') && $nombreHeureSemaine['dureeTotalPointage'] + $protocol->getDuree() > 35   )
        {
            $this->context->buildViolation($constraint->message)
            ->setParameter('votre utilisateur a deja atteint ces 35 heures', $protocol->getUtilisateur()->getNom())
            ->addViolation();
        }

    }
}
