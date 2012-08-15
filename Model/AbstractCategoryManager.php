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

use Qb\Bundle\BlogBundle\Event\FilterCategoryEvent;
use Qb\Bundle\BlogBundle\QbBlogEvents;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Abstract Category Manager.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
abstract class AbstractCategoryManager implements CategoryManagerInterface
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
    public function createCategory()
    {
        $class    = $this->getClass();
        $category = new $class;

        $event = new FilterCategoryEvent($category);
        $this->eventDispatcher->dispatch(QbBlogEvents::CATEGORY_CREATE, $event);

        return $category;
    }

    /**
     * {@inheritDoc}
     */
    public function saveCategory(CategoryInterface $category, $andFlush = true)
    {
        $event = new FilterCategoryEvent($category);
        $this->eventDispatcher->dispatch(QbBlogEvents::CATEGORY_PRE_SAVE, $event);

        $this->doSaveCategory($category, $andFlush);

        $event = new FilterCategoryEvent($category);
        $this->eventDispatcher->dispatch(QbBlogEvents::CATEGORY_POST_SAVE, $event);
    }

    /**
     * Performs the saving of a category.
     *
     * @param CategoryInterface $category
     * @param bool              $andFlush
     */
    abstract protected function doSaveCategory(CategoryInterface $category, $andFlush = true);

    /**
     * {@inheritDoc}
     */
    public function deleteCategory(CategoryInterface $category)
    {
        $event = new FilterCategoryEvent($category);
        $this->eventDispatcher->dispatch(QbBlogEvents::CATEGORY_PRE_DELETE, $event);

        $this->doDeleteCategory($category);

        $event = new FilterCategoryEvent($category);
        $this->eventDispatcher->dispatch(QbBlogEvents::CATEGORY_POST_DELETE, $event);
    }

    /**
     * Performs the deleting of a category.
     *
     * @param CategoryInterface $category
     */
    abstract protected function doDeleteCategory(CategoryInterface $category);
}
