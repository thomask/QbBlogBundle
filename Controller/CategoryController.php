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
 * Category controller.
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

        return $this->container->get('templating')->renderResponse('QbBlogBundle:Category:list.html.twig', array(
            'categories' => $categories,
        ));
    }

    /**
     * Displays and handles a form to create a new category.
     */
    public function newAction()
    {
        $form    = $this->container->get('qb_blog.category.form');
        $handler = $this->container->get('qb_blog.category.form.handler');

        if ($handler->process()) {
            return new RedirectResponse($this->container->get('router')->generate('qb_blog_category_list'));
        }

        return $this->container->get('templating')->renderResponse('QbBlogBundle:Category:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a category.
     *
     * @param Request $request
     */
    public function showAction(Request $request)
    {
        $category = $this->container->get('qb_blog.category_manager')->findCategoryBy(array(
            'slug' => $request->get('slug')
        ));

        if (null === $category) {
            throw new NotFoundHttpException('Unable to find category.');
        }

        return $this->container->get('templating')->renderResponse('QbBlogBundle:Category:show.html.twig', array(
            'category' => $category,
        ));
    }

    /**
     * Displays and handles a form to edit an existing category.
     *
     * @param Request $request
     */
    public function editAction(Request $request)
    {
        $category = $this->container->get('qb_blog.category_manager')->findCategoryBy(array(
            'slug' => $request->get('slug')
        ));

        if (null === $category) {
            throw new NotFoundHttpException('Unable to find category.');
        }

        $form    = $this->container->get('qb_blog.category.form');
        $handler = $this->container->get('qb_blog.category.form.handler');

        if ($handler->process($category)) {
            return new RedirectResponse($this->container->get('router')->generate('qb_blog_category_list'));
        }

        return $this->container->get('templating')->renderResponse('QbBlogBundle:Category:edit.html.twig', array(
            'category' => $category,
            'form'     => $form->createView(),
        ));
    }

    /**
     * Deletes a category.
     *
     * @param Request $request
     */
    public function deleteAction(Request $request)
    {
        $category = $this->container->get('qb_blog.category_manager')->findCategoryBy(array(
            'slug' => $request->get('slug')
        ));

        if (null === $category) {
            throw new NotFoundHttpException('Unable to find category.');
        }

        $csrf = $this->container->get('form.csrf_provider');

        if ($csrf->isCsrfTokenValid($category, $request->get('token'))) {
            $this->container->get('qb_blog.category_manager')->deleteCategory($category);
        }

        return new RedirectResponse($this->container->get('router')->generate('qb_blog_category_list'));
    }
}
