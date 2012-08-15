<?php

/*
 * This file is part of the QbBlogBundle package.
 *
 * (c) Quentin Berlemont <quentinberlemont@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Qb\Bundle\BlogBundle;

/**
 * QbBlogEvents.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
final class QbBlogEvents
{
    /**
     * The `CATEGORY_CREATE` event is thrown each time a category is created
     * in the system.
     *
     * The event listener receives an Qb\BlogBundle\Event\FilterCategoryEvent
     * instance.
     *
     * @var string
     */
    const CATEGORY_CREATE = 'qb_blog.category.create';

    /**
     * The `CATEGORY_PRE_SAVE` event is thrown before each time a category is
     * saved in the system.
     *
     * The event listener receives an Qb\BlogBundle\Event\FilterCategoryEvent
     * instance.
     *
     * @var string
     */
    const CATEGORY_PRE_SAVE = 'qb_blog.category.pre_save';

    /**
     * The `CATEGORY_POST_SAVE` event is thrown after each time a category is
     * saved in the system.
     *
     * The event listener receives an Qb\BlogBundle\Event\FilterCategoryEvent
     * instance.
     *
     * @var string
     */
    const CATEGORY_POST_SAVE = 'qb_blog.category.post_save';

    /**
     * The `CATEGORY_PRE_DELETE` event is thrown before each time a category is
     * deleted in the system.
     *
     * The event listener receives an Qb\BlogBundle\Event\FilterCategoryEvent
     * instance.
     *
     * @var string
     */
    const CATEGORY_PRE_DELETE = 'qb_blog.category.pre_delete';

    /**
     * The `CATEGORY_POST_DELETE` event is thrown after each time a category is
     * deleted in the system.
     *
     * The event listener receives an Qb\BlogBundle\Event\FilterCategoryEvent
     * instance.
     *
     * @var string
     */
    const CATEGORY_POST_DELETE = 'qb_blog.category.post_delete';

    /**
     * The `COMMENT_CREATE` event is thrown each time a comment is created
     * in the system.
     *
     * The event listener receives an Qb\BlogBundle\Event\FilterCommentEvent
     * instance.
     *
     * @var string
     */
    const COMMENT_CREATE = 'qb_blog.comment.create';

    /**
     * The `COMMENT_PRE_SAVE` event is thrown before each time a comment is
     * saved in the system.
     *
     * The event listener receives an Qb\BlogBundle\Event\FilterCommentEvent
     * instance.
     *
     * @var string
     */
    const COMMENT_PRE_SAVE = 'qb_blog.comment.pre_save';

    /**
     * The `COMMENT_POST_SAVE` event is thrown after each time a comment is
     * saved in the system.
     *
     * The event listener receives an Qb\BlogBundle\Event\FilterCommentEvent
     * instance.
     *
     * @var string
     */
    const COMMENT_POST_SAVE = 'qb_blog.comment.post_save';

    /**
     * The `COMMENT_PRE_DELETE` event is thrown before each time a comment is
     * deleted in the system.
     *
     * The event listener receives an Qb\BlogBundle\Event\FilterCommentEvent
     * instance.
     *
     * @var string
     */
    const COMMENT_PRE_DELETE = 'qb_blog.comment.pre_delete';

    /**
     * The `COMMENT_POST_DELETE` event is thrown after each time a comment is
     * deleted in the system.
     *
     * The event listener receives an Qb\BlogBundle\Event\FilterCommentEvent
     * instance.
     *
     * @var string
     */
    const COMMENT_POST_DELETE = 'qb_blog.comment.post_delete';

    /**
     * The `POST_CREATE` event is thrown each time a post is created in the
     * system.
     *
     * The event listener receives an Qb\BlogBundle\Event\FilterPostEvent
     * instance.
     *
     * @var string
     */
    const POST_CREATE = 'qb_blog.post.create';

    /**
     * The `POST_PRE_SAVE` event is thrown before each time a post is saved
     * in the system.
     *
     * The event listener receives an Qb\BlogBundle\Event\FilterPostEvent
     * instance.
     *
     * @var string
     */
    const POST_PRE_SAVE = 'qb_blog.post.pre_save';

    /**
     * The `POST_POST_SAVE` event is thrown after each time a post is saved
     * in the system.
     *
     * The event listener receives an Qb\BlogBundle\Event\FilterPostEvent
     * instance.
     *
     * @var string
     */
    const POST_POST_SAVE = 'qb_blog.post.post_save';

    /**
     * The `POST_PRE_DELETE` event is thrown before each time a post is deleted
     * in the system.
     *
     * The event listener receives an Qb\BlogBundle\Event\FilterPostEvent
     * instance.
     *
     * @var string
     */
    const POST_PRE_DELETE = 'qb_blog.post.pre_delete';

    /**
     * The `POST_POST_DELETE` event is thrown after each time a post is deleted
     * in the system.
     *
     * The event listener receives an Qb\BlogBundle\Event\FilterPostEvent
     * instance.
     *
     * @var string
     */
    const POST_POST_DELETE = 'qb_blog.post.post_delete';

    /**
     * The `TAG_CREATE` event is thrown each time a tag is created in the system.
     *
     * The event listener receives an Qb\BlogBundle\Event\FilterCOMMENTEvent
     * instance.
     *
     * @var string
     */
    const TAG_CREATE = 'qb_blog.tag.create';

    /**
     * The `TAG_PRE_SAVE` event is thrown before each time a tag is saved in the
     * system.
     *
     * The event listener receives an Qb\BlogBundle\Event\FilterTagEvent
     * instance.
     *
     * @var string
     */
    const TAG_PRE_SAVE = 'qb_blog.tag.pre_save';

    /**
     * The `TAG_POST_SAVE` event is thrown after each time a tag is saved in the
     * system.
     *
     * The event listener receives an Qb\BlogBundle\Event\FilterTagEvent
     * instance.
     *
     * @var string
     */
    const TAG_POST_SAVE = 'qb_blog.tag.post_save';

    /**
     * The `TAG_PRE_DELETE` event is thrown before each time a tag is deleted in
     * the system.
     *
     * The event listener receives an Qb\BlogBundle\Event\FilterTagEvent
     * instance.
     *
     * @var string
     */
    const TAG_PRE_DELETE = 'qb_blog.tag.pre_delete';

    /**
     * The `TAG_POST_DELETE` event is thrown after each time a tag is deleted in
     * the system.
     *
     * The event listener receives an Qb\BlogBundle\Event\FilterTagEvent
     * instance.
     *
     * @var string
     */
    const TAG_POST_DELETE = 'qb_blog.tag.post_delete';
}