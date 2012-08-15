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

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Signed Post Interface.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
interface SignedPostInterface extends PostInterface
{
    /**
     * Set author.
     *
     * @param UserInterface $user
     */
    public function setAuthor(UserInterface $user);

    /**
     * Get author.
     */
    public function getAuthor();
}