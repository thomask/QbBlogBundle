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
     * Finds all categories.
     *
     * @return \Traversable
     */
    public function findCategories();

    /**
     * Finds category by id.
     *
     * @param integer $id
     */
    public function findCategory($id);

    /**
     * Finds category by criteria.
     *
     * @param  array             $criteria
     * @return CategoryInterface
     */
    public function findCategoryBy(array $criteria);

    /**
     * Creates new category object.
     *
     * @return CategoryInterface
     */
    public function createCategory();

    /**
     * Saves category.
     *
     * @param CategoryInterface $category
     */
    public function saveCategory(CategoryInterface $category);

    /**
     * Deletes category.
     *
     * @param CategoryInterface $category
     */
    public function deleteCategory(CategoryInterface $category);
}
