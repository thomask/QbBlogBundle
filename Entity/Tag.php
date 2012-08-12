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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Qb\Bundle\BlogBundle\Model\AbstractTag;
use Qb\Bundle\BlogBundle\Model\PostInterface;

/**
 * Tag entity.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class Tag extends AbstractTag
{
    /**
     * @var Collection
     */
    protected $posts;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * Add post.
     *
     * @param PostInterface $post
     */
    public function addPost(PostInterface $post)
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
        }
    }

    /**
     * Remove post.
     *
     * @param PostInterface $post
     */
    public function removePost(PostInterface $post)
    {
        if ($this->posts->contains($post)) {
            $this->posts->removeElement($post);
        }
    }

    /**
     * Get posts.
     *
     * @return Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
