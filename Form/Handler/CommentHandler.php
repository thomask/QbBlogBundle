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

use Qb\Bundle\BlogBundle\Model\CommentInterface;
use Qb\Bundle\BlogBundle\Model\CommentManagerInterface;
use Qb\Bundle\BlogBundle\Model\PostInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Comment form handler.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class CommentHandler
{
    /**
     * @var FormInterface $form
     */
    private $form;

    /**
     * @var Request $request
     */
    private $request;

    /**
     * @var CommentManagerInterface $categoryManager
     */
    private $commentManager;

    /**
     * Constructor.
     *
     * @param FormInterface           $form
     * @param Request                 $request
     * @param CommentManagerInterface $commentManager
     */
    public function __construct(FormInterface $form, Request $request, CommentManagerInterface $commentManager)
    {
        $this->form           = $form;
        $this->request        = $request;
        $this->commentManager = $commentManager;
    }

    /**
     * Handles the form submission.
     *
     * @param CommentInterface $comment
     * @param PostInterface    $post
     */
    public function process(CommentInterface $comment = null, PostInterface $post = null)
    {
        if (null === $comment) {
            $comment = $this->commentManager->createComment();
        }

        if (null !== $post) {
            $comment->setPost($post);
        }

        $this->form->setData($comment);

        if ('POST' === $this->request->getMethod()) {
            $this->form->bindRequest($this->request);

            if ($this->form->isValid()) {
                $this->onSuccess($comment);

                return true;
            }
        }

        return false;
    }

    /**
     * Manipulates data from validated form submission.
     *
     * @param CommentInterface $comment
     */
    public function onSuccess(CommentInterface $comment)
    {
        $this->commentManager->saveComment($comment);
    }
}