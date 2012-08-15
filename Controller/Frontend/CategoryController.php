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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Category Controller.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class CategoryController extends ContainerAware
{
    /**
     * Finds and displays a category.
     *
     * @param  string                $slug
     * @throws NotFoundHttpException If the category does not exist.
     */
    public function showAction($slug)
    {
        $category = $this->container->get('qb_blog.category_manager')->findCategoryBy(array(
            'slug' => $slug
        ));

        if (null === $category) {
            throw new NotFoundHttpException('Category does not exist.');
        }

        return $this->container->get('templating')->renderResponse(
            'QbBlogBundle:Frontend/Category:show.html.'.$this->container->getParameter('qb_blog.template_engine'),
            array(
                'category' => $category,
            )
        );
    }
}
