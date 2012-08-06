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
use Qb\Bundle\BlogBundle\Model\PostInterface;
use Qb\Bundle\BlogBundle\Model\PostManager as BasePostManager;

/**
 * Post manager.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class PostManager extends BasePostManager
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
    public function findPosts()
    {
        return $this->objectRepository->findAll();
    }

    /**
     * {@inheritDoc}
     */
    public function findPostBy(array $criteria)
    {
        return $this->objectRepository->findOneBy($criteria);
    }

    /**
     * {@inheritDoc}
     */
    public function savePost(PostInterface $post, $andFlush = true)
    {
        $this->objectManager->persist($post);

        if ($andFlush) {
            $this->objectManager->flush();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function deletePost(PostInterface $post)
    {
        $this->objectManager->remove($post);
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
