<?php

/*
 * This file is part of the QbBlogBundle package.
 *
 * (c) Quentin Berlemont <quentinberlemont@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Qb\Bundle\BlogBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Qb\Bundle\BlogBundle\Model\CategoryInterface;
use Qb\Bundle\BlogBundle\Model\AbstractCategoryManager;

/**
 * Category manager.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class CategoryManager extends AbstractCategoryManager
{
    /**
     * @var ObjectManager $objectManager
     */
    protected $objectManager;

    /**
     * @var ObjectRepository $repository
     */
    protected $objectRepository;

    /**
     * Constructor.
     *
     * @param ObjectManager $objectManager
     * @param string        $class
     */
    public function __construct(ObjectManager $objectManager, $class)
    {
        parent::__construct($class);

        $this->objectManager    = $objectManager;
        $this->objectRepository = $objectManager->getRepository($class);
    }

    /**
     * {@inheritDoc}
     */
    public function findCategories()
    {
        return $this->objectRepository->findAll();
    }

    /**
     * {@inheritDoc}
     */
    public function findCategory($id)
    {
        return $this->objectRepository->find($id);
    }

    /**
     * {@inheritDoc}
     */
    public function findCategoryBy(array $criteria)
    {
        return $this->objectRepository->findOneBy($criteria);
    }

    /**
     * {@inheritDoc}
     */
    public function saveCategory(CategoryInterface $category, $andFlush = true)
    {
        $this->objectManager->persist($category);

        if ($andFlush) {
            $this->objectManager->flush();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function deleteCategory(CategoryInterface $category)
    {
        $this->objectManager->remove($category);
        $this->objectManager->flush();
    }
}
