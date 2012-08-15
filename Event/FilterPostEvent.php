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

/**
 * Filter post event.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class FilterPostEvent
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
        $this->post;
    }
}