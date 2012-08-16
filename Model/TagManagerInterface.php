<?php

/*
 * This file is part of the QbBlogBundle package.
 *
 * (c) Quentin Berlemont <quentinberlemont@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

//namespace Qb\Bundle\BlogBundle\Model;

/**
 * Tag Manager Interface.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
interface TagManagerInterface
{
    /**
     * Creates a new tag.
     *
     * @return TagInterface
     */
    public function createTag();

    /**
     * Finds all tags.
     *
     * @return \Traversable
     */
    public function findTags();

    /**
     * Finds tags by criteria.
     *
     * @param  array        $criteria
     * @return \Traversable
     */
    public function findTagsBy(array $criteria);

    /**
     * Find a tag by id.
     *
     * @param integer $id
     */
    public function findTag($id);

    /**
     * Finds a tag by criteria.
     *
     * @param  array        $criteria
     * @return TagInterface
     */
    public function findTagBy(array $criteria);

    /**
     * Saves a tag.
     *
     * @param TagInterface $tag
     */
    public function saveTag(TagInterface $tag);

    /**
     * Deletes a tag.
     *
     * @param TagInterface $tag
     */
    public function deleteTag(TagInterface $tag);

    /**
     * Get the fully-qualified class name of tag model.
     *
     * @return string
     */
    public function getClass();
}
