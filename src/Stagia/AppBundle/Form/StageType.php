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
            ->add('competences', new CompetenceType())
            /*->add('competences', 'collection', array(
                'type' => new CompetenceType(),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'widget_add_btn' => array('label' => 'Ajouter'),
                'show_legend' => false,
                'by_reference' => false,
                'label' => 'Compétences demandés',
                'horizontal_wrap_children' => true,
                'options' => array(
                    'label_render' => false,
                    'widget_addon_prepend' => array(
                        'text' => '@',
                    ),
                    'widget_remove_btn' => array(
                        'label' => "Supprimer",
                        'horizontal_wrapper_div' => array(
                            'class' => "col-lg-4"
                        ),
                        'wrapper_div' => false,
                    ),
                    'horizontal' => true,
                    'horizontal_label_offset_class' => "",
                    'horizontal_input_wrapper_class' => "col-lg-8",
                )
            ))*/
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
