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
 * Frontend post controller.
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
            'QbBlogBundle:Frontend\Post:list.html.'.$this->container->get('qb_blog.template_engine'),
            array(
                'posts' => $posts,
            )
        );
    }

    /**
     * Finds and displays a post.
     *
     * @param  Request               $request
     * @throws NotFoundHttpException If the post does not exist.
     */
    public function showAction(Request $request)
    {
        $post = $this->container->get('qb_blog.post_manager')->findPostBy(array(
            'slug' => $request->get('slug')
        ));

        if (null === $post) {
            throw new NotFoundHttpException('Post does not exist.');
        }

        $form = $this->container->get('qb_blog.comment.form');

        return $this->container->get('templating')->renderResponse(
            'QbBlogBundle:Frontend\Post:show.html.'.$this->container->get('qb_blog.template_engine'),
            array(
                'post' => $post,
                'form' => $form->createView(),
            )
        );
    }
}
