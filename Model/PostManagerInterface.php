<?php

/*
 * This file is part of the QbBlogBundle package.
 *
 * (c) Quentin Berlemont <quentinberlemont@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Qb\Bundle\BlogBundle\Model;

/**
 * Post Manager.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
interface PostManagerInterface
{
    /**
     * Finds all posts instances.
     *
     * @return \Traversable
     */
    public function findPosts();

    /**
     * Finds a post by the given criteria.
     *
     * @param  array             $criteria
     * @return PostInterface
     */
    public function findPostBy(array $criteria);

    /**
     * Returns an empty instance of the post.
     *
     * @return PostInterface
     */
    public function createPost();

    /**
     * Saves a post.
     *
     * @param PostInterface $post
     */
    public function savePost(PostInterface $post);

    /**
     * Deletes a post.
     *
     * @param PostInterface $post
     */
    public function deletePost(PostInterface $post);

    /**
     * Get fully-qualified class name of the post.
     *
     * @return string
     */
    public function getClass();
}
