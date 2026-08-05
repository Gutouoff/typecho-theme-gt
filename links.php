<?php
/**
 * 友情链接
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php $this->need('header.php'); ?>
<?php
// 从页面正文解析友链：每行 "名称 | URL | 简介"（URL 可省略 https://）
$gtLinkHtml = (string) $this->content;
$gtCards = array();
$gtLinkHtml = preg_replace_callback('/<p>(?:<br\s*\/?>)?\s*(?:[-*]\s*)?([^<|｜]+?)\s*[|｜]\s*(<a[^>]*href="([^"]+)"[^>]*>.*?<\/a>|(?:https?:\/\/)?[a-zA-Z0-9][\w.-]*\.[a-z]{2,}(?:\/[^\s<|｜]*)?)\s*(?:[|｜]\s*([^<]*?))?\s*<\/p>/i', function ($m) use (&$gtCards) {
    $url = (isset($m[3]) && $m[3] !== '') ? trim($m[3]) : trim($m[2]);
    if ($url !== '' && !preg_match('/^https?:\/\//i', $url)) {
        $url = 'http://' . $url;
    }
    $gtCards[] = array(
        'name' => trim($m[1]),
        'url'  => $url,
        'desc' => (isset($m[4]) && $m[4] !== '') ? trim($m[4]) : ''
    );
    return '';
}, $gtLinkHtml);
?>
<main class="main" id="main">
    <article class="entry">
        <header class="entry-head rv">
            <div class="entry-kicker"><?php _e('友情链接 / Friend Links'); ?></div>
            <h1 class="entry-title"><?php $this->title(); ?></h1>
        </header>
        <div class="sr rv"></div>
        <div class="entry-content rv">
            <?php echo $gtLinkHtml; ?>
        </div>
    </article>

    <?php if (!empty($gtCards)): ?>
        <section class="sec friends-sec">
            <header class="sh rv">
                <span class="sn">No.03</span>
                <h2 class="st"><?php _e('友情链接'); ?> <em><?php _e('/ Friends Archive'); ?></em></h2>
            </header>
            <div class="sr rv"></div>
            <div class="friends-grid rv-s">
                <?php $gtIndex = 1; ?>
                <?php foreach ($gtCards as $gtLink): ?>
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
        <p class="friend-empty"><?php _e('在页面正文按「名称 | URL | 简介」格式添加友链，即可自动生成名片。'); ?></p>
    <?php endif; ?>
</main>

<?php $this->need('footer.php'); ?>
