<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<main class="main" id="main">
    <section class="err-wrap rv">
        <div class="err-code">404</div>
        <p class="err-sub"><?php _e('这个页面不存在，可能已被移动或删除。'); ?></p>
        <a class="err-link" href="<?php $this->options->siteUrl(); ?>"><?php _e('返回首页 / Back to Home →'); ?></a>
    </section>
</main>

<?php $this->need('footer.php'); ?>
