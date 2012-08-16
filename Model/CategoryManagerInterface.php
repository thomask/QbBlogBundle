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
 * Category Manager Interface.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
interface CategoryManagerInterface
{
    /**
     * Creates a new category.
     *
     * @return CategoryInterface
     */
    public function createCategory();

    /**
     * Finds all categories.
     *
     * @return \Traversable
     */
    public function findCategories();

    /**
     * Finds categories by criteria.
     *
     * @param  array        $criteria
     * @return \Traversable
     */
    public function findCategoriesBy(array $criteria);

    /**
     * Finds a category by id.
     *
     * @param integer $id
     */
    public function findCategory($id);

    /**
     * Finds a category by criteria.
     *
     * @param  array             $criteria
     * @return CategoryInterface
     */
    public function findCategoryBy(array $criteria);

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
     * Get the fully-qualified class name of category model.
     *
     * @return string
     */
    public function getClass();
}
