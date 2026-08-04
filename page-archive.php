<?php
/**
 * 归档
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php $this->need('header.php'); ?>
<?php
$this->widget('Widget_Contents_Post_Recent', 'pageSize=1000')->to($gtPosts);
$gtGroups = array();
while ($gtPosts->next()) {
    $gtP = clone $gtPosts;
    $gtGroups[date('Y', $gtP->created)][] = $gtP;
}
?>
<main class="main" id="main">
    <article class="entry">
        <header class="entry-head rv">
            <div class="entry-kicker"><?php _e('ARCHIVE / 归档'); ?></div>
            <h1 class="entry-title"><?php $this->title(); ?></h1>
        </header>
        <div class="sr rv"></div>
        <div class="entry-content rv">
            <?php $this->content(); ?>
        </div>
    </article>
    <section class="sec archive-groups rv">
        <?php foreach ($gtGroups as $gtYear => $gtPosts2): ?>
            <div class="archive-group">
                <div class="archive-group-year"><?php echo $gtYear; ?></div>
                <div class="row-list">
                    <?php foreach ($gtPosts2 as $gtP): ?>
                        <a class="row-item" href="<?php $gtP->permalink(); ?>">
                            <span class="row-date"><?php $gtP->date('Y.m.d'); ?></span>
                            <span class="row-title"><?php $gtP->title(); ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</main>
<?php $this->need('footer.php'); ?>
