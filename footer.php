<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
$gtV = '20260805';
$gtSocial = gt_social_links();
$gtFooterNote = trim((string) $this->options->footerNote);
?>
<footer class="colophon">
    <div class="col-brand">
        <div class="col-brand-title"><?php $this->options->title(); ?></div>
        <div class="col-brand-sub"><?php _e('Digital Archive'); ?></div>
        <div class="col-tags">HOMELAB <em>/</em> AI <em>/</em> NETWORK <em>/</em> HARDWARE</div>
    </div>
    <div class="col-side">
        <?php foreach ($gtSocial as $gtS): ?>
            <a href="<?php echo $gtS['url']; ?>" target="_blank" rel="noopener noreferrer"><?php echo $gtS['name']; ?></a>
        <?php endforeach; ?>
        <a href="<?php $this->options->feedUrl(); ?>" target="_blank" rel="noopener"><?php _e('RSS'); ?></a>
        <a href="#top" id="backTop"><?php _e('↑ 回到顶部'); ?></a>
    </div>
    <p class="col-legal">
        <span>© <?php echo date('Y'); ?> <?php $this->options->title(); ?></span>
        <span><a href="https://typecho.org" target="_blank" rel="noopener">Typecho</a><?php if ($gtFooterNote !== ''): ?> · <?php echo $gtFooterNote; ?><?php endif; ?></span>
    </p>
</footer>
<?php if ('1' === gt_option('enableHighlight', '1')): ?>
<script src="<?php $this->options->themeUrl('assets/js/highlight.min.js?v=' . $gtV); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/php.min.js?v=' . $gtV); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/xml.min.js?v=' . $gtV); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/css.min.js?v=' . $gtV); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/javascript.min.js?v=' . $gtV); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/json.min.js?v=' . $gtV); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/bash.min.js?v=' . $gtV); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/sql.min.js?v=' . $gtV); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/python.min.js?v=' . $gtV); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/markdown.min.js?v=' . $gtV); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/plaintext.min.js?v=' . $gtV); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/ini.min.js?v=' . $gtV); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/yaml.min.js?v=' . $gtV); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/nginx.min.js?v=' . $gtV); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/main.js?v=' . $gtV); ?>"></script>
<?php endif; ?>
<?php $this->footer(); ?>
</body>
</html>
