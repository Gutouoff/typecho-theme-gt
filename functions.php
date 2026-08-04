<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * gt — 后台主题设置
 */
function themeConfig($form)
{
    // ---- 刊头 ----
    $issueLabel = new \Typecho\Widget\Helper\Form\Element\Text(
        'issueLabel',
        null,
        'ISSUE 001',
        _t('刊头期号'),
        _t('首页刊头左上角的小标签，例如：ISSUE 001、Vol.01 等。')
    );
    $form->addInput($issueLabel);

    $heroSub = new \Typecho\Widget\Helper\Form\Element\Text(
        'heroSub',
        null,
        null,
        _t('刊头副标题'),
        _t('首页刊头下方的斜体简介。留空时使用“站点描述”。')
    );
    $form->addInput($heroSub);

    // ---- 首页 ----
    $showFeatured = new \Typecho\Widget\Helper\Form\Element\Select(
        'showFeatured',
        array('1' => _t('启用'), '0' => _t('关闭')),
        '1',
        _t('首页头条大卡'),
        _t('首页第一篇文章是否显示为通栏头条卡（其余为编号卡片）。')
    );
    $form->addInput($showFeatured);

    // ---- 文章页 ----
    $showPrevNext = new \Typecho\Widget\Helper\Form\Element\Select(
        'showPrevNext',
        array('1' => _t('启用'), '0' => _t('关闭')),
        '1',
        _t('上一篇 / 下一篇'),
        _t('文章页底部是否显示上一篇 / 下一篇导航。')
    );
    $form->addInput($showPrevNext);

    $showTags = new \Typecho\Widget\Helper\Form\Element\Select(
        'showTags',
        array('1' => _t('启用'), '0' => _t('关闭')),
        '1',
        _t('文章标签'),
        _t('文章页是否显示标签贴纸。')
    );
    $form->addInput($showTags);

    // ---- 站点信息 ----
    $subtitle = new \Typecho\Widget\Helper\Form\Element\Text(
        'subtitle',
        null,
        null,
        _t('站点副标题'),
        _t('显示在页脚。留空时使用“站点描述”。')
    );
    $form->addInput($subtitle);

    $socialLinks = new \Typecho\Widget\Helper\Form\Element\Textarea(
        'socialLinks',
        null,
        null,
        _t('社交链接'),
        _t('每行一条，格式：名称|URL|简介（简介可省略），例如：GitHub|https://github.com/xxx|代码仓库。显示在页脚。')
    );
    $form->addInput($socialLinks);

    $friendLinks = new \Typecho\Widget\Helper\Form\Element\Textarea(
        'friendLinks',
        null,
        null,
        _t('友情链接'),
        _t('每行一条，格式：名称|URL|简介，在“友情链接”独立页面模板中渲染为名片卡片。')
    );
    $form->addInput($friendLinks);

    $footerNote = new \Typecho\Widget\Helper\Form\Element\Text(
        'footerNote',
        null,
        null,
        _t('页脚附加文本'),
        _t('如备案号等，可为空。')
    );
    $form->addInput($footerNote);

    // ---- 功能与杂项 ----
    $enableHighlight = new \Typecho\Widget\Helper\Form\Element\Select(
        'enableHighlight',
        array('1' => _t('启用'), '0' => _t('关闭')),
        '1',
        _t('代码高亮'),
        _t('是否加载 highlight.js 对代码块进行语法高亮。')
    );
    $form->addInput($enableHighlight);

    $customCss = new \Typecho\Widget\Helper\Form\Element\Textarea(
        'customCss',
        null,
        null,
        _t('自定义 CSS'),
        _t('追加到页面的自定义样式，直接写 CSS，无需 <style> 标签。')
    );
    $form->addInput($customCss);

    $customHead = new \Typecho\Widget\Helper\Form\Element\Textarea(
        'customHead',
        null,
        null,
        _t('头部自定义代码'),
        _t('输出在 </head> 之前，可放统计代码、meta 标签等。')
    );
    $form->addInput($customHead);
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
