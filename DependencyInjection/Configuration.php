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
 * Validates and merges configuration from the app/config files.
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
                        ->ifNotInArray(QbBlogBundle::getSupportedStorage())
                        ->thenInvalid('The driver %s is not supported. Please choose one of '.json_encode(QbBlogBundle::getSupportedStorage()))
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

    /**
     * Adds `Category` section.
     *
     * @param ArrayNodeDefinition $node
     */
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

    /**
     * Adds `Comment` section.
     *
     * @param ArrayNodeDefinition $node
     */
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

    /**
     * Adds `Post` section.
     *
     * @param ArrayNodeDefinition $node
     */
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

    /**
     * Adds `Tag` section.
     *
     * @param ArrayNodeDefinition $node
     */
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
