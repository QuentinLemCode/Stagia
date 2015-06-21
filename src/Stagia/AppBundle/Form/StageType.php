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
            ->add('titre', null, array(
                'label' => 'Titre du stage '
            ))
            ->add('description', null, array(
                'label' => 'Description du stage '
            ))
            ->add('date_debut', null, array(
                'label' => 'Date de début de stage ',
                'widget' => 'single_text',
                'datepicker' => true,
                'attr' => array(
                    'class'       => 'col-md-4',
                    'placeholder' => ''
            )
            ))
            ->add('date_fin', null, array(
                'label' => 'Date de fin de stage ',
                'widget' => 'single_text',
                'datepicker' => true,
                'attr' => array(
                    'class'       => 'col-md-4',
                    'placeholder' => ''
            )
            ))
            ->add('competences', null, array(
                'label' => 'Compétences demandées '
            ))
            ->add('lieu', null, array(
                'label' => 'Adresse du stage (facultatif) '
            ))
            ->add('remuneration', null, array(
                'label' => 'Rémuneration (facultatif) ',
                'widget_addon_append' => array(
                    'text' => '€'
                )
            ))
            ->add('conventionDeStage', 'choice', array(
                'choices' => array(true => 'Oui', false => 'Non'),
                'expanded' => true,
                'required' => true,
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
