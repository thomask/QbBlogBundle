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
     * Finds all tags instances.
     *
     * @return \Traversable
     */
    public function findTags();

    /**
     * Finds a tag by the given criteria.
     *
     * @param  array             $criteria
     * @return TagInterface
     */
    public function findTagBy(array $criteria);

    /**
     * Returns an empty instance of the tag.
     *
     * @return TagInterface
     */
    public function createTag();

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
     * Get fully-qualified class name of the tag.
     *
     * @return string
     */
    public function getClass();
}
