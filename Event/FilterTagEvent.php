<?php

/*
 * This file is part of the QbBlogBundle package.
 *
 * (c) Quentin Berlemont <quentinberlemont@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Qb\Bundle\BlogBundle\Event;

use Qb\Bundle\BlogBundle\Model\TagInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Filter Tag Event.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class FilterTagEvent extends Event
{
    /**
     * @var TagInterface
     */
    protected $tag;

    /**
     * Constructor.
     *
     * @param TagInterface $tag
     */
    public function __construct(TagInterface $tag)
    {
        $this->tag = $tag;
    }

    /**
     * Get tag.
     *
     * @return TagInterface
     */
    public function getTag()
    {
        return $this->tag;
    }
}