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
 * Tag Controller.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class TagController extends ContainerAware
{
    /**
     * Finds and displays a tag.
     *
     * @param  string                $slug
     * @throws NotFoundHttpException If the tag does not exist.
     */
    public function showAction($slug)
    {
        $tag = $this->container->get('qb_blog.tag_manager')->findTagBy(array(
            'slug' => $slug
        ));

        if (null === $tag) {
            throw new NotFoundHttpException('Tag does not exist.');
        }

        return $this->container->get('templating')->renderResponse(
            'QbBlogBundle:Frontend/Tag:show.html.'.$this->container->getParameter('qb_blog.template_engine'),
            array(
                'tag' => $tag,
            )
        );
    }
}
