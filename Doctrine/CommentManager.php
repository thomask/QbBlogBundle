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
use Qb\Bundle\BlogBundle\Model\CommentInterface;
use Qb\Bundle\BlogBundle\Model\AbstractCommentManager;

/**
 * Comment manager.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class CommentManager extends AbstractCommentManager
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
    public function findComments()
    {
        return $this->objectRepository->findAll();
    }

    /**
     * {@inheritDoc}
     */
    public function findComment($id)
    {
        return $this->objectRepository->find($id);
    }

    /**
     * {@inheritDoc}
     */
    public function findCommentBy(array $criteria)
    {
        return $this->objectRepository->findOneBy($criteria);
    }

    /**
     * {@inheritDoc}
     */
    public function saveComment(CommentInterface $comment, $andFlush = true)
    {
        $this->objectManager->persist($comment);

        if ($andFlush) {
            $this->objectManager->flush();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function deleteComment(CommentInterface $comment)
    {
        $this->objectManager->remove($comment);
        $this->objectManager->flush();
    }
}
