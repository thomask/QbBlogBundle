<?php

/*
 * This file is part of the QbBlogBundle package.
 *
 * (c) Quentin Berlemont <quentinberlemont@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Qb\Bundle\BlogBundle\EventListener;

use Qb\Bundle\BlogBundle\Event\FilterPostEvent;
use Qb\Bundle\BlogBundle\Model\SignedPostInterface;
use Qb\Bundle\BlogBundle\QbBlogEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * Blames a post using Symfony2 security component.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class PostBlamerListener implements EventSubscriberInterface
{
    /**
     * @var SecurityContext
     */
    protected $securityContext;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Constructor.
     *
     * @param SecurityContextInterface $securityContext
     * @param LoggerInterface          $logger
     */
    public function __construct(SecurityContextInterface $securityContext = null, LoggerInterface $logger = null)
    {
        $this->securityContext = $securityContext;
        $this->logger          = $logger;
    }

    /**
     * Assigns the currently logged in user to a Post.
     *
     * @param FilterPostEvent $event
     */
    public function blame(FilterPostEvent $event)
    {
        $post = $event->getPost();

        if (null === $this->securityContext) {
            if ($this->logger) {
                $this->logger->debug('The security.context service is NULL.');
            }

            return;
        }

        if (!$post instanceof SignedPostInterface) {
            if ($this->logger) {
                $this->logger->debug('Post does not implement SignedPostInterface.');
            }

            return;
        }

        if (null === $this->securityContext->getToken()) {
            if ($this->logger) {
                $this->logger->debug('No authentication information is available, please configure a firewall for this route.');
            }

            return;
        }

        if (null === $post->getAuthor() && $this->securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $post->setAuthor($this->securityContext->getToken()->getUser());
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            QbBlogEvents::POST_PRE_SAVE => 'blame'
        );
    }
}