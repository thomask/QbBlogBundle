<?php

/*
 * This file is part of the QbBlogBundle package.
 *
 * (c) Quentin Berlemont <quentinberlemont@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Qb\Bundle\BlogBundle\Event;

use Qb\Bundle\BlogBundle\Model\PostInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Filter Post Event.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class FilterPostEvent extends Event
{
    /**
     * @var PostInterface
     */
    protected $post;

    /**
     * Constructor.
     *
     * @param PostInterface $post
     */
    public function __construct(PostInterface $post)
    {
        $this->post = $post;
    }

    /**
     * Get post.
     *
     * @return PostInterface
     */
    public function getPost()
    {
        return $this->post;
    }
}