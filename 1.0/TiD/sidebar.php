<!-- 侧边栏 -->
<div class="sidebar">
    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('First_sidebar')) : ?>
        <h4>分类目录</h4>
        <ul>
            <?php wp_list_categories('depth=1&title_li=&orderby=id&show_count=0&hide_empty=1&child_of=0'); ?>
        </ul>
        <h4>最近文章</h4>
        <ul>
            <?php
                $posts = get_posts('numberposts=6&orderby=post_date');
                foreach ($posts as $post) {
                    setup_postdata($post);
                    echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
                }
                $post = $posts[0];
                ?>
        </ul>
    <?php endif; ?>

    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Second_sidebar')) : ?>
        <h4>标签云</h4>
        <div class="tag-cloud">
            <?php
                $tags = get_tags();
                foreach ($tags as $tag) {
                    $tag_link = get_tag_link($tag->term_id);
                    echo "<a href='{$tag_link}' title='查看关于“{$tag->name}”的文章' rel='{$tag->name} Tag'>{$tag->name}</a>";
                } ?>
        </div>
    <?php endif; ?>
</div>