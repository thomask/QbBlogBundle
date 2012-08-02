<?php

/*
 * This file is part of the QbBlogBundle package.
 *
 * (c) Quentin Berlemont <quentinberlemont@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Qb\Bundle\BlogBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Comment controller.
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

        return $this->container->get('templating')->renderResponse('QbBlogBundle:Comment:list.html.twig', array(
            'comments' => $comments,
        ));
    }

    /**
     * Displays and handles a form to create a new comment.
     *
     * @param Request $request
     */
    public function newAction(Request $request)
    {
        $post = $this->container->get('qb_blog.post_manager')->findPostBy(array(
            'id' => $request->get('post_id')
        ));

        if (null === $post) {
            throw new NotFoundHttpException('Unable to find post.');
        }

        $form    = $this->container->get('qb_blog.comment.form');
        $handler = $this->container->get('qb_blog.comment.form.handler');

        if ($handler->process(null, $post)) {
            return new RedirectResponse($this->container->get('router')->generate('qb_blog_comment_list'));
        }

        return $this->container->get('templating')->renderResponse('QbBlogBundle:Comment:new.html.twig', array(
            'post' => $post,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a comment.
     *
     * @param Request $request
     */
    public function showAction(Request $request)
    {
        $comment = $this->container->get('qb_blog.comment_manager')->findCommentBy(array(
            'id' => $request->get('id')
        ));

        if (null === $comment) {
            throw new NotFoundHttpException('Unable to find comment.');
        }

        return $this->container->get('templating')->renderResponse('QbBlogBundle:Comment:show.html.twig', array(
            'comment' => $comment,
        ));
    }

    /**
     * Displays and handles a form to edit an existing comment.
     *
     * @param Request $request
     */
    public function editAction(Request $request)
    {
        $comment = $this->container->get('qb_blog.comment_manager')->findCommentBy(array(
            'id' => $request->get('id')
        ));

        if (null === $comment) {
            throw new NotFoundHttpException('Unable to find comment.');
        }

        $form    = $this->container->get('qb_blog.comment.form');
        $handler = $this->container->get('qb_blog.comment.form.handler');

        if ($handler->process($comment)) {
            return new RedirectResponse($this->container->get('router')->generate('qb_blog_comment_list'));
        }

        return $this->container->get('templating')->renderResponse('QbBlogBundle:Comment:edit.html.twig', array(
            'comment' => $comment,
            'form'    => $form->createView(),
        ));
    }

    /**
     * Deletes a comment.
     *
     * @param Request $request
     */
    public function deleteAction(Request $request)
    {
        $comment = $this->container->get('qb_blog.comment_manager')->findCommentBy(array(
            'id' => $request->get('id')
        ));

        if (null === $comment) {
            throw new NotFoundHttpException('Unable to find comment.');
        }

        $csrf = $this->container->get('form.csrf_provider');

        if ($csrf->isCsrfTokenValid($comment, $request->get('token'))) {
            $this->container->get('qb_blog.comment_manager')->deleteComment($comment);
        }

        return new RedirectResponse($this->container->get('router')->generate('qb_blog_comment_list'));
    }
}
