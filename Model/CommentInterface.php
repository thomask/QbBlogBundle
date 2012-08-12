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
 * Comment interface.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
interface CommentInterface
{
    /**
     * Get id.
     *
     * @return integer
     */
    public function getId();

    /**
     * Set author.
     *
     * @param string $author
     */
    public function setAuthor($author);

    /**
     * Get author.
     *
     * @return string
     */
    public function getAuthor();

    /**
     * Set email.
     *
     * @param string $email
     */
    public function setEmail($email);

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set url.
     *
     * @param string $url
     */
    public function setUrl($url);

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl();

    /**
     * Set body.
     *
     * @param text $body
     */
    public function setBody($body);

    /**
     * Get body.
     *
     * @return text
     */
    public function getBody();

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
