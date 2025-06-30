<?php

namespace App\Form;

use App\Entity\Marques;
use App\Entity\Membres;
use App\Entity\Size;
use App\Entity\Type;
use App\Entity\Vaisseaux;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
        $marques = $this->em->getRepository(Marques::class)->findAll();
        $choicesmarques = [];
        foreach ($marques as $marque) {
            $choicesmarques[$marque->getNom()] = $marque->getIdMarque();
        }
        $sizes = $this->em->getRepository(Size::class)->findAll();
        $choicessizes = [];
        foreach ($sizes as $size) {
            $choicessizes[$size->getLibelle()] = $size->getSizeId();
        }
        $types = $this->em->getRepository(Type::class)->findAll();
        $choicestypes = [];
        foreach ($types as $type) {
            $choicestypes[$type->getLibelle()] = $type->getTypeId();
        }

        $builder
            ->add('nom')
            ->add('realeaseDate')
//            ->add('sizeCategory')
            ->add('sizeCategory',ChoiceType::class, [
                'choices' => $choicessizes,
                'label' => 'Taille',
                'placeholder' => 'Sélectionnez une taille',
            ])
            ->add('marque',ChoiceType::class, [
                'choices' => $choicesmarques,
                'label' => 'Marque',
                'placeholder' => 'Sélectionnez une marque',
            ])
            ->add('isReleased')
            ->add('height')
            ->add('width')
            ->add('length')
            ->add('SCU')
            ->add('type',ChoiceType::class, [
                'choices' => $choicestypes,
                'label' => 'Type',
                'placeholder' => 'Sélectionnez un type',
            ])
//            ->add('image')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vaisseaux::class,
        ]);
    }
}
