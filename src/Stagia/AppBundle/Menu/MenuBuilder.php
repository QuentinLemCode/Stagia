<?php

namespace Stagia\AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

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
    public function __construct(FactoryInterface $factory, ContainerInterface $container,SecurityContextInterface $securityContext)
    {
        $this->factory = $factory;
        $this->container = $container;
        $this->securityContext = $securityContext;
        $this->isLoggedIn = $this->securityContext->isGranted('IS_AUTHENTICATED_FULLY');


    }

    public function mainMenu()
    {
    	$menu = $this->factory->createItem('root', array(
            'navbar' => true,
            'pull-right' => true,
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
        if ($this->isLoggedIn) {
            $menu->addChild('Deconnexion', array(
                'icon' => 'compass',
                'route' => 'fos_user_security_logout'));
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