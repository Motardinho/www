<?php

namespace Setec\SalarieBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('nom')
            ->add('prenom')
            ->add('trigramme')
            ->add('matricule');
    }

    public function getName()
    {
        return 'setec_salarie_registration';
    }
}