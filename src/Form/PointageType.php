<?php

namespace App\Form;

use App\Entity\Chantiers;
use App\Entity\Pointages;
use App\Entity\Utilisateur;
use App\Repository\ChantiersRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PointageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'format' => 'yyyy-MM-dd',
            ])
            ->add('duree', IntegerType::class)
            ->add('utilisateur', EntityType::class, [
                'class' => Utilisateur::class,
                'query_builder' => function (UtilisateurRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.nom');
                },
                'choice_label' => 'nom',
            ])
            ->add('chantier', EntityType::class, [
                'class' => Chantiers::class,
                'query_builder' => function (ChantiersRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.id');
                },
                'choice_label' => 'nom',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pointages::class,
        ]);
    }
}
