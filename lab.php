<?php
/**
 * LAB 实验室
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php $this->need('header.php'); ?>
<?php
$gtLab = array();
$gtLabRaw = (string) gt_option('labItems');
if ($gtLabRaw !== '') {
    $gtLab = gt_parse_lines($gtLabRaw);
} else {
    $gtLab = array(
        array('name' => 'HOMELAB', 'desc' => _t('家庭实验室：服务器、存储、功耗与折腾记录。')),
        array('name' => 'AI', 'desc' => _t('人工智能：模型、工具链与日常实践。')),
        array('name' => 'NETWORK', 'desc' => _t('网络：DNS、代理、Cloudflare 与自建服务。')),
        array('name' => 'HARDWARE', 'desc' => _t('硬件：装机、外设与电子小项目。'))
    );
}
$gtLabNo = 1;
?>
<main class="main" id="main">
    <article class="entry">
        <header class="entry-head rv">
            <div class="entry-kicker"><?php _e('LAB / Archive'); ?></div>
            <h1 class="entry-title"><?php $this->title(); ?></h1>
        </header>
        <div class="sr rv"></div>
        <div class="entry-content rv">
            <?php gt_content($this); ?>
        </div>
    </article>
    <section class="sec lab-sec">
        <div class="lab-grid rv-s">
            <?php foreach ($gtLab as $gtL): ?>
                <div class="lab-card">
                    <span class="lab-no"><?php echo str_pad((string) $gtLabNo, 3, '0', STR_PAD_LEFT); ?></span>
                    <h2><?php echo $gtL['name']; ?></h2>
                    <p><?php echo $gtL['desc']; ?></p>
                </div>
                <?php $gtLabNo++; ?>
            <?php endforeach; ?>
        </div>
    </section>
</main>
<?php $this->need('footer.php'); ?>
