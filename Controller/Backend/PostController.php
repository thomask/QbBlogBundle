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
 * Backend post controller.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class PostController extends ContainerAware
{
    /**
     * Lists all posts.
     */
    public function listAction()
    {
        $posts = $this->container->get('qb_blog.post_manager')->findPosts();

        return $this->container->get('templating')->renderResponse(
            'QbBlogBundle:Backend\Post:list.html.'.$this->container->get('qb_blog.template_engine'),
            array(
                'posts' => $posts,
            )
        );
    }

    /**
     * Displays and handles a form to create a new post.
     */
    public function newAction()
    {
        $form    = $this->container->get('qb_blog.post.form');
        $handler = $this->container->get('qb_blog.post.form.handler');

        if ($handler->process()) {
            return new RedirectResponse($this->container->get('router')->generate('qb_blog_backend_post_list'));
        }

        return $this->container->get('templating')->renderResponse(
            'QbBlogBundle:Backend\Post:new.html.'.$this->container->get('qb_blog.template_engine'),
            array(
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Displays and handles a form to edit an existing post.
     *
     * @param  Request               $request
     * @throws NotFoundHttpException If the post does not exist.
     */
    public function editAction(Request $request)
    {
        $post = $this->container->get('qb_blog.post_manager')->findPostBy(array(
            'slug' => $request->get('slug')
        ));

        if (null === $post) {
            throw new NotFoundHttpException('Post does not exist.');
        }

        $form    = $this->container->get('qb_blog.post.form');
        $handler = $this->container->get('qb_blog.post.form.handler');

        if ($handler->process($post)) {
            return new RedirectResponse($this->container->get('router')->generate('qb_blog_backend_post_list'));
        }

        return $this->container->get('templating')->renderResponse(
            'QbBlogBundle:Backend\Post:edit.html.'.$this->container->get('qb_blog.template_engine'),
            array(
                'post' => $post,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Deletes a post.
     *
     * @param  Request               $request
     * @throws NotFoundHttpException If the post does not exist.
     */
    public function deleteAction(Request $request)
    {
        $post = $this->container->get('qb_blog.post_manager')->findPostBy(array(
            'slug' => $request->get('slug')
        ));

        if (null === $post) {
            throw new NotFoundHttpException('Post does not exist.');
        }

        $csrf = $this->container->get('form.csrf_provider');

        if ($csrf->isCsrfTokenValid($post, $request->get('token'))) {
            $this->container->get('qb_blog.post_manager')->deletePost($post);
        }

        return new RedirectResponse($this->container->get('router')->generate('qb_blog_backend_post_list'));
    }
}
