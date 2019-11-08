<?php get_header(); ?>
<!-- 页面 -->
<!-- 文章列表 -->
<div class="article-list">
    <div class="sorting">
        <div class="sort-by">
            <h4>排序</h4>
            <ul>
                <li><a <?php if (isset($_GET['order']) && ($_GET['order'] == 'rand')) echo 'class="current"'; ?> href="<?php echo curPageURL() . '?' . http_build_query(array_merge($_GET, array('order' => 'rand'))); ?>">随机阅读</a></li>
                <li><a <?php if (isset($_GET['order']) && ($_GET['order'] == 'commented')) echo 'class="current"'; ?> href="<?php echo curPageURL() . '?' . http_build_query(array_merge($_GET, array('order' => 'commented'))); ?>">评论最多</a></li>
                <li><a <?php if (isset($_GET['order']) && ($_GET['order'] == 'alpha')) echo 'class="current"'; ?> href="<?php echo curPageURL() . '?' . http_build_query(array_merge($_GET, array('order' => 'alpha'))); ?>">标题排序</a></li>
            </ul>
        </div>
        <h4>浏览<?php
                // If this is a category archive
                if (is_category()) {
                    printf('分类</h4>
			<h2>' . single_cat_title('', false) . '</h2>');
                    if (category_description()) echo '<p>' . category_description() . '</p>';
                    // If this is a tag archive
                } elseif (is_tag()) {
                    printf('标签</h4>
			<h2>' . single_tag_title('', false) . '</h2>');
                    if (tag_description()) echo '<p>' . tag_description() . '</p>';
                    // If this is a daily archive
                } elseif (is_day()) {
                    printf('日期存档</h4>
			<h2>' . get_the_time('Y年n月j日') . '</h2>');
                    // If this is a monthly archive
                } elseif (is_month()) {
                    printf('月份存档</h4>
				<h2>' . get_the_time('Y年n月') . '</h2>');
                    // If this is a yearly archive
                } elseif (is_year()) {
                    printf('年份存档</h4>
				<h2>' . get_the_time('Y年') . '</h2>');
                    // If this is an author archive
                } elseif (is_author()) {
                    echo '</h4><h2>作者存档</h2>';
                    // If this is a paged archive
                } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
                    echo '</h4><h2>博客存档</h2>';
                }
                ?>
    </div>
    <?php
    global $wp_query;

    if (isset($_GET['order']) && ($_GET['order'] == 'rand')) {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'orderby' => 'rand',
            'paged' => $paged,
        );
        $arms = array_merge(
            $args,
            $wp_query->query
        );
        query_posts($arms);
    } else if (isset($_GET['order']) && ($_GET['order'] == 'commented')) {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'orderby' => 'comment_count',
            'order' => 'DESC',
            'paged' => $paged,
        );
        $arms = array_merge(
            $args,
            $wp_query->query
        );
        query_posts($arms);
    } else if (isset($_GET['order']) && ($_GET['order'] == 'alpha')) {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'orderby' => 'title',
            'order' => 'ASC',
            'paged' => $paged,
        );
        $arms = array_merge(
            $args,
            $wp_query->query
        );
        query_posts($arms);
    }
    // 循环读取文章
    if (have_posts()) : while (have_posts()) : the_post(); ?>
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