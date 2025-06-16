<?php if ($is_preview) : ?>
    CONTENT OPEN
<?php else : ?>
    <?php $is_blog_post = is_page_template( 'template-posts/new-blog-post.php' ); ?>
    <div class="col-12 col-lg-8 <?php echo $is_blog_post ? ' new-blog-post-main-content ' : 'mt-5 mt-lg-0'; ?>">
<?php endif; ?>