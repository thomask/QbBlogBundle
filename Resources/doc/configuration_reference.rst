Configuration Reference
=======================

All available configuration options are listed below with their default values.

::

    # app/config/config.yml

    # Doctrine Extensions Configuration
    stof_doctrine_extensions:
        orm:
            default:
                sluggable:     true
                timestampable: true

    # QbBlog Configuration
    qb_blog:
        storage:            ~ # Required
        template_engine:    twig
        model_manager_name: null # change it to the name of your entity/document manager if you don't want to use the default one.
        category:
            category_class:   ~ # Required
            category_manager: qb_blog.category_manager.default
            form:
                type:    qb_blog_category
                handler: qb_blog.category.form.handler.default
                name:    qb_blog_category_form
        comment:
            comment_class:    ~ # Required
            category_manager: qb_blog.comment_manager.default
            form:
                type:    qb_blog_comment
                handler: qb_blog.comment.form.handler.default
                name:    qb_blog_comment_form
        post:
            post_class:       ~ # Required
            category_manager: qb_blog.post_manager.default
            form:
                type:    qb_blog_post
                handler: qb_blog.post.form.handler.default
                name:    qb_blog_post_form
        tag:
            tag_class:        ~ # Required
            category_manager: qb_blog.tag_manager.default
            form:
                type:    qb_blog_tag
                handler: qb_blog.tag.form.handler.default
                name:    qb_blog_tag_form
