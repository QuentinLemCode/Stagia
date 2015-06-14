<?php

namespace Stagia\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description', null, array(
                'label' => 'Description du stage'
            ))
            ->add('date_debut', null, array(
                'widget' => 'single_text',
                'datepicker' => true,
                'attr' => array(
                    'class'       => 'col-md-4',
                    'placeholder' => ''
            )
            ))
            ->add('date_fin', null, array(
                'widget' => 'single_text',
                'datepicker' => true,
                'attr' => array(
                    'class'       => 'col-md-4',
                    'placeholder' => ''
            )
            ))
            ->add('competences')
            ->add('lieu')
            ->add('remuneration')
            ->add('conventionDeStage', 'choice', array(
                'choices' => array(true => 'Oui', false => 'Non'),
                'label' => 'Convention de stage obligatoire ?'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Stagia\AppBundle\Entity\Stage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'stagia_appbundle_stage';
    }
}
