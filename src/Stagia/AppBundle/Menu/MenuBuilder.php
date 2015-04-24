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
    	$menu = $this->factory->createItem('Stagia', array('uri' => '/'));
        return $menu;
    }

}