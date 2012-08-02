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
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
interface CategoryManagerInterface
{
    public function findCategories();

    public function findCategoryBy(array $criteria);

    public function createCategory();

    public function saveCategory(CategoryInterface $category);

    public function deleteCategory(CategoryInterface $category);

    public function getClass();
}
