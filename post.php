<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<main class="main" id="main">
    <article class="entry" itemscope itemtype="http://schema.org/BlogPosting">
        <header class="entry-head rv">
            <div class="entry-kicker"><?php $this->category(', ', true, _t('文章 / Post')); ?></div>
            <h1 class="entry-title" itemprop="name headline"><?php $this->title(); ?></h1>
            <div class="entry-meta">
                <span class="meta-item">NO.<?php echo str_pad((string) gt_post_no($this), 3, '0', STR_PAD_LEFT); ?></span>
                <span class="meta-item"><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('Y.m.d'); ?></time></span>
                <span class="meta-item"><?php _e('READING TIME'); ?> <?php echo gt_reading_time($this); ?> MIN</span>
                <span class="meta-item" itemprop="author"><?php _e('作者'); ?> <a href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></span>
                <span class="meta-item"><a href="<?php $this->permalink(); ?>#comments"><?php echo gt_comment_count($this); ?> <?php _e('评论'); ?></a></span>
            </div>
        </header>
        <div class="sr rv"></div>
        <div class="entry-content rv" itemprop="articleBody">
            <?php gt_content($this); ?>
        </div>
        <?php if ($this->tags && '1' === gt_option('showTags', '1')): ?>
            <div class="entry-tags rv">
                <span class="tag-label"><?php _e('标签 / Tags'); ?></span>
                <?php $this->tags(', ', true, ''); ?>
            </div>
        <?php endif; ?>
    </article>

    <?php if ('1' === gt_option('showPrevNext', '1')): ?>
    <nav class="entry-nav rv" aria-label="<?php _e('上一篇 / 下一篇'); ?>">
        <div class="entry-nav-prev">
            <?php $this->thePrev('%s', '', array('tagClass' => 'entry-nav-link')); ?>
        </div>
        <div class="entry-nav-next">
            <?php $this->theNext('%s', '', array('tagClass' => 'entry-nav-link')); ?>
        </div>
    </nav>
    <?php endif; ?>

    <?php $this->need('comments.php'); ?>
</main>

<?php $this->need('footer.php'); ?>
