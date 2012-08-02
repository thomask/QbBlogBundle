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
interface CommentManagerInterface
{
    public function findComments();

    public function findCommentBy(array $criteria);

    public function createComment();

    public function saveComment(CommentInterface $comment);

    public function deleteComment(CommentInterface $comment);

    public function getClass();
}
