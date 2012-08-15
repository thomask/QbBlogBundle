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
 * Comment Manager Interface.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
interface CommentManagerInterface
{
    /**
     * Creates a new comment.
     *
     * @return CommentInterface
     */
    public function createComment();

    /**
     * Finds all comments.
     *
     * @return \Traversable
     */
    public function findComments();

    /**
     * Finds a comment by id.
     *
     * @param integer $id
     */
    public function findComment($id);

    /**
     * Finds a comment by criteria.
     *
     * @param  array            $criteria
     * @return CommentInterface
     */
    public function findCommentBy(array $criteria);

    /**
     * Saves a comment.
     *
     * @param CommentInterface $comment
     */
    public function saveComment(CommentInterface $comment);

    /**
     * Deletes a comment.
     *
     * @param CommentInterface $comment
     */
    public function deleteComment(CommentInterface $comment);

    /**
     * Get the fully-qualified class name of comment model.
     *
     * @return string
     */
    public function getClass();
}
