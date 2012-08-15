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

use Qb\Bundle\BlogBundle\Event\FilterCommentEvent;
use Qb\Bundle\BlogBundle\QbBlogEvents;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Abstract Comment Manager.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
abstract class AbstractCommentManager implements CommentManagerInterface
{
    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * Constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function createComment()
    {
        $class   = $this->getClass();
        $comment = new $class;

        $event = new FilterCommentEvent($comment);
        $this->eventDispatcher->dispatch(QbBlogEvents::COMMENT_CREATE, $event);

        return $comment;
    }

    /**
     * {@inheritDoc}
     */
    public function saveComment(CommentInterface $comment, $andFlush = true)
    {
        $event = new FilterCommentEvent($comment);
        $this->eventDispatcher->dispatch(QbBlogEvents::COMMENT_PRE_SAVE, $event);

        $this->doSaveComment($comment, $andFlush);

        $event = new FilterCommentEvent($comment);
        $this->eventDispatcher->dispatch(QbBlogEvents::COMMENT_POST_SAVE, $event);
    }

    /**
     * Performs the saving of a comment.
     *
     * @param CommentInterface $comment
     * @param bool             $andFlush
     */
    abstract protected function doSaveComment(CommentInterface $comment, $andFlush = true);

    /**
     * {@inheritDoc}
     */
    public function deleteComment(CommentInterface $comment)
    {
        $event = new FilterCommentEvent($comment);
        $this->eventDispatcher->dispatch(QbBlogEvents::COMMENT_PRE_DELETE, $event);

        $this->doDeleteComment($comment);

        $event = new FilterCommentEvent($comment);
        $this->eventDispatcher->dispatch(QbBlogEvents::COMMENT_POST_DELETE, $event);
    }

    /**
     * Performs the deleting of a comment.
     *
     * @param CommentInterface $comment
     */
    abstract protected function doDeleteComment(CommentInterface $comment);
}
