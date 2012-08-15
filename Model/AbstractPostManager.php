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

use Qb\Bundle\BlogBundle\Event\FilterPostEvent;
use Qb\Bundle\BlogBundle\QbBlogEvents;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Abstract Post Manager.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
abstract class AbstractPostManager implements PostManagerInterface
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
    public function createPost()
    {
        $class   = $this->getClass();
        $post = new $class;

        $event = new FilterPostEvent($post);
        $this->eventDispatcher->dispatch(QbBlogEvents::POST_CREATE, $event);

        return $post;
    }

    /**
     * {@inheritDoc}
     */
    public function savePost(PostInterface $post, $andFlush = true)
    {
        $event = new FilterPostEvent($post);
        $this->eventDispatcher->dispatch(QbBlogEvents::POST_PRE_SAVE, $event);

        $this->doSavePost($post, $andFlush);

        $event = new FilterPostEvent($post);
        $this->eventDispatcher->dispatch(QbBlogEvents::POST_POST_SAVE, $event);
    }

    /**
     * Saves a post.
     *
     * @param PostInterface $post
     * @param bool          $andFlush
     */
    abstract protected function doSavePost(PostInterface $post, $andFlush = true);

    /**
     * {@inheritDoc}
     */
    public function deletePost(PostInterface $post)
    {
        $event = new FilterPostEvent($post);
        $this->eventDispatcher->dispatch(QbBlogEvents::POST_PRE_DELETE, $event);

        $this->doDeletePost($post);

        $event = new FilterPostEvent($post);
        $this->eventDispatcher->dispatch(QbBlogEvents::POST_POST_DELETE, $event);
    }

    /**
     * Deletes a post.
     *
     * @param PostInterface $post
     */
    abstract protected function doDeletePost(PostInterface $post);
}
