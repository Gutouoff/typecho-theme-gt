<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<main class="main" id="main">
    <section class="sec">
        <span class="wm" aria-hidden="true">02</span>
        <header class="sh rv">
            <span class="sn">02</span>
            <h2 class="st"><?php $this->archiveTitle(array(
                    'category' => _t('分类 <em>/ Category</em> · %s'),
                    'search'   => _t('搜索 <em>/ Search</em> · %s'),
                    'tag'      => _t('标签 <em>/ Tag</em> · %s'),
                    'author'   => _t('作者 <em>/ Author</em> · %s'),
                    'date'     => _t('归档 <em>/ Archive</em> · %s')
                ), '', ''); ?></h2>
        </header>
        <div class="sr rv"></div>
        <?php if ($this->is('search')): ?>
            <p class="search-note rv"><?php _e('找到'); ?> <?php echo $this->getTotal(); ?> <?php _e('篇相关文章'); ?></p>
        <?php endif; ?>
        <div class="row-list rv-s">
            <?php while ($this->next()): ?>
                <a class="row-item" href="<?php $this->permalink(); ?>">
                    <span class="row-date"><?php $this->date('Y.m.d'); ?></span>
                    <span class="row-title"><?php $this->title(); ?></span>
                </a>
            <?php endwhile; ?>
        </div>
        <?php $this->pageNav(_t('«'), _t('»'), 3, '…', array('wrapTag' => 'div', 'wrapClass' => 'page-nav', 'currentClass' => 'current')); ?>
    </section>
</main>

<?php $this->need('footer.php'); ?>
