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
 * Category interface.
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
     * Set parent category.
     *
     * @param CategoryInterface $parent
     */
    public function setParent(CategoryInterface $parent = null);

    /**
     * Get parent category.
     */
    public function getParent();

    /**
     * Set left.
     *
     * @param integer $left
     */
    public function setLeft($left);

    /**
     * Get left.
     *
     * @return integer
     */
    public function getLeft();

    /**
     * Set right.
     *
     * @param integer $right
     */
    public function setRight($right);

    /**
     * Get right.
     *
     * @return integer
     */
    public function getRight();

    /**
     * Set level.
     *
     * @param integer $level
     */
    public function setLevel($level);

    /**
     * Get level.
     *
     * @return integer
     */
    public function getLevel();

    /**
     * Set root.
     *
     * @param integer $root
     */
    public function setRoot($root);

    /**
     * Get root.
     *
     * @var integer
     */
    public function getRoot();

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
     * Set createdAt.
     *
     * @param \Datetime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * Get createdAt.
     *
     * @return \Datetime
     */
    public function getCreatedAt();

    /**
     * Set updatedAt.
     *
     * @param \Datetime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt);

    /**
     * Get updatedAt.
     *
     * @return \Datetime
     */
    public function getUpdatedAt();

    /**
     * To string.
     *
     * @return string
     */
    public function __toString();
}
