<?php


namespace WeAreBrave\BaseAdminBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class WeAreBraveBaseAdminExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.xml');
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
            ),
            'form_themes' => ['bootstrap_5_layout.html.twig']
        );

        $container->prependExtensionConfig('twig', $twig_config);
    }
}
