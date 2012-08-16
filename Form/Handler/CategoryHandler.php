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
 * Category Handler.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class CategoryHandler
{
    /**
     * @var FormInterface
     */
    protected $form;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var CategoryManagerInterface
     */
    protected $categoryManager;

    /**
     * Constructor.
     *
     * @param FormInterface            $form
     * @param Request                  $request
     * @param CategoryManagerInterface $categoryManager
     */
    public function __construct(FormInterface $form, Request $request, CategoryManagerInterface $categoryManager)
    {
        $this->form            = $form;
        $this->request         = $request;
        $this->categoryManager = $categoryManager;
    }

    /**
     * Processes the form submission.
     *
     * @param CategoryManagerInterface $categoryManager
     */
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

    /**
     * Defines a method handler for the success event, which executes when the
     * form submission completes successfully.
     *
     * @param CategoryManagerInterface $categoryManager
     */
    public function onSuccess(CategoryInterface $category)
    {
        $this->categoryManager->saveCategory($category);
    }
}
