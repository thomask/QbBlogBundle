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
 * Frontend Tag controller.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class TagController extends ContainerAware
{
    /**
     * Lists all tags.
     */
    public function listAction()
    {
        $tags = $this->container->get('qb_blog.tag_manager')->findTags();

        return $this->container->get('templating')->renderResponse(
            'QbBlogBundle:Frontend\Tag:list.html.'.$this->container->get('qb_blog.template_engine'),
            array(
                'tags' => $tags,
            )
        );
    }

    /**
     * Finds and displays a tag.
     *
     * @param  Request               $request
     * @throws NotFoundHttpException If the tag does not exist.
     */
    public function showAction(Request $request)
    {
        $tag = $this->container->get('qb_blog.tag_manager')->findTagBy(array(
            'slug' => $request->get('slug')
        ));

        if (null === $tag) {
            throw new NotFoundHttpException('Tag does not exist.');
        }

        return $this->container->get('templating')->renderResponse(
            'QbBlogBundle:Frontend\Tag:show.html.'.$this->container->get('qb_blog.template_engine'),
            array(
                'tag' => $tag,
            )
        );
    }
}
