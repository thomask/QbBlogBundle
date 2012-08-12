<?php

/*
 * This file is part of the QbBlogBundle package.
 *
 * (c) Quentin Berlemont <quentinberlemont@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Qb\Bundle\BlogBundle\Entity;

use Qb\Bundle\BlogBundle\Model\AbstractComment;
use Qb\Bundle\BlogBundle\Model\PostInterface;

/**
 * Comment entity.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class Comment extends AbstractComment
{
    /**
     * @var PostInterface
     */
    protected $post;

    /**
     * Set post.
     *
     * @param PostInterface $post
     */
    public function setPost(PostInterface $post)
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
