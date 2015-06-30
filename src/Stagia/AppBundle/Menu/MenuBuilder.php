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
        $stage = $menu->addChild('Stages', array(
            'icon' => 'bolt',
            'route' => 'stage',
            ));
        $this->submenu($stage, 'stage');
        
        $memoire = $menu->addChild('Mémoires', array(
            'icon' => 'book',
            'route' => 'memoire',
        ));
        $this->submenu($memoire, 'memoire');
        
        $sujet = $menu->addChild('Sujets de mémoires', array(
            'icon' => 'compass',
            'route' => 'sujet'
        ));
        $this->submenu($sujet, 'sujet');
        
        return $menu;
    }
    
    private function submenu($root, $type)
    {
        $root->setDisplayChildren(false);
        $id = $this->container->get('request')->get('id');
        if (empty($id))
        {
            $id = 0;
        }
        $root->addChild('Afficher', array('route' => $type.'_show', 'routeParameters' => array('id' => $id)));
        $root->addChild('Nouveau', array('route' => $type.'_new'));
        $root->addChild('Creer', array('route' => $type.'_create', 'routeParameters' => array('id' => $id)));
        $root->addChild('Modifier', array('route' => $type.'_edit', 'routeParameters' => array('id' => $id)));
        $root->addChild('Mise A Jour', array('route' => $type.'_update', 'routeParameters' => array('id' => $id)));
        $root->addChild('Supprimer', array('route' => $type.'_delete', 'routeParameters' => array('id' => $id)));
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