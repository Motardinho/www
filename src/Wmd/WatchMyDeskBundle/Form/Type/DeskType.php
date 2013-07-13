<?php

namespace Wmd\WatchMyDeskBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Wmd\WatchMyDeskBundle\Form\Type\DeskPictureType;

class DeskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', "text", array('attr' => array('class' => 'span6')))
            ->add('summary', "textarea", array('attr' => array('rows' => '3', "class" => "span6")))
            ->add('description', "textarea", array('attr' => array('rows' => '10', "class" => "span6")));
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Wmd\WatchMyDeskBundle\Entity\Desk',
        );
    }

    public function getName()
    {
        return 'Desk';
    }
}