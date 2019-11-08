<?php get_header(); ?>
<!-- 文章列表 -->
<div class="article-list">
    <!-- 循环读取文章 -->
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="post">
                <!-- 标题 -->
                <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <!-- 标签、日期等 -->
                <p class="sub"><?php the_tags('标签：', ', ', ''); ?> &bull; <?php the_time('Y年n月j日') ?> &bull; <?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?><?php edit_post_link('编辑', ' &bull; ', ''); ?></p>
                <!-- 图片 -->
                <?php $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
                        if ($large_image_url[0] != "") : ?>
                    <img class="thumb" alt="<?php the_title(); ?>" src="<?php echo $large_image_url[0]; ?>" />
                <?php endif; ?>
                <!-- 文章简述 -->
                <?php the_excerpt(); ?>
            </div>
        <?php endwhile; ?>

    <?php else : ?>
        <h3 class="title"><a href="#" rel="bookmark">未找到</a></h3>
        <p>没有找到任何文章！</p>
    <?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>