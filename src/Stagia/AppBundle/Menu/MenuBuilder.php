<?php

namespace Stagia\AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MenuBuilder
{
    private $factory;
    protected $container;
    
    /**
     * 
     * @param \Knp\Menu\FactoryInterface $factory
     * 
     */
    public function __construct(FactoryInterface $factory, ContainerInterface $container)
    {
        $this->factory = $factory;
        $this->container = $container;
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
        return $menu;
    }

}