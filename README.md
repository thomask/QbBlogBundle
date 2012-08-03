QbBlogBundle
============

Symfony QbBlogBundle is a simple-but-powerful blog bundle for Symfony 2.1

**This bundle is compatible only with 2.1.x branch of Symfony2.**

## Installation

### Step 1: Download QbBlogBundle using composer

Add QbBlogBundle in your composer.json:

```js
{
    "require": {
        "qb/blog-bundle": "*"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update qb/blog-bundle
```

Composer will install the bundle to your project's `vendor/qb` directory.

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Qb\Bundle\BlogBundle\QbBlogBundle(),
    );
}
```

### Step 3: Create your entities class

``` php
<?php
// src/Acme/BlogBundle/Entity/Category.php

namespace Acme\BlogBundle\Entity;

use Qb\Bundle\BlogBundle\Entity\Category as BaseCategory;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="acme_blog_categories")
 */
class Category extends BaseCategory
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="category")
     */
    protected $posts;
}
```

``` php
<?php
// src/Acme/BlogBundle/Entity/Comment.php

namespace Acme\BlogBundle\Entity;

use Qb\Bundle\BlogBundle\Entity\Comment as BaseComment;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="acme_blog_comments")
 */
class Comment extends BaseComment
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    protected $post;
}
```

``` php
<?php
// src/Acme/BlogBundle/Entity/Post.php

namespace Acme\BlogBundle\Entity;

use Qb\Bundle\BlogBundle\Entity\Post as BasePost;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="acme_blog_posts")
 */
class Post extends BasePost
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="posts")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $category;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="posts")
     * @ORM\JoinTable(name="acme_posts_tags",
     *      joinColumns={@ORM\JoinColumn(name="post_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     * )
     */
    protected $tags;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post", cascade={"remove"}))
     */
    protected $comments;
}
```

``` php
<?php
// src/Acme/BlogBundle/Entity/Tag.php

namespace Acme\BlogBundle\Entity;

use Qb\Bundle\BlogBundle\Entity\Tag as BaseTag;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="acme_blog_tags")
 */
class Tag extends BaseTag
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="tags")
     */
    protected $posts;
}
```

### Step 4: Configure the QbBlogBundle

``` yaml
# app/config/config.yml

# QbBlog Configuration
qb_blog:
    db_driver: orm
    category:
        category_class: Acme\BlogBundle\Entity\Category
    comment:
        comment_class: Acme\BlogBundle\Entity\Comment
    post:
        post_class: Acme\BlogBundle\Entity\Post
    tag:
        tag_class: Acme\BlogBundle\Entity\Tag
```

### Step 5: Import QbBlogBundle routing files

``` yaml
# app/config/routing.yml

# QbBlog Routing
qb_blog_category:
    resource: @QbBlogBundle/Resources/config/routing/category.xml
    prefix:   /category

qb_blog_comment:
    resource: @QbBlogBundle/Resources/config/routing/comment.xml
    prefix:   /comment

qb_blog_post:
    resource: @QbBlogBundle/Resources/config/routing/post.xml
    prefix:   /post

qb_blog_tag:
    resource: @QbBlogBundle/Resources/config/routing/tag.xml
    prefix:   /tag
```

### Step 6: Update your database schema

``` bash
$ php app/console doctrine:schema:update --force
```

### Step 7: Create your own views by overriding QbBlogbundle !

``` php
<?php
// src/Acme/BlogBundle/BlogBundle.php

namespace Acme\BlogBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AcmeBlogBundle extends Bundle
{
    public function getParent()
    {
        return 'QbBlogBundle';
    }
}
```

For more information about bundle inheritance, check [Symfony documentation](http://symfony.com/doc/current/cookbook/bundles/inheritance.html).