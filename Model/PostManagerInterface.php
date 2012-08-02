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
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
interface PostManagerInterface
{
    public function findPosts();

    public function findPostBy(array $criteria);

    public function createPost();

    public function savePost(PostInterface $post);

    public function deletePost(PostInterface $post);

    public function getClass();
}
