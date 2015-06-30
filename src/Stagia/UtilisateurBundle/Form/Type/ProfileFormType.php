<?php

namespace Stagia\UtilisateurBundle\Form\Type;

use Symfony\Component\Form\FormBuilder;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileFormType extends BaseType
{
    protected function buildUserForm(FormBuilderInterface $builder, array $options)

    {
        $builder
            ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
            ->add('adresse1', null, array('label' => 'Adresse: '))
            ->add('adresse2', null, array('label' => 'Complément d\'adresse: '))
            ->add('codepostal', null, array('label' => 'Code Postal:'))
            ->add('ville', null, array('label' => 'Ville:'))
            ->add('telephone', null, array('label' => 'Téléphone:'))
            ->add('roles', 'choice', array(
                'multiple' => false,
                'choices' => array(
                    'ROLE_MAITRE_APPRENTISSAGE' => 'Maitre d\'apprentissage',
                    'ROLE_RESPONSABLE' => 'Résponsable',
                    'ROLE_TUTEUR' => 'Tuteur',
                    'ROLE_ETUDIANT' => 'Etudiant',
                    //'ROLE_ADMIN' => 'Admin:',
                    //'ROLE_SUPER_ADMIN' => 'Super Admin:',
                ),
                'multiple' => true,
                'expanded' => true,
                'empty_value' => false,
            ));
    }

    public function getName()
    {
        return 'fos_user_profile_edit';
    }
}