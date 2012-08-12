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
use Qb\Bundle\BlogBundle\Model\AbstractCategory;
use Qb\Bundle\BlogBundle\Model\CategoryInterface;
use Qb\Bundle\BlogBundle\Model\PostInterface;

/**
 * Category entity.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class Category extends AbstractCategory
{
    /**
     * @var Collection
     */
    protected $children;

    /**
     * @var Collection
     */
    protected $posts;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->posts    = new ArrayCollection();
    }

    /**
     * Add child category.
     *
     * @param CategoryInterface $child
     */
    public function addChild(CategoryInterface $child)
    {
        if (!$this->children->contains($child)) {
            $this->children->add($child);
        }
    }

    /**
     * Remove child category.
     *
     * @param CategoryInterface $child
     */
    public function removeChild(CategoryInterface $child)
    {
        if ($this->children->contains($child)) {
            $this->children->removeElement($child);
        }
    }

    /**
     * Get children categories.
     *
     * @return Collection
     */
    public function getChildren()
    {
        return $this->children;
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
