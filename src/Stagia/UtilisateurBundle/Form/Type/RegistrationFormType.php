<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Stagia\UtilisateurBundle\Form\Type;

use Symfony\Component\Form\FormBuilder;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, array('label' => 'Nom: '))
            ->add('prenom', null, array('label' => 'Prénom: '))
            ->add('role', null, array('label' => 'Role'))
            ->add('rue', null, array('label' => 'Rue: '))
            ->add('adresse1', null, array('label' => 'Adresse-1: '))
            ->add('adresse2', null, array('label' => 'Adresse-2: '))
            ->add('codepostal', null, array('label' => 'Code Postale:'))
            ->add('ville', null, array('label' => 'Ville:'))
            ->add('telephone', null, array('label' => 'Téléphone:'));
        parent::buildForm($builder, $options);
    }

    public function getName()
    {
        return 'stagia_user_registration';
    }
}