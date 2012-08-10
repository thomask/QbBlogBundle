<?php

/*
 * This file is part of the QbBlogBundle package.
 *
 * (c) Quentin Berlemont <quentinberlemont@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Qb\Bundle\BlogBundle\Controller\Frontend;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Frontend comment controller.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class CommentController extends ContainerAware
{
    /**
     * Displays and handles a form to create a new comment.
     *
     * @param  string                $slug
     * @throws NotFoundHttpException If the post does not exist.
     */
    public function newAction($slug)
    {
        $post = $this->container->get('qb_blog.post_manager')->findPostBy(array(
            'slug' => $slug
        ));

        if (null === $post) {
            throw new NotFoundHttpException('Post does not exist.');
        }

        $form    = $this->container->get('qb_blog.comment.form');
        $handler = $this->container->get('qb_blog.comment.form.handler');

        if ($handler->process(null, $post)) {
            return new RedirectResponse($this->container->get('router')->generate('qb_blog_frontend_post_show', array('slug' => $post->getSlug())));
        }

        return $this->container->get('templating')->renderResponse(
            'QbBlogBundle:Frontend\Comment:new.html.'.$this->container->getParameter('qb_blog.template_engine'),
            array(
                'post' => $post,
                'form' => $form->createView(),
            )
        );
    }
}
