<?php

/*
 * This file is part of the QbBlogBundle package.
 *
 * (c) Quentin Berlemont <quentinberlemont@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Qb\Bundle\BlogBundle\DependencyInjection\Compiler;

use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Registers the additional validators according to the db driver.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class ValidationPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasParameter('qb_blog.db_driver')
            || !$container->hasParameter('validator.mapping.loader.xml_files_loader.mapping_files')
        ) {
            return;
        }

        $files = $container->getParameter('validator.mapping.loader.xml_files_loader.mapping_files');
        $validationFile = __DIR__.'/../../Resources/config/validation/'.$container->getParameter('qb_blog.db_driver').'.xml';

        if (is_file($validationFile)) {
            $files[] = realpath($validationFile);
            $container->addResource(new FileResource($validationFile));
        }

        $container->setParameter('validator.mapping.loader.xml_files_loader.mapping_files', $files);
    }
}
