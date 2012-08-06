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
 * Abstract Comment Manager implementation.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
abstract class CommentManager implements CommentManagerInterface
{
    /**
     * {@inheritdoc}
     */
    public function createComment()
    {
        $class = $this->getClass();

        return new $class;
    }
}