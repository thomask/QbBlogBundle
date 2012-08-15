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

use Qb\Bundle\BlogBundle\Event\FilterTagEvent;
use Qb\Bundle\BlogBundle\QbBlogEvents;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Abstract Tag Manager.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
abstract class AbstractTagManager implements TagManagerInterface
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
    public function createTag()
    {
        $class = $this->getClass();
        $tag   = new $class;

        $event = new FilterTagEvent($tag);
        $this->eventDispatcher->dispatch(QbBlogEvents::TAG_CREATE, $event);

        return $tag;
    }

    /**
     * {@inheritDoc}
     */
    public function saveTag(TagInterface $tag, $andFlush = true)
    {
        $event = new FilterTagEvent($tag);
        $this->eventDispatcher->dispatch(QbBlogEvents::TAG_PRE_SAVE, $event);

        $this->doSaveTag($tag, $andFlush);

        $event = new FilterTagEvent($tag);
        $this->eventDispatcher->dispatch(QbBlogEvents::TAG_POST_SAVE, $event);
    }

    /**
     * Performs the saving of a tag.
     *
     * @param TagInterface $tag
     * @param bool         $andFlush
     */
    abstract protected function doSaveTag(TagInterface $tag, $andFlush = true);

    /**
     * {@inheritDoc}
     */
    public function deleteTag(TagInterface $tag)
    {
        $event = new FilterTagEvent($tag);
        $this->eventDispatcher->dispatch(QbBlogEvents::TAG_PRE_DELETE, $event);

        $this->doDeleteTag($tag);

        $event = new FilterTagEvent($tag);
        $this->eventDispatcher->dispatch(QbBlogEvents::TAG_POST_DELETE, $event);
    }

    /**
     * Performs the deleting of a tag.
     *
     * @param TagInterface $tag
     */
    abstract protected function doDeleteTag(TagInterface $tag);
}
