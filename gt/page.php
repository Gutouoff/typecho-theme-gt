<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<main class="main" id="main">
    <article class="entry">
        <header class="entry-head rv">
            <div class="entry-kicker"><?php _e('页面 / Page'); ?></div>
            <h1 class="entry-title"><?php $this->title(); ?></h1>
            <div class="entry-meta">
                <span class="meta-item"><?php $this->date('Y.m.d'); ?></span>
                <?php if ($this->user->hasLogin()): ?>
                    <span class="meta-item"><a href="<?php $this->options->adminUrl('write-page.php?cid=' . $this->cid); ?>"><?php _e('编辑'); ?></a></span>
                <?php endif; ?>
            </div>
        </header>
        <div class="sr rv"></div>
        <div class="entry-content rv">
            <?php $this->content(); ?>
        </div>
    </article>

    <?php $this->need('comments.php'); ?>
</main>

<?php $this->need('footer.php'); ?>
