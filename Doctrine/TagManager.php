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
use Qb\Bundle\BlogBundle\Model\TagInterface;
use Qb\Bundle\BlogBundle\Model\AbstractTagManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Tag Manager.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class TagManager extends AbstractTagManager
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var ObjectRepository
     */
    protected $objectRepository;

    /**
     * @var string
     */
    protected $class;

    /**
     * Constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     * @param ObjectManager            $objectManager
     * @param string                   $class
     */
    public function __construct(EventDispatcherInterface $eventDispatcher, ObjectManager $objectManager, $class)
    {
        parent::__construct($eventDispatcher);

        $this->objectManager    = $objectManager;
        $this->objectRepository = $objectManager->getRepository($class);

        $metadata    = $objectManager->getClassMetadata($class);
        $this->class = $metadata->getName();
    }

    /**
     * {@inheritDoc}
     */
    public function findTags()
    {
        return $this->objectRepository->findAll();
    }

    /**
     * {@inheritDoc}
     */
    public function findTag($id)
    {
        return $this->objectRepository->find($id);
    }

    /**
     * {@inheritDoc}
     */
    public function findTagBy(array $criteria)
    {
        return $this->objectRepository->findOneBy($criteria);
    }

    /**
     * {@inheritDoc}
     */
    protected function doSaveTag(TagInterface $tag, $andFlush = true)
    {
        $this->objectManager->persist($tag);

        if ($andFlush) {
            $this->objectManager->flush();
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function doDeleteTag(TagInterface $tag)
    {
        $this->objectManager->remove($tag);
        $this->objectManager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getClass()
    {
        return $this->class;
    }
}
