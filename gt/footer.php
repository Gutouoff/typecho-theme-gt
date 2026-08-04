<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
$gtSocial = gt_social_links();
$gtSubtitle = trim((string) $this->options->subtitle);
if ($gtSubtitle === '') {
    $gtSubtitle = trim((string) $this->options->description);
}
$gtFooterNote = trim((string) $this->options->footerNote);
?>
<footer class="colophon">
    <p class="col-text">© <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a><?php if ($gtSubtitle !== ''): ?> · <?php echo $gtSubtitle; ?><?php endif; ?><?php if ($gtFooterNote !== ''): ?> · <?php echo $gtFooterNote; ?><?php endif; ?> · <a href="https://typecho.org" target="_blank" rel="noopener">Typecho</a></p>
    <div class="col-links">
        <?php foreach ($gtSocial as $gtS): ?>
            <a href="<?php echo $gtS['url']; ?>" target="_blank" rel="noopener noreferrer"><?php echo $gtS['name']; ?></a>
        <?php endforeach; ?>
        <a href="<?php $this->options->feedUrl(); ?>" target="_blank" rel="noopener"><?php _e('RSS'); ?></a>
        <a href="#top" id="backTop"><?php _e('↑ 回到顶部'); ?></a>
    </div>
</footer>
<script src="<?php $this->options->themeUrl('assets/js/highlight.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/php.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/xml.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/css.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/javascript.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/json.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/bash.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/sql.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/python.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/markdown.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/plaintext.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/ini.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/yaml.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/hljs/nginx.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/main.js'); ?>"></script>
<?php $this->footer(); ?>
</body>
</html>
