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
 * Category Manager.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
interface CategoryManagerInterface
{
    /**
     * Finds all categories instances.
     *
     * @return \Traversable
     */
    public function findCategories();

    /**
     * Finds a category by the given criteria.
     *
     * @param  array             $criteria
     * @return CategoryInterface
     */
    public function findCategoryBy(array $criteria);

    /**
     * Returns an empty instance of the category.
     *
     * @return CategoryInterface
     */
    public function createCategory();

    /**
     * Saves a category.
     *
     * @param CategoryInterface $category
     */
    public function saveCategory(CategoryInterface $category);

    /**
     * Deletes a category.
     *
     * @param CategoryInterface $category
     */
    public function deleteCategory(CategoryInterface $category);

    /**
     * Get fully-qualified class name of the category.
     *
     * @return string
     */
    public function getClass();
}
