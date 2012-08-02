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

use Qb\Bundle\BlogBundle\Model\CategoryInterface;
use Qb\Bundle\BlogBundle\Model\CategoryManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class CategoryHandler
{
    private $form;
    private $request;
    private $categoryManager;

    public function __construct(FormInterface $form, Request $request, CategoryManagerInterface $categoryManager)
    {
        $this->form            = $form;
        $this->request         = $request;
        $this->categoryManager = $categoryManager;
    }

    public function process(CategoryInterface $category = null)
    {
        if (null === $category) {
            $category = $this->categoryManager->createCategory();
        }

        $this->form->setData($category);

        if ('POST' === $this->request->getMethod()) {
            $this->form->bindRequest($this->request);

            if ($this->form->isValid()) {
                $this->onSuccess($category);

                return true;
            }
        }

        return false;
    }

    public function onSuccess(CategoryInterface $category)
    {
        $this->categoryManager->saveCategory($category);
    }
}
