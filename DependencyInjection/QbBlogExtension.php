<?php

/*
 * This file is part of the QbBlogBundle package.
 *
 * (c) Quentin Berlemont <quentinberlemont@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Qb\Bundle\BlogBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * Loads and manages the bundle configuration.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class QbBlogExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load(sprintf('%s.xml', $config['storage']));
        $loader->load('form.xml');

        $this->remapParametersNamespaces($config, $container, array(
            '' => array(
                'storage'            => 'qb_blog.storage',
                'model_manager_name' => 'qb_blog.model_manager_name',
                'template_engine'    => 'qb_blog.template_engine',
            )
        ));

        $this->loadCategory($config['category'], $container);
        $this->loadComment($config['comment'], $container);
        $this->loadPost($config['post'], $container);
        $this->loadTag($config['tag'], $container);
    }

    /**
     * Loads `Category` configuration.
     *
     * @param array            $config
     * @param ContainerBuilder $container
     */
    private function loadCategory(array $config, ContainerBuilder $container)
    {
        $container->setAlias('qb_blog.category_manager', $config['category_manager']);
        $container->setAlias('qb_blog.category.form.handler', $config['form']['handler']);
        unset($config['form']['handler']);

        $this->remapParametersNamespaces($config, $container, array(
            '' => array(
                'category_class' => 'qb_blog.category.model.class',
            ),
            'form' => 'qb_blog.category.form.%s',
        ));
    }

    /**
     *
     * Loads `Comment` configuration.
     *
     * @param array            $config
     * @param ContainerBuilder $container
     */
    private function loadComment(array $config, ContainerBuilder $container)
    {
        $container->setAlias('qb_blog.comment_manager', $config['comment_manager']);
        $container->setAlias('qb_blog.comment.form.handler', $config['form']['handler']);
        unset($config['form']['handler']);

        $this->remapParametersNamespaces($config, $container, array(
            '' => array(
                'comment_class' => 'qb_blog.comment.model.class',
            ),
            'form' => 'qb_blog.comment.form.%s',
        ));
    }

    /**
     *
     * Loads `Post` configuration.
     *
     * @param array            $config
     * @param ContainerBuilder $container
     */
    private function loadPost(array $config, ContainerBuilder $container)
    {
        $container->setAlias('qb_blog.post_manager', $config['post_manager']);
        $container->setAlias('qb_blog.post.form.handler', $config['form']['handler']);
        unset($config['form']['handler']);

        $this->remapParametersNamespaces($config, $container, array(
            '' => array(
                'post_class' => 'qb_blog.post.model.class',
            ),
            'form' => 'qb_blog.post.form.%s',
        ));
    }

    /**
     *
     * Loads `Tag` configuration.
     *
     * @param array            $config
     * @param ContainerBuilder $container
     */
    private function loadTag(array $config, ContainerBuilder $container)
    {
        $container->setAlias('qb_blog.tag_manager', $config['tag_manager']);
        $container->setAlias('qb_blog.tag.form.handler', $config['form']['handler']);
        unset($config['form']['handler']);

        $this->remapParametersNamespaces($config, $container, array(
            '' => array(
                'tag_class' => 'qb_blog.tag.model.class',
            ),
            'form' => 'qb_blog.tag.form.%s',
        ));
    }

    /**
     * Remaps parameters.
     *
     * @param array            $config
     * @param ContainerBuilder $container
     * @param array            $map
     */
    protected function remapParameters(array $config, ContainerBuilder $container, array $map)
    {
        foreach ($map as $name => $paramName) {
            if (array_key_exists($name, $config)) {
                $container->setParameter($paramName, $config[$name]);
            }
        }
    }

    /**
     * Remaps parameters namespaces.
     *
     * @param array            $config
     * @param ContainerBuilder $container
     * @param array            $namespaces
     */
    protected function remapParametersNamespaces(array $config, ContainerBuilder $container, array $namespaces)
    {
        foreach ($namespaces as $ns => $map) {
            if ($ns) {
                if (!array_key_exists($ns, $config)) {
                    continue;
                }

                $namespaceConfig = $config[$ns];
            } else {
                $namespaceConfig = $config;
            }

            if (is_array($map)) {
                $this->remapParameters($namespaceConfig, $container, $map);
            } else {
                foreach ($namespaceConfig as $name => $value) {
                    $container->setParameter(sprintf($map, $name), $value);
                }
            }
        }
    }
}
