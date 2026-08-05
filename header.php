<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
$gtLabel = _t('最新文章 / Latest');
if ($this->is('post')) {
    $gtLabel = _t('文章 / Post');
} elseif ($this->is('page')) {
    $gtLabel = _t('页面 / Page');
} elseif ($this->is('category')) {
    $gtLabel = _t('分类 / Category');
} elseif ($this->is('tag')) {
    $gtLabel = _t('标签 / Tag');
} elseif ($this->is('search')) {
    $gtLabel = _t('搜索 / Search');
} elseif ($this->is('date')) {
    $gtLabel = _t('归档 / Archive');
} elseif ($this->is('author')) {
    $gtLabel = _t('作者 / Author');
} elseif ($this->is('404')) {
    $gtLabel = _t('迷路了 / 404');
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <title><?php $this->archiveTitle(array(
            'category' => _t('分类 %s'),
            'search'   => _t('搜索 %s'),
            'tag'      => _t('标签 %s'),
            'author'   => _t('作者 %s')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('style.css?v=20260805b'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/highlight.css?v=20260805b'); ?>">
    <style><?php echo gt_theme_css(); ?></style>
    <?php $this->header(); ?>
    <?php $gtCustomHead = trim((string) $this->options->customHead); if ($gtCustomHead !== ''): ?>
        <?php echo $gtCustomHead; ?>
    <?php endif; ?>
    <?php $gtCustomCss = trim((string) $this->options->customCss); if ($gtCustomCss !== ''): ?>
        <style><?php echo $gtCustomCss; ?></style>
    <?php endif; ?>
</head>
<body class="<?php echo gt_body_class($this); ?>">

<header class="rh" id="rh">
    <a class="rh-word" href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>
    <span class="brand-code"><?php echo gt_option('brandCode', 'GT/001'); ?></span>
    <button type="button" class="theme-toggle" id="themeToggle" aria-label="<?php _e('切换深色模式'); ?>" aria-pressed="false" title="<?php _e('深色模式'); ?>">
        <span class="tt-track"><span class="tt-thumb"></span></span>
    </button>
    <div class="rh-search" id="rhSearch">
        <form method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
            <input type="text" name="s" id="rhSearchInput" placeholder="<?php _e('搜索…'); ?>" aria-label="<?php _e('搜索'); ?>">
            <button type="submit" id="rhSearchBtn" aria-label="<?php _e('搜索'); ?>"><?php _e('搜索'); ?></button>
        </form>
    </div>
</header>
<?php if (!$this->is('index')): ?>
<div class="back-home">
    <a href="<?php $this->options->siteUrl(); ?>"><?php _e('← HOME / 返回首页'); ?></a>
</div>
<?php endif; ?>
