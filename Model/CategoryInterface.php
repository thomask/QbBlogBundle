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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Category model.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
interface CategoryInterface
{
    /**
     * Get id.
     *
     * @return integer
     */
    public function getId();

    /**
     * Set name.
     *
     * @param string $name
     */
    public function setName($name);

    /**
     * Get name.
     *
     * @return string
     */
    public function getName();

    /**
     * Set slug.
     *
     * @param string $slug
     */
    public function setSlug($slug);

    /**
     * Get slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Set created.
     *
     * @param \Datetime $created
     */
    public function setCreated(\DateTime $created);

    /**
     * Get created.
     *
     * @return \Datetime
     */
    public function getCreated();

    /**
     * Set updated.
     *
     * @param \Datetime $updated
     */
    public function setUpdated(\DateTime $updated);

    /**
     * Get updated.
     *
     * @return \Datetime
     */
    public function getUpdated();

    /**
     * Set parent category.
     *
     * @param CategoryInterface $parent
     */
    public function setParent(CategoryInterface $parent);

    /**
     * Get parent category.
     */
    public function getParent();

    /**
     * Add post.
     *
     * @param PostInterface $post
     */
    public function addPost(PostInterface $post);

    /**
     * Remove post.
     *
     * @param PostInterface $post
     */
    public function removePost(PostInterface $post);

    /**
     * Get posts.
     *
     * @return Collection
     */
    public function getPosts();

    /**
     * To string.
     *
     * @return string
     */
    public function __toString();
}
