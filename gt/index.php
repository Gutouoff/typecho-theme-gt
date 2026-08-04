<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<?php
$gtSub = trim((string) $this->options->description);
$gtFirst = true;
$gtNo = 1;
?>
<main class="main" id="main">
    <div class="masthead rv">
        <span class="mh-kicker"><?php _e('Personal Blog — 独立博客'); ?></span>
        <h1 class="mh-title"><?php $this->options->title(); ?></h1>
        <?php if ($gtSub !== ''): ?>
            <p class="mh-sub"><?php echo $gtSub; ?></p>
        <?php endif; ?>
        <span class="mh-vol"><?php _e('Vol.01 —'); ?> <?php echo date('Y'); ?></span>
    </div>

    <section class="sec">
        <header class="sh rv">
            <span class="sn">No.01</span>
            <h2 class="st"><?php _e('最新文章'); ?> <em><?php _e('/ Latest'); ?></em></h2>
        </header>
        <div class="sr rv"></div>
        <div class="post-grid rv-s">
            <?php while ($this->next()): ?>
                <a class="post-card<?php if ($gtFirst): ?> featured<?php endif; ?>" href="<?php $this->permalink(); ?>">
                    <span class="post-no"><?php echo str_pad((string) $gtNo, 2, '0', STR_PAD_LEFT); ?></span>
                    <span class="post-kicker"><?php $this->category(', ', false, _t('未分类')); ?></span>
                    <span class="post-date"><?php $this->date('Y.m.d'); ?></span>
                    <span class="post-title"><?php $this->title(); ?></span>
                    <span class="post-more"><?php _e('阅读全文 / Read →'); ?></span>
                </a>
                <?php $gtFirst = false; $gtNo++; ?>
            <?php endwhile; ?>
        </div>
        <?php $this->pageNav(_t('«'), _t('»'), 3, '…', array('wrapTag' => 'div', 'wrapClass' => 'page-nav', 'currentClass' => 'current')); ?>
    </section>
</main>

<?php $this->need('footer.php'); ?>
