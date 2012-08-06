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
use Qb\Bundle\BlogBundle\Model\TagManager as BaseTagManager;

/**
 * Tag manager.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class TagManager extends BaseTagManager
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
     * @var string $class
     */
    protected $class;

    /**
     * Constructor.
     *
     * @param ObjectManager $objectManager
     * @param string        $class
     */
    public function __construct(ObjectManager $objectManager, $class)
    {
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
    public function findTagBy(array $criteria)
    {
        return $this->objectRepository->findOneBy($criteria);
    }

    /**
     * {@inheritDoc}
     */
    public function saveTag(TagInterface $tag, $andFlush = true)
    {
        $this->objectManager->persist($tag);

        if ($andFlush) {
            $this->objectManager->flush();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function deleteTag(TagInterface $tag)
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
