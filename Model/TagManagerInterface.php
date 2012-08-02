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
interface TagManagerInterface
{
    public function findTags();

    public function findTagBy(array $criteria);

    public function createTag();

    public function saveTag(TagInterface $tag);

    public function deleteTag(TagInterface $tag);

    public function getClass();
}
