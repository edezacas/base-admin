<?php


namespace WeAreBrave\BaseAdminBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('we_are_brave_base_admin');

        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('site_name')->isRequired()->end()
                ->scalarNode('login_check')->isRequired()->end()
                ->scalarNode('logout')->isRequired()->end()
                ->scalarNode('admin_home')->isRequired()->end()
            ->end()
        ->end();

        return $treeBuilder;
    }

}
