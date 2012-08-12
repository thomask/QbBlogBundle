<?php

/*
 * This file is part of the QbBlogBundle package.
 *
 * (c) Quentin Berlemont <quentinberlemont@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Qb\Bundle\BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Post Type.
 *
 * @author Quentin Berlemont <quentinberlemont@gmail.com>
 */
class PostType extends AbstractType
{
    /**
     * @var string
     */
    private $class;

    /**
     * Constructor.
     *
     * @param string $class
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', null, array(
                'property' => 'name',
                'required' => false
            ))
            ->add('author')
            ->add('title')
            ->add('body')
            ->add('tags', null, array(
                'property' => 'name',
                'required' => false
            ))
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'qb_blog_post';
    }
}
