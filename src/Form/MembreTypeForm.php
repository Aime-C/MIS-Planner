<?php

namespace App\Form;

use App\Entity\Membres;
use App\Entity\Rank;
use App\Repository\MembresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;


class MembreTypeForm extends AbstractType
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($options['old']) {
            $membres = $this->em->getRepository(Membres::class)->getAllInactif();

            $choices = [];
            foreach ($membres as $membre) {
                $choices[$membre->getPseudo()] = $membre->getId();
            }

            $builder
                ->add('id', ChoiceType::class, [
                    'choices' => $choices,
                    'label' => 'Membre',
                    'placeholder' => 'Sélectionnez un membre',
                ]);
        } else {
            $ranks = $this->em->getRepository(Rank::class)->findAll();

            $choices = [];
            foreach ($ranks as $rank) {
                $choices[$rank->getLibelle()] = $rank->getHierachie();
            }

            $builder
                ->add('pseudo', TextType::class)
                ->add('nom', TextType::class)
                ->add('rank_id', ChoiceType::class, [
                    'choices' => $choices,
                    'label' => 'Rang',
                    'placeholder' => 'Sélectionnez un rang',
                ])
                ->add('joinDate');
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Membres::class,
            'old' => false,
        ]);
    }
}
