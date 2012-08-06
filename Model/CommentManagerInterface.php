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
     * Finds all comments instances.
     *
     * @return \Traversable
     */
    public function findComments();

    /**
     * Finds a comment by the given criteria.
     *
     * @param  array             $criteria
     * @return CommentInterface
     */
    public function findCommentBy(array $criteria);

    /**
     * Returns an empty instance of the comment.
     *
     * @return CommentInterface
     */
    public function createComment();

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
     * Get fully-qualified class name of the comment.
     *
     * @return string
     */
    public function getClass();
}
