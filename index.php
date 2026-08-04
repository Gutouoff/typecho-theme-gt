<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<?php
$gtHeroTitle = trim((string) gt_option('heroTitle'));
if ($gtHeroTitle === '') {
    $gtHeroTitle = (string) $this->options->title;
}
$gtHeroDesc = trim((string) gt_option('heroDesc'));
if ($gtHeroDesc === '') {
    $gtHeroDesc = trim((string) $this->options->description);
}
$gtFeatured = ('1' === gt_option('featuredCount', '1'));
$gtShowExcerpt = ('1' === gt_option('showExcerpt', '0'));
$gtShowCategory = ('1' === gt_option('showCategory', '1'));
$gtNo = 1;
?>
<main class="main" id="main">
    <div class="issue rv">
        <span class="issue-no"><span class="dot"></span><?php echo gt_option('heroLabel', 'ISSUE 001'); ?></span>
        <h1 class="issue-title"><?php echo $gtHeroTitle; ?></h1>
        <?php if ($gtHeroDesc !== ''): ?>
            <p class="issue-sub"><?php echo $gtHeroDesc; ?></p>
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
                <a class="issue-card<?php if ($gtFeatured): ?> featured<?php endif; ?>" href="<?php $this->permalink(); ?>">
                    <span class="issue-number"><?php echo str_pad((string) $gtNo, 2, '0', STR_PAD_LEFT); ?></span>
                    <span class="issue-card-title"><?php $this->title(); ?></span>
                    <?php if ($gtShowExcerpt): ?>
                        <span class="issue-excerpt"><?php $this->excerpt(90); ?></span>
                    <?php endif; ?>
                    <?php if ($gtShowCategory): ?>
                        <span class="issue-kicker"><?php $this->category(', ', false, _t('未分类')); ?></span>
                    <?php endif; ?>
                    <span class="issue-date"><span class="dot"></span><?php $this->date('Y.m.d'); ?></span>
                    <span class="issue-more"><?php _e('READ →'); ?></span>
                </a>
                <?php $gtFeatured = false; $gtNo++; ?>
            <?php endwhile; ?>
        </div>
        <?php $this->pageNav(_t('«'), _t('»'), 3, '…', array('wrapTag' => 'div', 'wrapClass' => 'page-nav', 'currentClass' => 'current')); ?>
    </section>
</main>

<?php $this->need('footer.php'); ?>
