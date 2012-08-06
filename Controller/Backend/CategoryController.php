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
 * Backend category controller.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class CategoryController extends ContainerAware
{
    /**
     * Lists all categories.
     */
    public function listAction()
    {
        $categories = $this->container->get('qb_blog.category_manager')->findCategories();

        return $this->container->get('templating')->renderResponse(
            'QbBlogBundle:Backend\Category:list.html.'.$this->container->getParameter('qb_blog.template_engine'),
            array(
                'categories' => $categories,
            )
        );
    }

    /**
     * Displays and handles a form to create a new category.
     */
    public function newAction()
    {
        $form    = $this->container->get('qb_blog.category.form');
        $handler = $this->container->get('qb_blog.category.form.handler');

        if ($handler->process()) {
            return new RedirectResponse($this->container->get('router')->generate('qb_blog_backend_category_list'));
        }

        return $this->container->get('templating')->renderResponse(
            'QbBlogBundle:Backend\Category:new.html.'.$this->container->getParameter('qb_blog.template_engine'),
            array(
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Displays and handles a form to edit an existing category.
     *
     * @param  Request               $request
     * @throws NotFoundHttpException If the category does not exist.
     */
    public function editAction(Request $request)
    {
        $category = $this->container->get('qb_blog.category_manager')->findCategoryBy(array(
            'id' => $request->get('id')
        ));

        if (null === $category) {
            throw new NotFoundHttpException('Category does not exist.');
        }

        $form    = $this->container->get('qb_blog.category.form');
        $handler = $this->container->get('qb_blog.category.form.handler');

        if ($handler->process($category)) {
            return new RedirectResponse($this->container->get('router')->generate('qb_blog_backend_category_list'));
        }

        return $this->container->get('templating')->renderResponse(
            'QbBlogBundle:Backend\Category:edit.html.'.$this->container->getParameter('qb_blog.template_engine'),
            array(
                'category' => $category,
                'form'     => $form->createView(),
            )
        );
    }

    /**
     * Deletes a category.
     *
     * @param  Request               $request
     * @throws NotFoundHttpException If the category does not exist.
     */
    public function deleteAction(Request $request)
    {
        $category = $this->container->get('qb_blog.category_manager')->findCategoryBy(array(
            'id' => $request->get('id')
        ));

        if (null === $category) {
            throw new NotFoundHttpException('Category does not exist.');
        }

        $csrf = $this->container->get('form.csrf_provider');

        if ($csrf->isCsrfTokenValid($category, $request->get('token'))) {
            $this->container->get('qb_blog.category_manager')->deleteCategory($category);
        }

        return new RedirectResponse($this->container->get('router')->generate('qb_blog_backend_category_list'));
    }
}
