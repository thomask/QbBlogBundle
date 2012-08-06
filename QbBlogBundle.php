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

use Qb\Bundle\BlogBundle\DependencyInjection\Compiler\ValidationPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class QbBlogBundle extends Bundle
{
    /**
     * @const DRIVER_DOCTRINE_ORM
     */
    const DRIVER_DOCTRINE_ORM = 'orm';

    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ValidationPass());
    }

    /**
     * Get supported storage.
     *
     * @return array
     */
    public static function getSupportedStorage()
    {
        return array(
            self::DRIVER_DOCTRINE_ORM
        );
    }
}
