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
 * Comment Manager.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
interface CommentManagerInterface
{
    /**
     * Finds all comments.
     *
     * @return \Traversable
     */
    public function findComments();

    /**
     * Finds comment by id.
     *
     * @param integer $id
     */
    public function findComment($id);

    /**
     * Finds comment by criteria.
     *
     * @param  array            $criteria
     * @return CommentInterface
     */
    public function findCommentBy(array $criteria);

    /**
     * Creates new comment object.
     *
     * @return CommentInterface
     */
    public function createComment();

    /**
     * Saves comment.
     *
     * @param CommentInterface $comment
     */
    public function saveComment(CommentInterface $comment);

    /**
     * Deletes comment.
     *
     * @param CommentInterface $comment
     */
    public function deleteComment(CommentInterface $comment);
}
