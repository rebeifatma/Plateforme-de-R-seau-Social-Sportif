<?php

namespace App\Form;

// src/Form/PratiqueType.php

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Sport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class PratiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sport', EntityType::class, [
                'class' => Sport::class,
                'choice_label' => 'nomSport',
                'placeholder' => 'Choose a sport',
                'required' => false, // This allows the field to be empty
            ])
            ->add('new_sport', TextType::class, [
                'mapped' => false, // This field is not mapped to the Pratique entity
                'required' => false, // This allows the field to be empty
            ])
            ->add('niveau')
            ->add('save', SubmitType::class, ['label' => 'Add Practice']);

        // Add a listener for the form submission event
        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                // Implement logic to handle the new sport creation
            }
        );
    }

    // ... rest of the class
}
