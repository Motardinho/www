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

            ->add('titre', 'text', array( 
                'attr'   =>  array(
                    'class'   => 'form-control'
                )
            ))

            ->add('auteur', 'text', array( 
                'attr'   =>  array(
                    'class'   => 'form-control')
            ))

            ->add('contenu', 'textarea', array(
                'required' => false,
                'attr'   =>  array(
                    'class'   => 'form-control')
            ))

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

                'multiple' => true,
                'attr'   =>  array(
                    'class'   => 'form-control')

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

