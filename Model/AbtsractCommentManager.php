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
 * Abstract Comment Manager.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
abstract class AbtsractCommentManager implements CommentManagerInterface
{
    /**
     * Comment class.
     *
     * @var string $class
     */
    protected $class;

    /**
     * Constructor.
     *
     * @param string $class
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function createComment()
    {
        $class = $this->class;

        return new $class;
    }
}
