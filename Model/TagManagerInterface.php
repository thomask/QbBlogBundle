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
 * Tag Manager.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
interface TagManagerInterface
{
    /**
     * Finds all tags.
     *
     * @return \Traversable
     */
    public function findTags();

    /**
     * Find tag by id.
     *
     * @param integer $id
     */
    public function findTag($id);

    /**
     * Finds tag criteria.
     *
     * @param  array        $criteria
     * @return TagInterface
     */
    public function findTagBy(array $criteria);

    /**
     * Creates new tag object.
     *
     * @return TagInterface
     */
    public function createTag();

    /**
     * Saves tag.
     *
     * @param TagInterface $tag
     */
    public function saveTag(TagInterface $tag);

    /**
     * Deletes tag.
     *
     * @param TagInterface $tag
     */
    public function deleteTag(TagInterface $tag);
}
