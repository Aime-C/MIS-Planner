<?php

namespace App\Form;

use App\Entity\Membres;
use App\Entity\Rank;
use App\Entity\Vaisseaux;
use App\Entity\VaisseauxMembres;
use App\Repository\MembresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VaisseauMembreTypeForm extends AbstractType
{
    private EntityManagerInterface $em;

    private MembresRepository $membresRepository;

    public function __construct(EntityManagerInterface $em, MembresRepository $membresRepository)
    {
        $this->em = $em;
        $this->membresRepository = $membresRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $membres = $this->membresRepository->getAllActif();
        $vaisseaux = $this->em->getRepository(Vaisseaux::class)->findBy([], ['nom' => 'ASC']);

        $choicesMembres = [];
        $choicesvaisseaux = [];
        foreach ($membres as $membre) {
            $choicesMembres[$membre->getPseudo()] = $membre->getId();
        }
        foreach ($vaisseaux as $vaisseau) {
            $choicesvaisseaux[$vaisseau->getNom()] = $vaisseau->getId();
        }
        $builder
            ->add('membre_id',ChoiceType::class, [
                        'choices' => $choicesMembres,
                        'label' => 'Membre',
                        'placeholder' => 'Sélectionnez un membre',
                    ])
            ->add('vaisseau_id',ChoiceType::class, [
                        'choices' => $choicesvaisseaux,
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
