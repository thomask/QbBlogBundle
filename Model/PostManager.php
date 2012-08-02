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
abstract class PostManager implements PostManagerInterface
{
    /**
     * {@inheritdoc}
     */
    public function createPost()
    {
        $class = $this->getClass();
        $post = new $class;

        return $post;
    }
}
