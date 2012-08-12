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
use Qb\Bundle\BlogBundle\Model\AbstractCategory;
use Qb\Bundle\BlogBundle\Model\PostInterface;

/**
 * Category entity.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class Category extends AbstractCategory
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->posts = new ArrayCollection();
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
}
