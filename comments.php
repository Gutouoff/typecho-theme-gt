<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="comments" class="comments">
    <?php $this->comments()->to($comments); ?>
    <div class="comments-head">
        <div class="sh">
            <span class="sn"><?php echo gt_section_no('comments'); ?></span>
            <h2 class="st"><?php _e('评论 / Comments'); ?></h2>
        </div>
        <span class="comments-count"><?php if ($comments->have()): ?><?php echo $comments->length; ?> <?php _e('条评论'); ?><?php else: ?><?php _e('暂无评论'); ?><?php endif; ?></span>
    </div>

    <?php $GLOBALS['gt_comment_seq'] = 0; ?>
    <?php if ($comments->have()): ?>
        <?php $comments->listComments(array(
            'before'        => '<ol class="comment-list">',
            'after'         => '</ol>',
            'replyWord'     => _t('回复'),
            'commentStatus' => _t('您的评论正等待审核'),
            'dateFormat'    => 'Y.m.d H:i'
        )); ?>
    <?php else: ?>
        <p class="comment-empty"><?php _e('还没有评论，来抢沙发吧~'); ?></p>
    <?php endif; ?>

    <?php if ($this->allow('comment')): ?>
        <div id="<?php $this->respondId(); ?>" class="comment-form-wrap">
            <div class="cancel-comment-reply">
                <?php $comments->cancelReply(); ?>
            </div>
            <h3 class="comment-form-title"><?php _e('发表评论 / Leave a Reply'); ?></h3>
            <form method="post" action="<?php $this->commentUrl(); ?>" id="comment-form" class="comment-form" role="form">
                <?php if ($this->user->hasLogin()): ?>
                    <p class="comment-login"><?php _e('登录身份：'); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a> · <a href="<?php $this->options->logoutUrl(); ?>"><?php _e('退出'); ?> »</a></p>
                <?php else: ?>
                    <div class="cf-row">
                        <p>
                            <label for="author" class="required"><?php _e('昵称 / Name'); ?></label>
                            <input type="text" name="author" id="author" class="text" value="<?php $this->remember('author'); ?>" required>
                        </p>
                        <p>
                            <label for="mail"<?php if ($this->options->commentsRequireMail): ?> class="required"<?php endif; ?>><?php _e('邮箱 / E-mail'); ?></label>
                            <input type="email" name="mail" id="mail" class="text" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?>>
                        </p>
                        <p>
                            <label for="url"<?php if ($this->options->commentsRequireURL): ?> class="required"<?php endif; ?>><?php _e('网址 / Website'); ?></label>
                            <input type="url" name="url" id="url" class="text" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?>>
                        </p>
                    </div>
                <?php endif; ?>
                <p>
                    <label for="textarea" class="required"><?php _e('内容 / Content'); ?></label>
                    <textarea rows="6" name="text" id="textarea" class="textarea" required><?php $this->remember('text'); ?></textarea>
                </p>
                <div class="cf-submit">
                    <button type="submit" class="btn"><?php _e('提交评论 / Submit'); ?></button>
                    <span class="comment-hint"><?php _e('支持 Markdown 语法'); ?></span>
                </div>
            </form>
        </div>
    <?php else: ?>
        <p class="comment-closed"><?php _e('评论已关闭。'); ?></p>
    <?php endif; ?>
</div>
