<?php get_header(); ?>
<!-- 页面内容 -->
<?php if (have_posts()) : the_post();
    update_post_caches($posts); ?>
    <!-- 标题 -->
    <h2 class="title"><?php the_title(); ?></h2>
    <!-- 标签等 -->
    <p class="sub"><?php the_tags('标签：', ', ', ''); ?> &bull; <?php the_time('Y年n月j日') ?> &bull; <?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?><?php edit_post_link('编辑', ' &bull; ', ''); ?></p>
    <div class="article">
        <!-- 正文 -->
        <?php the_content(); ?>
        <!-- 评论 -->
        <?php comments_template(); ?>
    </div>
<?php else : ?>
    <div class="errorbox">
        没有找到你想要的页面！
    </div>
<?php endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>