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
abstract class TagManager implements TagManagerInterface
{
    /**
     * {@inheritdoc}
     */
    public function createTag()
    {
        $class = $this->getClass();
        $tag = new $class;

        return $tag;
    }
}
