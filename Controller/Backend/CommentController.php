<?php

/*
 * This file is part of the QbBlogBundle package.
 *
 * (c) Quentin Berlemont <quentinberlemont@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Qb\Bundle\BlogBundle\Controller\Backend;

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
    public function indexAction()
    {
        $comments = $this->container->get('qb_blog.comment_manager')->findComments();

        return $this->container->get('templating')->renderResponse(
            'QbBlogBundle:Backend/Comment:index.html.'.$this->container->getParameter('qb_blog.template_engine'),
            array(
                'comments' => $comments,
            )
        );
    }

    /**
     * Displays and handles a form to edit an existing comment.
     *
     * @param  integer               $id
     * @throws NotFoundHttpException If the comment does not exist.
     */
    public function editAction($id)
    {
        $comment = $this->container->get('qb_blog.comment_manager')->findComment($id);

        if (null === $comment) {
            throw new NotFoundHttpException('Comment does not exist.');
        }

        $form    = $this->container->get('qb_blog.comment.form');
        $handler = $this->container->get('qb_blog.comment.form.handler');

        if ($handler->process($comment)) {
            return new RedirectResponse($this->container->get('router')->generate('qb_blog_backend_comment'));
        }

        return $this->container->get('templating')->renderResponse(
            'QbBlogBundle:Backend/Comment:edit.html.'.$this->container->getParameter('qb_blog.template_engine'),
            array(
                'comment' => $comment,
                'form'    => $form->createView(),
            )
        );
    }

    /**
     * Deletes a comment.
     *
     * @param  integer               $id
     * @param  string                $token
     * @throws NotFoundHttpException If the comment does not exist.
     */
    public function deleteAction($id, $token)
    {
        $comment = $this->container->get('qb_blog.comment_manager')->findComment($id);

        if (null === $comment) {
            throw new NotFoundHttpException('Comment does not exist.');
        }

        $csrf = $this->container->get('form.csrf_provider');

        if ($csrf->isCsrfTokenValid($id, $token)) {
            $this->container->get('qb_blog.comment_manager')->deleteComment($comment);
        }

        return new RedirectResponse($this->container->get('router')->generate('qb_blog_backend_comment'));
    }
}
