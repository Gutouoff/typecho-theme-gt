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
?>
<main class="main" id="main">
    <?php if ('1' === gt_option('heroShow', '1')): ?>
    <div class="issue rv">
        <span class="issue-no"><span class="dot"></span><?php echo gt_option('heroLabel', 'ISSUE 001'); ?></span>
        <h1 class="issue-title"><?php echo $gtHeroTitle; ?></h1>
        <?php if ($gtHeroDesc !== ''): ?>
            <p class="issue-sub"><?php echo $gtHeroDesc; ?></p>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <section class="sec">
        <header class="sh rv">
            <h2 class="st"><?php _e('最新文章'); ?> <em><?php _e('/ Latest'); ?></em></h2>
        </header>
        <div class="sr rv"></div>
        <div class="issue-grid rv-s"<?php if ('1' === gt_option('gridColumns', '2')): ?> style="grid-template-columns:1fr"<?php endif; ?>>
            <?php while ($this->next()): ?>
                <a class="issue-card<?php if ($gtFeatured): ?> featured<?php endif; ?>" href="<?php $this->permalink(); ?>">
                    <span class="issue-card-title"><?php $this->title(); ?></span>
                    <?php if ($gtShowExcerpt || $gtFeatured): ?>
                        <span class="issue-excerpt"><?php $this->excerpt(110); ?></span>
                    <?php endif; ?>
                    <?php $gtStatus = gt_post_status($this); ?>
                    <?php if ($gtStatus !== ''): ?>
                        <span class="issue-status<?php echo $gtStatus === 'NEW' ? ' is-new' : ' is-updated'; ?>"><span class="dot"></span><?php echo $gtStatus; ?></span>
                    <?php endif; ?>
                    <span class="issue-date"><span class="dot"></span><?php $this->date('Y.m.d'); ?></span>
                    <span class="issue-more"><?php _e('READ →'); ?></span>
                </a>
                <?php $gtFeatured = false; ?>
            <?php endwhile; ?>
        </div>
        <?php $this->pageNav(_t('«'), _t('»'), 3, '…', array('wrapTag' => 'div', 'wrapClass' => 'page-nav', 'currentClass' => 'current')); ?>
    </section>
</main>

<?php $this->need('footer.php'); ?>
