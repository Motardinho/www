<?php

namespace Sdz\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', 'datetime')
            ->add('titre', 'text')
            ->add('auteur', 'text')
            ->add('contenu', 'textarea', array('required' => false))
            ->add('publication', 'checkbox', array('required' => false))
            ->add('image', new ImageType())
            // ->add('categories', 'collection', array(
            //     'type' => new CategorieType(),
            //     'allow_add' => true,
            //     'allow_delete' => true,
            //     'by_reference' => false
            // ))
            ->add('tags',  null,        array(
                'property' => 'nom',
                'multiple' => true
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sdz\BlogBundle\Entity\Article'
        ));
    }

    public function getName()
    {
        return 'sdz_blogbundle_articletype';
    }
}
