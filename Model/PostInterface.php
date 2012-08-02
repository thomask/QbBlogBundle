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

/**
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
interface PostInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set category
     *
     * @param CategoryInterface $category
     */
    public function setCategory(CategoryInterface $category = null);

    /**
     * Get category
     *
     * @return CategoryInterface
     */
    public function getCategory();

    /**
     * Set author
     *
     * @param string $author
     */
    public function setAuthor($author);

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor();

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title);

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug);

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug();

    /**
     * Set body
     *
     * @param text $body
     */
    public function setBody($body);

    /**
     * Get body
     *
     * @return text
     */
    public function getBody();

    /**
     * Set created
     *
     * @param datetime $created
     */
    public function setCreated($created);

    /**
     * Get created
     *
     * @return datetime
     */
    public function getCreated();

    /**
     * Set updated
     *
     * @param datetime $updated
     */
    public function setUpdated($updated);

    /**
     * Get updated
     *
     * @return datetime
     */
    public function getUpdated();

    /**
     * Add tag
     *
     * @param TagInterface $tag
     */
    public function addTag(TagInterface $tag);

    /**
     * Remove tag
     *
     * @param TagInterface $tag
     */
    public function removeTag(TagInterface $tag);

    /**
     * Get tags
     *
     * @return ArrayCollection
     */
    public function getTags();

    /**
     * Add comment
     *
     * @param CommentInterface $comment
     */
    public function addComment(CommentInterface $comment);

    /**
     * Remove comment
     *
     * @param CommentInterface $comment
     */
    public function removeComment(CommentInterface $comment);

    /**
     * Get comments
     *
     * @return ArrayCollection
     */
    public function getComments();

    /**
     * To string
     *
     * @return string
     */
    public function __toString();
}
