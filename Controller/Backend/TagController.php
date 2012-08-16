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
 * Tag controller.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class TagController extends ContainerAware
{
    /**
     * Lists all tags.
     */
    public function indexAction()
    {
        $tags = $this->container->get('qb_blog.tag_manager')->findTags();

        return $this->container->get('templating')->renderResponse(
            'QbBlogBundle:Backend/Tag:index.html.'.$this->container->getParameter('qb_blog.template.engine'),
            array(
                'tags' => $tags,
            )
        );
    }

    /**
     * Displays and handles a form to create a new tag.
     */
    public function newAction()
    {
        $form    = $this->container->get('qb_blog.tag.form');
        $handler = $this->container->get('qb_blog.tag.form.handler');

        if ($handler->process()) {
            return new RedirectResponse($this->container->get('router')->generate('qb_blog_backend_tag'));
        }

        return $this->container->get('templating')->renderResponse(
            'QbBlogBundle:Backend/Tag:new.html.'.$this->container->getParameter('qb_blog.template.engine'),
            array(
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Displays and handles a form to edit an existing tag.
     *
     * @param  integer               $id
     * @throws NotFoundHttpException If the tag does not exist.
     */
    public function editAction($id)
    {
        $tag = $this->container->get('qb_blog.tag_manager')->findTag($id);

        if (null === $tag) {
            throw new NotFoundHttpException('Tag does not exist.');
        }

        $form    = $this->container->get('qb_blog.tag.form');
        $handler = $this->container->get('qb_blog.tag.form.handler');

        if ($handler->process($tag)) {
            return new RedirectResponse($this->container->get('router')->generate('qb_blog_backend_tag'));
        }

        return $this->container->get('templating')->renderResponse(
            'QbBlogBundle:Backend/Tag:edit.html.'.$this->container->getParameter('qb_blog.template.engine'),
            array(
                'tag'  => $tag,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Deletes a tag.
     *
     * @param  integer               $id
     * @param  string                $token
     * @throws NotFoundHttpException If the tag does not exist.
     */
    public function deleteAction($id, $token)
    {
        $tag = $this->container->get('qb_blog.tag_manager')->findTag($id);

        if (null === $tag) {
            throw new NotFoundHttpException('Tag does not exist.');
        }

        $csrf = $this->container->get('form.csrf_provider');

        if ($csrf->isCsrfTokenValid($id, $token)) {
            $this->container->get('qb_blog.tag_manager')->deleteTag($tag);
        }

        return new RedirectResponse($this->container->get('router')->generate('qb_blog_backend_tag'));
    }
}
