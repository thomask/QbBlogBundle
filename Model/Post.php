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
 * Abstract Post model implementation.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
abstract class Post implements PostInterface
{
    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var CategoryInterface $category
     */
    protected $category;

    /**
     * @var string $author
     */
    protected $author;

    /**
     * @var string $title
     */
    protected $title;

    /**
     * @var string $slug
     */
    protected $slug;

    /**
     * @var text $body
     */
    protected $body;

    /**
     * @var \Datetime $created
     */
    protected $created;

    /**
     * @var \Datetime $updated
     */
    protected $updated;

    /**
     * @var Collection $tags
     */
    protected $tags;

    /**
     * @var Collection $comments
     */
    protected $comments;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function setCategory(CategoryInterface $category = null)
    {
        $this->category = $category;
    }

    /**
     * {@inheritdoc}
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * {@inheritdoc}
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * {@inheritdoc}
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * {@inheritdoc}
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * {@inheritdoc}
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * {@inheritdoc}
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * {@inheritdoc}
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdated(\DateTime $updated)
    {
        $this->updated = $updated;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * {@inheritdoc}
     */
    public function addTag(TagInterface $tag)
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeTag(TagInterface $tag)
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * {@inheritdoc}
     */
    public function addComment(CommentInterface $comment)
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeComment(CommentInterface $comment)
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * {@inheritdoc}
     */
     public function __toString()
     {
        return $this->title;
     }
}
