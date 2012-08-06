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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Frontend comment controller.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class CommentController extends ContainerAware
{
    /**
     * Lists all comments.
     */
    public function listAction()
    {
        $comments = $this->container->get('qb_blog.comment_manager')->findComments();

        return $this->container->get('templating')->renderResponse('QbBlogBundle:Frontend\Comment:list.html.twig', array(
            'comments' => $comments,
        ));
    }

    /**
     * Displays and handles a form to create a new comment.
     *
     * @param  Request               $request
     * @throws NotFoundHttpException If the comment does not exist.
     */
    public function newAction(Request $request)
    {
        $post = $this->container->get('qb_blog.post_manager')->findPostBy(array(
            'slug' => $request->get('slug')
        ));

        if (null === $post) {
            throw new NotFoundHttpException('Comment does not exist.');
        }

        $form    = $this->container->get('qb_blog.comment.form');
        $handler = $this->container->get('qb_blog.comment.form.handler');

        if ($handler->process(null, $post)) {
            return new RedirectResponse($this->container->get('router')->generate('qb_blog_frontend_post_show', array('slug' => $post->getSlug())));
        }

        return $this->container->get('templating')->renderResponse('QbBlogBundle:Frontend\Comment:new.html.twig', array(
            'post' => $post,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a comment.
     *
     * @param  Request               $request
     * @throws NotFoundHttpException If the comment does not exist.
     */
    public function showAction(Request $request)
    {
        $comment = $this->container->get('qb_blog.comment_manager')->findCommentBy(array(
            'id' => $request->get('id')
        ));

        if (null === $comment) {
            throw new NotFoundHttpException('Comment does not exist.');
        }

        return $this->container->get('templating')->renderResponse('QbBlogBundle:Frontend\Comment:show.html.twig', array(
            'comment' => $comment,
        ));
    }
}
