<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<?php
$gtSub = trim((string) gt_option('heroSub'));
if ($gtSub === '') {
    $gtSub = trim((string) $this->options->description);
}
$gtFirst = ('1' === gt_option('showFeatured', '1'));
$gtNo = 1;
?>
<main class="main" id="main">
    <div class="issue rv">
        <span class="issue-no"><span class="dot"></span><?php echo gt_option('issueLabel', 'ISSUE 001'); ?></span>
        <h1 class="issue-title"><?php $this->options->title(); ?></h1>
        <?php if ($gtSub !== ''): ?>
            <p class="issue-sub"><?php echo $gtSub; ?></p>
        <?php endif; ?>
    </div>

    <section class="sec">
        <header class="sh rv">
            <span class="sn">No.01</span>
            <h2 class="st"><?php _e('最新文章'); ?> <em><?php _e('/ Latest'); ?></em></h2>
        </header>
        <div class="sr rv"></div>
        <div class="issue-grid rv-s">
            <?php while ($this->next()): ?>
                <a class="issue-card<?php if ($gtFirst): ?> featured<?php endif; ?>" href="<?php $this->permalink(); ?>">
                    <span class="issue-number"><?php echo str_pad((string) $gtNo, 2, '0', STR_PAD_LEFT); ?></span>
                    <span class="issue-kicker"><?php $this->category(', ', false, _t('未分类')); ?></span>
                    <span class="issue-date"><span class="dot"></span><?php $this->date('Y.m.d'); ?></span>
                    <span class="issue-card-title"><?php $this->title(); ?></span>
                    <span class="issue-more"><?php _e('READ →'); ?></span>
                </a>
                <?php $gtFirst = false; $gtNo++; ?>
            <?php endwhile; ?>
        </div>
        <?php $this->pageNav(_t('«'), _t('»'), 3, '…', array('wrapTag' => 'div', 'wrapClass' => 'page-nav', 'currentClass' => 'current')); ?>
    </section>
</main>

<?php $this->need('footer.php'); ?>
