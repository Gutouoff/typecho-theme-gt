<?php
/**
 * 友情链接
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php $this->need('header.php'); ?>

<main class="main" id="main">
    <article class="entry">
        <header class="entry-head rv">
            <div class="entry-kicker"><?php _e('友情链接 / Friend Links'); ?></div>
            <h1 class="entry-title"><?php $this->title(); ?></h1>
        </header>
        <div class="sr rv"></div>
        <div class="entry-content rv">
            <?php $this->content(); ?>
        </div>
    </article>

    <?php $gtLinks = gt_friend_links(); ?>
    <?php if (!empty($gtLinks)): ?>
        <section class="sec friends-sec">
            <header class="sh rv">
                <span class="sn">No.03</span>
                <h2 class="st"><?php _e('友情链接'); ?> <em><?php _e('/ Friends Archive'); ?></em></h2>
            </header>
            <div class="sr rv"></div>
            <div class="friends-grid rv-s">
                <?php $gtIndex = 1; ?>
                <?php foreach ($gtLinks as $gtLink): ?>
                    <a class="friend-card" href="<?php echo $gtLink['url']; ?>" target="_blank" rel="noopener noreferrer">
                        <span class="friend-no"><?php echo str_pad((string) $gtIndex, 3, '0', STR_PAD_LEFT); ?></span>
                        <h2 class="friend-name"><?php echo $gtLink['name']; ?></h2>
                        <span class="friend-url"><?php echo gt_host($gtLink['url']); ?></span>
                        <?php if ($gtLink['desc'] !== ''): ?>
                            <p class="friend-desc"><?php echo $gtLink['desc']; ?></p>
                        <?php endif; ?>
                    </a>
                    <?php $gtIndex++; ?>
                <?php endforeach; ?>
            </div>
        </section>
    <?php else: ?>
        <p class="friend-empty"><?php _e('后台主题设置中尚未添加友情链接。'); ?></p>
    <?php endif; ?>
</main>

<?php $this->need('footer.php'); ?>
