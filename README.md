# gt — Typecho 主题（v2 半色调杂志风）

一个 Typecho 博客主题，设计风格参考 [gtoff.top](https://gtoff.top)：米白纸张质感、衬线标题、等宽小标签、红色强调；v2 升级为**半色调杂志风**——网点印刷纹理、刊头封面、编号贴纸、错位阴影、特色头条大卡、双栏文章网格与滚动显现动画。

- 兼容：Typecho 1.2.x（1.2.1 实测）、PHP 7.2+
- 形态：单栏杂志版式（首页刊头 + 特色头条卡 + 双栏网格），无侧栏；界面文案中英双语点缀
- 依赖：无外部 CDN，字体与代码高亮全部自托管

## 安装

1. 将本主题目录（`gt`）上传到服务器的 `usr/themes/gt`。
2. 进入 Typecho 后台 → 控制台 → 外观，启用 **gt**。
3. 进入「设置外观」，填写副标题、社交链接、友情链接等。

> 主题名即目录名。想改名：重命名目录，并把 `index.php` 顶部注释里的 `@package` 一起改掉。

## 后台设置

| 分组 | 设置项 | 说明 |
| --- | --- | --- |
| 01 BRAND | 站点标识 | 顶栏刊号，如 `GT/001` |
| 01 BRAND | Hero 标题 | 首页刊头大标题；留空用站点名称 |
| 01 BRAND | Hero 描述 | 刊头斜体语句；留空用站点描述 |
| 01 BRAND | Hero 编号 | 刊头小标签，如 `ISSUE 001` |
| 02 HOMEPAGE | 首页文章数量 | 首页每页文章数（默认 6） |
| 02 HOMEPAGE | 特色文章数量 | 头条大卡开关（1 篇 / 不显示） |
| 02 HOMEPAGE | 显示摘要 | 编号卡片是否显示正文摘要 |
| 02 HOMEPAGE | 显示分类 | 编号卡片是否显示分类标签 |
| 03 STYLE | 强调色 | 主色 hex，如 `#b32025` |
| 03 STYLE | 纸张颜色 | 背景纸色 hex，如 `#f3efe7` |
| 03 STYLE | 暗色模式 | 整站深色纸张开关 |
| 04 SOCIAL | 社交链接 | 每行 `名称|URL|简介`，页脚显示 |
| 05 FRIENDS | Friends Archive | 每行 `名称|URL|简介`，友链页名片 |
| 06 FOOTER | 备案信息 | 页脚附加文本 |
| 07 ADVANCED | 代码高亮 / 自定义 CSS / 头部代码 | 高级功能 |

### 友情链接页面

1. 后台 → 内容 → 独立页面 → 新建页面，标题如「友情链接」。
2. 右侧「模板」选择 **友情链接**（`links.php`）。
3. 页面正文可写申请说明；友链数据在「设置外观」里维护。

### 独立页面模板

| 模板 | 文件名 | 用途 |
| --- | --- | --- |
| 友情链接 | `links.php` | Friends Archive 名片卡片，数据来自后台设置 |
| LAB | `lab.php` | 实验室栏目（HOMELAB / AI / NETWORK / HARDWARE） |
| ABOUT | `about.php` | 关于页，底部带 GT OFF 签名 |
| 归档 | `page-archive.php` | 按年份分组的文章归档 |

后台 → 内容 → 独立页面 → 新建页面 → 右侧「模板」选择对应模板即可。

## 文件结构

```
gt/
├── index.php       首页（文章卡片 + 分页）
├── header.php      顶部固定导航栏 + 搜索
├── footer.php      页脚 + 脚本
├── post.php        文章页
├── page.php        独立页面
├── archive.php     分类 / 标签 / 日期 / 作者 / 搜索
├── comments.php    评论列表与表单
├── links.php       友情链接（独立页面模板）
├── 404.php
├── functions.php   后台设置 + 评论回调
├── style.css       全部样式（设计令牌在 :root）
├── screenshot.png  主题缩略图
├── assets/
│   ├── css/highlight.css
│   └── js/main.js、highlight.min.js、hljs/*.min.js
└── fonts/          自托管 woff2（Bungee / Playfair Display / JetBrains Mono）
```

## 设计令牌与暗色模式扩展

所有颜色、字体、间距都收敛在 `style.css` 顶部的 `:root` 变量里（`--paper`、`--ink`、`--rule`、`--accent` 等）。

后期加暗色模式只需追加一段覆盖，例如：

```css
@media (prefers-color-scheme: dark) {
  :root {
    --paper: #1c1a17;
    --paper-2: #24211d;
    --ink: #e8e2d8;
    --ink-2: #c4beb4;
    --ink-3: #9b958b;
    --rule: #3a362f;
    --accent: #e07b5f;
    --accent-light: rgba(224, 123, 95, 0.1);
  }
}
```

无需改动其它样式。注意 `body::after` 的点状纹理、`.rh` 背景、`.friend-card:hover`、`.btn` 等少量硬编码颜色，若有需要可一并变量化。

## 字体说明

- 主题只自托管拉丁字体：**Bungee**（展示）、**Playfair Display**（衬线，可变字重 100–900 含斜体）、**JetBrains Mono**（等宽，100–800）。
- 中文使用系统字体栈（PingFang SC / 微软雅黑 / 宋体等），加载快、不打包巨大 CJK 文件。
- 如需打包 Noto Sans SC 子集：用 fonttools 按常用字表子集化后放入 `fonts/`，在 `style.css` 的 `@font-face` 后追加声明并把 `--sans` 栈首位改成该字体即可。

## 代码高亮

- 基于 highlight.js 11.9.0 自托管：核心 `assets/js/highlight.min.js` + 语言文件 `assets/js/hljs/*.min.js`（php/xml/css/javascript/json/bash/sql/python/markdown/plaintext/ini/yaml/nginx）。
- 新增语言：从 cdnjs 下载对应 `languages/xxx.min.js` 放入 `assets/js/hljs/`，再在 `footer.php` 加一行 `<script>` 引用即可。

## 常见问题

- **搜索框**：桌面端直接输入；移动端点「搜索」按钮展开输入框。
- **评论区**：基于 Typecho 官方 `listComments` + `threadedComments` 回调实现，支持楼中楼回复、取消回复、待审核状态提示，不依赖第三方插件。
- **首页卡片无摘要**：与参考站一致，只显示分类 / 日期 / 标题 / 阅读全文。
