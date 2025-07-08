<?php

namespace App\Form;

use App\Entity\Marques;
use App\Entity\Membres;
use App\Entity\Size;
use App\Entity\Type;
use App\Entity\Vaisseaux;
use Doctrine\DBAL\Types\StringType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VaisseauTypeForm extends AbstractType
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('nom')
            ->add('realeaseDate')
            ->add('sizeCategory',EntityType::class, [
                'class' => Size::class,
                'label' => 'Taille',
                'choice_label' => 'libelle',
                'placeholder' => 'Sélectionnez une taille',

            ])

            ->add('marque',EntityType::class, [
                'class' => Marques::class,
                'label' => 'Marque',
                'choice_label' => 'nom',
                'placeholder' => 'Sélectionnez une marque',
            ])
            ->add('isReleased')
            ->add('height', NumberType::class, [
                'required' => false,
                'invalid_message' => 'Veuillez entrer un nombre',
            ])
            ->add('width', NumberType::class, [
                'required' => false,
                'invalid_message' => 'Veuillez entrer un nombre',
            ])
            ->add('length', NumberType::class, [
                'required' => false,
                'invalid_message' => 'Veuillez entrer un nombre',
            ])
            ->add('SCU')
            ->add('type',EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'libelle',
                'label' => 'Type',
                'placeholder' => 'Sélectionnez un type',
            ])
            ->add('image', TextType::class, [
                'required' => false,
            ])
            ->add('poster', TextType::class, [
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vaisseaux::class,
        ]);
    }
}
