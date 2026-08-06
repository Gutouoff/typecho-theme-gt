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
$gtRhTitle = trim((string) gt_option('heroTitle'));
if ($gtRhTitle === '') {
    $gtRhTitle = (string) $this->options->title;
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
    <link rel="stylesheet" href="<?php $this->options->themeUrl('style.css?v=20260806d'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/highlight.css?v=20260806d'); ?>">
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
    <div class="rh-inner">
        <span class="brand-code"><?php echo gt_option('brandCode', 'NO/001'); ?></span>
        <a class="rh-title" href="<?php $this->options->siteUrl(); ?>"><?php echo $gtRhTitle; ?></a>
        <div class="rh-right">
            <button type="button" class="theme-toggle" id="themeToggle" aria-label="<?php _e('切换深色模式'); ?>" aria-pressed="false" title="<?php _e('深色模式'); ?>">
                <span class="tt-glyph" aria-hidden="true">
                    <svg class="tt-sun" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="4.2"/>
                        <line x1="12" y1="2.2" x2="12" y2="4.6"/>
                        <line x1="12" y1="19.4" x2="12" y2="21.8"/>
                        <line x1="2.2" y1="12" x2="4.6" y2="12"/>
                        <line x1="19.4" y1="12" x2="21.8" y2="12"/>
                        <line x1="5.3" y1="5.3" x2="7.0" y2="7.0"/>
                        <line x1="17.0" y1="17.0" x2="18.7" y2="18.7"/>
                        <line x1="18.7" y1="5.3" x2="17.0" y2="7.0"/>
                        <line x1="7.0" y1="17.0" x2="5.3" y2="18.7"/>
                    </svg>
                    <svg class="tt-moon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.5 14.2A8.4 8.4 0 1 1 9.8 3.5a6.6 6.6 0 0 0 10.7 10.7z"/>
                    </svg>
                </span>
                <span class="tt-label" aria-hidden="true"></span>
            </button>
            <div class="rh-search" id="rhSearch">
                <form method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                    <button type="button" class="rs-trigger" id="rhSearchBtn" aria-label="<?php _e('搜索'); ?>" aria-expanded="false">
                        <svg class="rs-glyph" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="10.5" cy="10.5" r="6.5"/>
                            <line x1="15.4" y1="15.4" x2="20.5" y2="20.5"/>
                        </svg>
                        <span class="rs-label" aria-hidden="true">SEARCH</span>
                    </button>
                    <input type="text" name="s" id="rhSearchInput" placeholder="<?php _e('搜索…'); ?>" aria-label="<?php _e('搜索'); ?>">
                </form>
            </div>
        </div>
    </div>
</header>
<?php if (!$this->is('index')): ?>
<div class="back-home">
    <a href="<?php $this->options->siteUrl(); ?>"><?php _e('← HOME / 返回首页'); ?></a>
</div>
<?php endif; ?>
