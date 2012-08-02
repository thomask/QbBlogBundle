<?php

/*
 * This file is part of the QbBlogBundle package.
 *
 * (c) Quentin Berlemont <quentinberlemont@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Qb\Bundle\BlogBundle\Form\Handler;

use Qb\Bundle\BlogBundle\Model\TagInterface;
use Qb\Bundle\BlogBundle\Model\TagManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class TagHandler
{
    private $form;
    private $request;
    private $tagManager;

    public function __construct(FormInterface $form, Request $request, TagManagerInterface $tagManager)
    {
        $this->form       = $form;
        $this->request    = $request;
        $this->tagManager = $tagManager;
    }

    public function process(TagInterface $tag = null)
    {
        if (null === $tag) {
            $tag = $this->tagManager->createTag();
        }

        $this->form->setData($tag);

        if ('POST' === $this->request->getMethod()) {
            $this->form->bindRequest($this->request);

            if ($this->form->isValid()) {
                $this->onSuccess($tag);

                return true;
            }
        }

        return false;
    }

    public function onSuccess(TagInterface $tag)
    {
        $this->tagManager->saveTag($tag);
    }
}
