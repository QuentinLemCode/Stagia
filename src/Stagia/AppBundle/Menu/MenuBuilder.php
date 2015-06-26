<?php

namespace Stagia\AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MenuBuilder
{
    private $factory;
    protected $container;
    protected $isLoggedIn;
    protected $securityContext;


    /**
     * 
     * @param \Knp\Menu\FactoryInterface $factory
     * 
     */
    public function __construct(FactoryInterface $factory, ContainerInterface $container)
    {
        $this->factory = $factory;
        $this->container = $container;
        $this->securityContext = $this->container->get('security.context');
        $this->isLoggedIn = $this->securityContext->isGranted('IS_AUTHENTICATED_FULLY');


    }

    public function mainMenu()
    {
    	$menu = $this->factory->createItem('root', array(
            'navbar' => true
            ));
        $menu->addChild('Stages', array(
            'icon' => 'bolt',
            'route' => 'stage',
            ));
        $menu->addChild('Mémoires', array(
            'icon' => 'book',
            'route' => 'memoire',
        ));
        $menu->addChild('Sujets de mémoire', array(
            'icon' => 'compass',
            'route' => 'sujet'
        ));
        
        return $menu;
    }
    
    public function userMenu()
    {
        $menu = $this->factory->createItem('user', array(
            'navbar' => true,
            'pull-right' => true
        ));
        if ($this->isLoggedIn) {
            $menuUtilisateur = $menu->addChild(
                $this->securityContext->getToken()->getUser(), array(
                    'dropdown' => true,
                    'caret' => true,
                    'pull-right' => true,
                    'icon' => 'user'
                ));
            $menuUtilisateur->addChild('Mon compte', array('route' => 'fos_user_profile_show'));
            $menuUtilisateur->addChild('Déconnexion', array('route' => 'fos_user_security_logout'));
                    
        } else {
            $menu->addChild('Connexion', array(
                'icon' => 'user',
                'route' => 'fos_user_security_login'));
            $menu->addChild('Inscription', array(
                'icon' => 'plus',
                'route' => 'fos_user_registration_register'));
        }
        return $menu;
    }

}