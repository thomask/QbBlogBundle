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

use Qb\Bundle\BlogBundle\QbBlogBundle;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('qb_blog');

        $rootNode
            ->children()
                ->scalarNode('db_driver')
                    ->validate()
                        ->ifNotInArray(QbBlogBundle::getSupportedDrivers())
                        ->thenInvalid('The driver %s is not supported. Please choose one of '.json_encode(QbBlogBundle::getSupportedDrivers()))
                    ->end()
                    ->cannotBeOverwritten()
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('model_manager_name')->defaultNull()->end()
            ->end();

        $this->addCategorySection($rootNode);
        $this->addCommentSection($rootNode);
        $this->addPostSection($rootNode);
        $this->addTagSection($rootNode);

        return $treeBuilder;
    }

    private function addCategorySection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('category')
                    ->children()
                        ->scalarNode('category_class')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('category_manager')->defaultValue('qb_blog.category_manager.default')->end()
                        ->arrayNode('form')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('type')->defaultValue('qb_blog_category')->end()
                                ->scalarNode('handler')->defaultValue('qb_blog.category.form.handler.default')->end()
                                ->scalarNode('name')->defaultValue('qb_blog_category_form')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    private function addCommentSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('comment')
                    ->children()
                        ->scalarNode('comment_class')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('comment_manager')->defaultValue('qb_blog.comment_manager.default')->end()
                        ->arrayNode('form')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('type')->defaultValue('qb_blog_comment')->end()
                                ->scalarNode('handler')->defaultValue('qb_blog.comment.form.handler.default')->end()
                                ->scalarNode('name')->defaultValue('qb_blog_comment_form')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    private function addPostSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('post')
                    ->children()
                        ->scalarNode('post_class')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('post_manager')->defaultValue('qb_blog.post_manager.default')->end()
                        ->arrayNode('form')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('type')->defaultValue('qb_blog_post')->end()
                                ->scalarNode('handler')->defaultValue('qb_blog.post.form.handler.default')->end()
                                ->scalarNode('name')->defaultValue('qb_blog_post_form')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    private function addTagSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('tag')
                    ->children()
                        ->scalarNode('tag_class')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('tag_manager')->defaultValue('qb_blog.tag_manager.default')->end()
                        ->arrayNode('form')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('type')->defaultValue('qb_blog_tag')->end()
                                ->scalarNode('handler')->defaultValue('qb_blog.tag.form.handler.default')->end()
                                ->scalarNode('name')->defaultValue('qb_blog_tag_form')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
