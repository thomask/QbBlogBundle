Integrate your user model
=========================

In order to add an author to a post, the Post class should implement the SignedPostInterface and add a field to your mapping.

::

<?php
// src/Acme/BlogBundle/Entity/Post.php

namespace Acme\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Qb\Bundle\BlogBundle\Entity\Post as BasePost;
use Qb\Bundle\BlogBundle\Model\SignedPostInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="acme_blog_posts")
 */
class Post extends BasePost implements SignedPostInterface
{
    // ...

    /**
     * @ORM\ManyToOne(targetEntity="Acme\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    protected $author;

    /**
     * Set author.
     *
     * @param UserInterface $author
     */
    public function setAuthor(UserInterface $author)
    {
        $this->author = $author;
    }

    /**
     * Get author.
     *
     * @return UserInterface
     */
    public function getAuthor()
    {
        return $this->author;
    }
}