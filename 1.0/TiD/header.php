<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php if (is_home()) {
                bloginfo('name');
                echo " | ";
                bloginfo('description');
            } elseif (is_category()) {
                single_cat_title();
                echo " | ";
                bloginfo('name');
            } elseif (is_single() || is_page()) {
                single_post_title();
                echo " | ";
                bloginfo('name');
            } elseif (is_search()) {
                echo "搜索结果";
                echo " | ";
                bloginfo('name');
            } elseif (is_404()) {
                echo '页面未找到!';
            } else {
                wp_title('', true);
            } ?></title>
    <!-- 关键词、描述 -->
    <?php
    if (is_home() || is_page()) {
        $description = '小tid笔记，记录各种技术性文章，为大家提供简单、有效的、易上手的各种技术和便捷功能，有问题随时欢迎留言提问';
        $keywords = 'TiD,小tid,小tid笔记,tidnotes,技术,wordpress,前端,js';
    } elseif (is_single()) {
        if ($post->post_excerpt) { //如果文章摘要存在就以文章摘要为描述
            $description = $post->post_excerpt;
            $description = str_replace("\r\n", "", $description);
            $description = str_replace("\n", "", $description);
            $description = str_replace("\"", "'", $description);
            $description .= '...';
        } else { //如果文章摘要不存在就截断文章前200字为描述
            $description = mb_strimwidth(strip_tags($post->post_content), 0, 200, "");
            $description = str_replace("\r\n", "", $description);
            $description = str_replace("\n", "", $description);
            $description = str_replace("\"", "'", $description);
            $description .= '...';
        }
        $keywords = "";
        $tags = wp_get_post_tags($post->ID);
        foreach ($tags as $tag) {
            $keywords = $keywords . $tag->name . ",";
        }
    } elseif (is_category()) {
        $description = category_description() ? category_description() : single_cat_title('', false);
        $keywords = single_cat_title('', false);
    } elseif (is_tag()) {
        $keywords = single_tag_title('', false);
        $description = "关于标签 " . $keywords . " 的相关文章";
    }
    $description = trim(strip_tags($description));
    $keywords = trim(strip_tags($keywords));
    ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <meta name="keywords" content="<?php echo $keywords; ?>" />
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有文章" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <!-- 样式表 -->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
</head>

<body>
    <header class="banner banner-pattern-seaOfClouds">
        <h2><?php bloginfo('name'); ?></h2>
        <h3><?php bloginfo('description'); ?></h3>
    </header>