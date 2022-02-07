<?php


namespace WeAreBrave\BaseAdminBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

class WeAreBraveBaseAdminExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container)
    {

    }

    public function prepend(ContainerBuilder $container)
    {
        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);

        $twig_config = array(
            'globals' => array(
                'app_site_name' => $config['site_name'],
                'app_login_check' => $config['login_check'],
                'app_logout' => $config['logout'],
                'app_admin_home' => $config['admin_home']
            )
        );

        $container->prependExtensionConfig('twig', $twig_config);
    }
}
