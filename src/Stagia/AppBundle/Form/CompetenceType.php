<?php

namespace Stagia\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Stagia\AppBundle\Form\DataTransformer\CompetenceTranformer;

class CompetenceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new CompetenceTranformer());
    }
    
    public function getParent()
    {
        return 'text';
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'stagia_appbundle_competence';
    }
}
