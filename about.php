<?php
/**
 * ABOUT 关于
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php $this->need('header.php'); ?>
<main class="main" id="main">
    <article class="entry">
        <header class="entry-head rv">
            <div class="entry-kicker"><?php _e('ABOUT / 关于'); ?></div>
            <h1 class="entry-title"><?php $this->title(); ?></h1>
        </header>
        <div class="sr rv"></div>
        <div class="entry-content rv">
            <?php $this->content(); ?>
        </div>
        <div class="about-sign rv">
            <span class="dot"></span> <?php echo gt_option('brandCode', 'NO/001'); ?> · <?php echo gt_option('brandSub', 'Digital Archive'); ?>
        </div>
    </article>
</main>
<?php $this->need('footer.php'); ?>
