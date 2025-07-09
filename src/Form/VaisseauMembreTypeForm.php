<?php

namespace App\Form;

use App\Entity\Membres;
use App\Entity\Rank;
use App\Entity\Type;
use App\Entity\Vaisseaux;
use App\Entity\VaisseauxMembres;
use App\Repository\MembresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VaisseauMembreTypeForm extends AbstractType
{
    private EntityManagerInterface $em;

    private MembresRepository $membresRepository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('membre',EntityType::class, [
                        'class' => Membres::class,
                        'choice_label' => 'pseudo',
                        'label' => 'Membre',
                        'placeholder' => 'Sélectionnez un membre',
                    ])
            ->add('vaisseau',EntityType::class, [
                        'class' => Vaisseaux::class,
                        'choice_label' => 'nom',
                        'label' => 'Vaisseau',
                        'placeholder' => 'Sélectionnez un vaisseau',
                    ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VaisseauxMembres::class,
        ]);
    }
}
