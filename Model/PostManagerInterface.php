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
 * Post Manager interface.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
interface PostManagerInterface
{
    /**
     * Creates a new post.
     *
     * @return PostInterface
     */
    public function createPost();

    /**
     * Finds all posts.
     *
     * @return \Traversable
     */
    public function findPosts();

    /**
     * Finds a post by id.
     *
     * @param integer $id
     */
    public function findPost($id);

    /**
     * Finds a post by criteria.
     *
     * @param  array         $criteria
     * @return PostInterface
     */
    public function findPostBy(array $criteria);

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
}
