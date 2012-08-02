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
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
interface CommentInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set post
     *
     * @param PostInterface $post
     */
    public function setPost(PostInterface $post);

    /**
     * Get post
     *
     * @return PostInterface
     */
    public function getPost();

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
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email);

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set url
     *
     * @param string $url
     */
    public function setUrl($url);

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl();

    /**
     * Set comment
     *
     * @param text $comment
     */
    public function setComment($comment);

    /**
     * Get comment
     *
     * @return text
     */
    public function getComment();

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
     * To string
     *
     * @return string
     */
    public function __toString();
}
