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
 * Abstract Category model implementation.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
abstract class Category implements CategoryInterface
{
    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var CategoryInterface $parent
     */
    protected $parent;

    /**
     * @var integer $lft
     */
    protected $lft;

    /**
     * @var integer $rgt
     */
    protected $rgt;

    /**
     * @var integer $lvl
     */
    protected $lvl;

    /**
     * @var integer $root
     */
    protected $root;

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var string $slug
     */
    protected $slug;

    /**
     * @var \Datetime $created
     */
    protected $created;

    /**
     * @var \Datetime $updated
     */
    protected $updated;

    /**
     * @var Collection $children
     */
    protected $children;

    /**
     * @var Collection $posts
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
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function setParent(CategoryInterface $parent)
    {
        $this->parent = $parent;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * {@inheritdoc}
     */
    public function setLft($lft)
    {
        $this->lft = $lft;
    }

    /**
     * {@inheritdoc}
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * {@inheritdoc}
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;
    }

    /**
     * {@inheritdoc}
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * {@inheritdoc}
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;
    }

    /**
     * {@inheritdoc}
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * {@inheritdoc}
     */
    public function setRoot($root)
    {
        $this->root = $root;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getIndentedName()
    {
        return str_repeat('--', $this->lvl).' '.$this->name;
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
    public function addChild(CategoryInterface $child)
    {
        if (!$this->children->contains($child)) {
            $this->children->add($child);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeChild(CategoryInterface $child)
    {
        if ($this->children->contains($child)) {
            $this->children->removeElement($child);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * {@inheritdoc}
     */
    public function addPost(PostInterface $post)
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removePost(PostInterface $post)
    {
        if ($this->posts->contains($post)) {
            $this->posts->removeElement($post);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->name;
    }
}
