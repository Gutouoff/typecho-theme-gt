<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * gt — 后台主题设置
 */
function themeConfig($form)
{
    /* ---------- 01 BRAND · 品牌 ---------- */
    $brandCode = new \Typecho\Widget\Helper\Form\Element\Text(
        'brandCode', null, 'GT/001',
        _t('BRAND — 站点标识'),
        _t('顶栏的刊号标识，例如 GT/001。')
    );
    $form->addInput($brandCode);

    $gtO = gt_options();
    $heroTitle = new \Typecho\Widget\Helper\Form\Element\Text(
        'heroTitle', null, (string) $gtO->title,
        _t('BRAND — Hero 标题'),
        _t('首页刊头大标题，默认取“站点名称”。')
    );
    $form->addInput($heroTitle);

    $heroDesc = new \Typecho\Widget\Helper\Form\Element\Text(
        'heroDesc', null, (string) $gtO->description,
        _t('BRAND — Hero 描述'),
        _t('首页刊头下方的斜体语句，默认取“站点描述”。这是视觉信息，不是 SEO 描述。')
    );
    $form->addInput($heroDesc);

    $heroLabel = new \Typecho\Widget\Helper\Form\Element\Text(
        'heroLabel', null, 'ISSUE 001',
        _t('BRAND — Hero 编号'),
        _t('刊头左上角的小标签，例如 ISSUE 001、Vol.01。')
    );
    $form->addInput($heroLabel);

    $heroShow = new \Typecho\Widget\Helper\Form\Element\Select(
        'heroShow', array('1' => _t('显示'), '0' => _t('隐藏')), '1',
        _t('BRAND — 显示刊头'),
        _t('首页顶部的大刊头是否显示。')
    );
    $form->addInput($heroShow);

    $brandSub = new \Typecho\Widget\Helper\Form\Element\Text(
        'brandSub', null, 'Digital Archive',
        _t('BRAND — 页脚品牌副标题'),
        _t('页脚品牌栏的小字标语。')
    );
    $form->addInput($brandSub);

    /* ---------- 02 HOMEPAGE · 首页 ---------- */
    $homePageSize = new \Typecho\Widget\Helper\Form\Element\Text(
        'homePageSize', null, 6,
        _t('HOMEPAGE — 首页文章数量'),
        _t('首页每页显示的文章数（默认 6）。')
    );
    $form->addInput($homePageSize->addRule('isInteger', _t('请填写整数')));

    $featuredCount = new \Typecho\Widget\Helper\Form\Element\Select(
        'featuredCount', array('1' => _t('1 篇'), '0' => _t('不显示')), '1',
        _t('HOMEPAGE — 特色文章数量'),
        _t('首页第一篇是否显示为通栏头条卡。')
    );
    $form->addInput($featuredCount);

    $gridColumns = new \Typecho\Widget\Helper\Form\Element\Select(
        'gridColumns', array('2' => _t('两列'), '1' => _t('单列')), '2',
        _t('HOMEPAGE — 卡片列数'),
        _t('首页文章卡片的列数（头条大卡始终通栏）。')
    );
    $form->addInput($gridColumns);

    $showExcerpt = new \Typecho\Widget\Helper\Form\Element\Select(
        'showExcerpt', array('1' => _t('显示'), '0' => _t('隐藏')), '1',
        _t('HOMEPAGE — 显示摘要'),
        _t('卡片里是否显示正文摘要（头条大卡始终显示）。')
    );
    $form->addInput($showExcerpt);

    /* ---------- 03 STYLE · 视觉 ---------- */
    $accentColor = new \Typecho\Widget\Helper\Form\Element\Text(
        'accentColor', null, '#b32025',
        _t('STYLE — 强调色'),
        _t('主题主色（十六进制），例如 #b32025。')
    );
    $form->addInput($accentColor);

    $paperColor = new \Typecho\Widget\Helper\Form\Element\Text(
        'paperColor', null, '#f3efe7',
        _t('STYLE — 纸张颜色'),
        _t('背景纸张色（十六进制），例如 #f3efe7。')
    );
    $form->addInput($paperColor);

    $darkMode = new \Typecho\Widget\Helper\Form\Element\Select(
        'darkMode', array('0' => _t('关闭'), '1' => _t('开启')), '0',
        _t('STYLE — 暗色模式'),
        _t('开启后整站切换为深色纸张（跟随固定开关，不随系统）。')
    );
    $form->addInput($darkMode);

    /* ---------- 04 LAB · 实验室 ---------- */
    $labItems = new \Typecho\Widget\Helper\Form\Element\Textarea(
        'labItems', null,
        "HOMELAB|家庭实验室：服务器、存储、功耗与折腾记录。\nAI|人工智能：模型、工具链与日常实践。\nNETWORK|网络：DNS、代理、Cloudflare 与自建服务。\nHARDWARE|硬件：装机、外设与电子小项目。",
        _t('LAB — 实验室分类'),
        _t('每行一条：名称|简介，渲染在 LAB 页面模板中。')
    );
    $form->addInput($labItems);

    /* ---------- 05 SOCIAL · 社交 ---------- */
    $socialLinks = new \Typecho\Widget\Helper\Form\Element\Textarea(
        'socialLinks', null, null,
        _t('SOCIAL — 社交链接'),
        _t('每行一条：名称|URL|简介（简介可省略），显示在页脚。')
    );
    $form->addInput($socialLinks);

    /* ---------- 06 FRIENDS · Friends Archive ---------- */
    $friendLinks = new \Typecho\Widget\Helper\Form\Element\Textarea(
        'friendLinks', null, null,
        _t('FRIENDS — Friends Archive'),
        _t('每行一条：名称|URL|简介，在“友情链接”页面模板中渲染为名片。')
    );
    $form->addInput($friendLinks);

    /* ---------- 07 FOOTER · 页脚 ---------- */
    $footerNote = new \Typecho\Widget\Helper\Form\Element\Text(
        'footerNote', null, null,
        _t('FOOTER — 备案信息'),
        _t('页脚附加文本，如备案号。')
    );
    $form->addInput($footerNote);

    $footerTags = new \Typecho\Widget\Helper\Form\Element\Text(
        'footerTags', null, 'HOMELAB / AI / NETWORK / HARDWARE',
        _t('FOOTER — 标签行'),
        _t('页脚品牌栏的主题标签，用 / 分隔。')
    );
    $form->addInput($footerTags);

    /* ---------- 08 ADVANCED · 高级 ---------- */
    $enableHighlight = new \Typecho\Widget\Helper\Form\Element\Select(
        'enableHighlight', array('1' => _t('启用'), '0' => _t('关闭')), '1',
        _t('ADVANCED — 代码高亮'),
        _t('是否加载 highlight.js 对代码块高亮。')
    );
    $form->addInput($enableHighlight);

    $customCss = new \Typecho\Widget\Helper\Form\Element\Textarea(
        'customCss', null, null,
        _t('ADVANCED — 自定义 CSS'),
        _t('追加到页面的自定义样式（无需 <style> 标签）。')
    );
    $form->addInput($customCss);

    $customHead = new \Typecho\Widget\Helper\Form\Element\Textarea(
        'customHead', null, null,
        _t('ADVANCED — 头部自定义代码'),
        _t('输出在 </head> 前，可放统计代码 / meta。')
    );
    $form->addInput($customHead);

    $customFoot = new \Typecho\Widget\Helper\Form\Element\Textarea(
        'customFoot', null, null,
        _t('ADVANCED — 页脚自定义代码'),
        _t('输出在 </body> 前，可放统计脚本、客服组件等。')
    );
    $form->addInput($customFoot);

    $errText = new \Typecho\Widget\Helper\Form\Element\Text(
        'errText', null, '这个页面不存在，可能已被移动或删除。',
        _t('ADVANCED — 404 提示文案'),
        _t('404 页面显示的提示文字。')
    );
    $form->addInput($errText);
}

/**
 * 主题初始化：首页文章数量
 */
function themeInit($archive)
{
    if ($archive->is('index')) {
        $size = (int) $archive->options->homePageSize;
        if ($size <= 0) {
            $size = 6;
        }
        $archive->parameter->pageSize = $size;
    }

    // 自动回填默认值：让后台设置页显示当前生效值（仅对空值写一次）
    static $gtBackfilled = false;
    if ($gtBackfilled) {
        return;
    }
    $gtBackfilled = true;
    try {
        $gtDefaults = array(
            'brandCode'      => 'GT/001',
            'heroTitle'      => (string) $archive->options->title,
            'heroDesc'       => (string) $archive->options->description,
            'heroLabel'      => 'ISSUE 001',
            'heroShow'       => '1',
            'homePageSize'   => '6',
            'featuredCount'  => '1',
            'gridColumns'    => '2',
            'showExcerpt'    => '1',
            'accentColor'    => '#b32025',
            'paperColor'     => '#f3efe7',
            'darkMode'       => '0',
            'brandSub'       => 'Digital Archive',
            'footerTags'     => 'HOMELAB / AI / NETWORK / HARDWARE',
            'enableHighlight'=> '1',
            'errText'        => '这个页面不存在，可能已被移动或删除。'
        );
        $gtDb = \Typecho\Db::get();
        foreach ($gtDefaults as $gtName => $gtValue) {
            $gtStored = $archive->options->{$gtName};
            if (null === $gtStored || '' === $gtStored) {
                $gtDb->query($gtDb->update('table.options')
                    ->rows(array('value' => $gtValue))
                    ->where('name = ?', $gtName));
            }
        }
    } catch (\Exception $e) {
        // 回填失败不影响页面
    }
}

/**
 * 十六进制转 rgb 数组
 */
function gt_hex_rgb($hex)
{
    $hex = ltrim(trim((string) $hex), '#');
    if (3 === strlen($hex)) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    }
    if (6 !== strlen($hex) || !ctype_xdigit($hex)) {
        return array(179, 32, 37);
    }
    return array(hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2)));
}

/**
 * 十六进制转 rgba
 */
function gt_hex_rgba($hex, $alpha)
{
    $rgb = gt_hex_rgb($hex);
    return 'rgba(' . $rgb[0] . ', ' . $rgb[1] . ', ' . $rgb[2] . ', ' . $alpha . ')';
}

/**
 * 加深/减淡十六进制颜色（percent：-1 ~ 1）
 */
function gt_hex_shade($hex, $percent)
{
    $rgb = gt_hex_rgb($hex);
    $out = array();
    foreach ($rgb as $v) {
        $out[] = max(0, min(255, (int) round($v * (1 + $percent))));
    }
    return '#' . str_pad(dechex($out[0]), 2, '0', STR_PAD_LEFT)
        . str_pad(dechex($out[1]), 2, '0', STR_PAD_LEFT)
        . str_pad(dechex($out[2]), 2, '0', STR_PAD_LEFT);
}

/**
 * 输出主题色板覆盖 CSS（STYLE 设置）
 */
function gt_theme_css()
{
    $accent = (string) gt_option('accentColor', '#b32025');
    if (!preg_match('/^#[0-9a-fA-F]{3,6}$/', $accent)) {
        $accent = '#b32025';
    }
    $paper = (string) gt_option('paperColor', '#f3efe7');
    if (!preg_match('/^#[0-9a-fA-F]{3,6}$/', $paper)) {
        $paper = '#f3efe7';
    }
    return ':root{--accent:' . $accent
        . ';--accent-dark:' . gt_hex_shade($accent, -0.25)
        . ';--accent-light:' . gt_hex_rgba($accent, 0.06)
        . ';--accent-2:' . gt_hex_shade($accent, 0.18)
        . ';--paper:' . $paper
        . ';--paper-2:' . gt_hex_shade($paper, -0.045)
        . ';--paper-glass:' . gt_hex_rgba($paper, 0.94) . ';}';
}

/**
 * 读取主题设置（带默认值）
 */
function gt_option($name, $default = '')
{
    $value = gt_options()->{$name};
    return (null === $value || '' === $value) ? $default : $value;
}

function gt_parse_lines($raw)
{
    $items = array();
    if (empty($raw) || !is_string($raw)) {
        return $items;
    }
    $lines = preg_split('/[\r\n]+/', trim($raw));
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '') {
            continue;
        }
        $parts = array_map('trim', explode('|', $line, 3));
        if (count($parts) < 2 || $parts[0] === '' || $parts[1] === '') {
            continue;
        }
        $items[] = array(
            'name' => $parts[0],
            'url'  => $parts[1],
            'desc' => isset($parts[2]) ? $parts[2] : ''
        );
    }
    return $items;
}

/**
 * 获取全局选项（函数环境内使用）
 */
function gt_options()
{
    static $options = null;
    if ($options === null) {
        $options = \Typecho\Widget::widget('Widget_Options');
    }
    return $options;
}

/**
 * 社交链接数组
 */
function gt_social_links()
{
    return gt_parse_lines(gt_options()->socialLinks);
}

/**
 * 友情链接数组
 */
function gt_friend_links()
{
    return gt_parse_lines(gt_options()->friendLinks);
}

/**
 * 取评论者昵称首字符作为头像
 */
function gt_initial($name)
{
    $name = trim((string) $name);
    if ($name === '') {
        return '?';
    }
    if (function_exists('mb_substr')) {
        return mb_substr($name, 0, 1, 'UTF-8');
    }
    return substr($name, 0, 1);
}

/**
 * 页面 body class
 */
function gt_body_class($archive)
{
    if ($archive->is('index')) {
        return 'is-index';
    }
    if ($archive->is('post')) {
        return 'is-post';
    }
    if ($archive->is('page')) {
        return 'is-page';
    }
    if ($archive->is('404')) {
        return 'is-404';
    }
    return 'is-archive';
}

/**
 * 实时评论数（统计当前可见评论，避免 contents.commentsNum 缓存列不准）
 */
function gt_comment_count($archive)
{
    return $archive->comments()->length;
}

/**
 * 文章阅读时间（中文按约 400 字/分钟）
 */
function gt_reading_time($archive)
{
    $text = isset($archive->text) ? $archive->text : '';
    $text = trim(strip_tags($text));
    if ($text === '') {
        return 1;
    }
    $len = function_exists('mb_strlen') ? mb_strlen($text, 'UTF-8') : strlen($text);
    return max(1, (int) ceil($len / 400));
}

/**
 * 文章编号（按发布时间排序，从 1 开始）
 */
function gt_post_no($archive)
{
    static $cache = array();
    $cid = $archive->cid;
    if (isset($cache[$cid])) {
        return $cache[$cid];
    }
    $db = \Typecho\Db::get();
    $row = $db->fetchRow($db->select(array('COUNT(table.contents.cid)' => 'num'))
        ->from('table.contents')
        ->where('table.contents.type = ?', 'post')
        ->where('table.contents.status = ?', 'publish')
        ->where('table.contents.created <= ?', $archive->created));
    $cache[$cid] = (int) $row['num'];
    return $cache[$cid];
}

/**
 * 文章状态（NEW = 7 天内发布；UPDATED = 发布后修改过）
 */
function gt_post_status($archive)
{
    $age = time() - (int) $archive->created;
    if ($age < 0) {
        $age = 0;
    }
    if ($age <= 7 * 86400) {
        return 'NEW';
    }
    if ((int) $archive->modified > (int) $archive->created + 3600) {
        return 'UPDATED';
    }
    return '';
}

/**
 * 取链接域名（友链名片显示）
 */
function gt_host($url)
{
    $host = parse_url($url, PHP_URL_HOST);
    return $host ? $host : $url;
}

/**
 * 分区编号
 */
function gt_section_no($key)
{
    $map = array('comments' => 'No.04');
    return isset($map[$key]) ? $map[$key] : '—';
}

/**
 * 评论列表回调（Typecho 1.2 会优先调用此全局函数）
 */
function threadedComments($comments, $options)
{
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
    $GLOBALS['gt_comment_seq'] = isset($GLOBALS['gt_comment_seq']) ? $GLOBALS['gt_comment_seq'] + 1 : 1;
    $gtSeq = $GLOBALS['gt_comment_seq'];
    ?>
    <li id="comment-<?php $comments->theId(); ?>" class="comment-item<?php echo $commentClass; ?>">
        <div class="comment-meta">
            <span class="comment-seq">No.<?php echo str_pad((string) $gtSeq, 2, '0', STR_PAD_LEFT); ?></span>
            <span class="comment-avatar"><?php echo gt_initial($comments->author); ?></span>
            <span class="comment-author"><?php $comments->author(); ?></span>
            <span class="comment-date"><?php $comments->date('Y.m.d H:i'); ?></span>
            <?php if ('waiting' == $comments->status): ?>
                <em class="comment-awaiting-moderation"><?php echo $options->commentStatus; ?></em>
            <?php endif; ?>
        </div>
        <div class="comment-body-text"><?php $comments->content(); ?></div>
        <div class="comment-reply"><?php $comments->reply($options->replyWord); ?></div>
    </li>
    <?php
}
