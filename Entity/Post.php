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
use Qb\Bundle\BlogBundle\Model\AbstractPost;
use Qb\Bundle\BlogBundle\Model\CategoryInterface;
use Qb\Bundle\BlogBundle\Model\CommentInterface;
use Qb\Bundle\BlogBundle\Model\TagInterface;

/**
 * Post entity.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class Post extends AbstractPost
{
    /**
     * @var CategoryInterface
     */
    protected $category;

    /**
     * @var Collection
     */
    protected $comments;

    /**
     * @var Collection
     */
    protected $tags;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->tags     = new ArrayCollection();
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
     * Add comment.
     *
     * @param CommentInterface $comment
     */
    public function addComment(CommentInterface $comment)
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
        }
    }

    /**
     * Remove comment.
     *
     * @param CommentInterface $comment
     */
    public function removeComment(CommentInterface $comment)
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
        }
    }

    /**
     * Get comments.
     *
     * @return Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add tag.
     *
     * @param TagInterface $tag
     */
    public function addTag(TagInterface $tag)
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }
    }

    /**
     * Remove tag.
     *
     * @param TagInterface $tag
     */
    public function removeTag(TagInterface $tag)
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
        }
    }

    /**
     * Get tags.
     *
     * @return Collection
     */
    public function getTags()
    {
        return $this->tags;
    }
}
