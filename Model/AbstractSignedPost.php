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

use BadMethodCall;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Abstract Signed Post.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
abstract class AbstractSignedPost extends AbstractPost
{
    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * {@inheritdoc}
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * {@inheritdoc}
     */
    public function setAuthor($author)
    {
        throw new BadMethodCall('You are not allowed to set an author when using signed post.');
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthor()
    {
        return $this->user->getUsername();
    }
}