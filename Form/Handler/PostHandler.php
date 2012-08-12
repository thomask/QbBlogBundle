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

use Qb\Bundle\BlogBundle\Model\PostInterface;
use Qb\Bundle\BlogBundle\Model\PostManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Post Handler.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class PostHandler
{
    /**
     * @var FormInterface
     */
    private $form;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var PostManagerInterface
     */
    private $postManager;

    /**
     * Constructor.
     *
     * @param FormInterface        $form
     * @param Request              $request
     * @param PostManagerInterface $postManager
     */
    public function __construct(FormInterface $form, Request $request, PostManagerInterface $postManager)
    {
        $this->form        = $form;
        $this->request     = $request;
        $this->postManager = $postManager;
    }

    /**
     * Handles the form submission.
     *
     * @param PostInterface $post
     */
    public function process(PostInterface $post = null)
    {
        if (null === $post) {
            $post = $this->postManager->createPost();
        }

        $this->form->setData($post);

        if ('POST' === $this->request->getMethod()) {
            $this->form->bindRequest($this->request);

            if ($this->form->isValid()) {
                $this->onSuccess($post);

                return true;
            }
        }

        return false;
    }

    /**
     * Manipulates data from validated form submission.
     *
     * @param PostInterface $post
     */
    public function onSuccess(PostInterface $post)
    {
        $this->postManager->savePost($post);
    }
}
