# Masthead — Typecho 主题（v2 半色调杂志风）

一个 Typecho 博客主题，设计风格参考半色调印刷与独立杂志排版：米白纸张质感、衬线标题、等宽小标签、红色强调；v2 升级为**半色调杂志风**——网点印刷纹理、刊头封面、编号贴纸、错位阴影、特色头条大卡、双栏文章网格与滚动显现动画。

- 兼容：Typecho 1.2.x（1.2.1 实测）、PHP 7.2+
- 形态：单栏杂志版式（首页刊头 + 特色头条卡 + 双栏网格），无侧栏；界面文案中英双语点缀
- 依赖：无外部 CDN，字体与代码高亮全部自托管

## 安装

1. 将本主题目录（`Masthead`）上传到服务器的 `usr/themes/Masthead`。
2. 进入 Typecho 后台 → 控制台 → 外观，启用 **Masthead**。
3. 进入「设置外观」，填写副标题、社交链接、友情链接等。

> 主题名即目录名。想改名：重命名目录，并把 `index.php` 顶部注释里的 `@package` 一起改掉。

## 后台设置

| 分组 | 设置项 | 说明 |
| --- | --- | --- |
| 01 BRAND | 站点标识 | 顶栏刊号，如 `NO/001` |
| 01 BRAND | Hero 标题 / 描述 / 编号 | 首页刊头三件套；留空自动回退站点名称/描述 |
| 01 BRAND | 显示刊头 | 首页大刊头开关 |
| 01 BRAND | 页脚品牌副标题 | 页脚品牌栏小字，如 `Digital Archive` |
| 02 HOMEPAGE | 首页文章数量 | 首页每页文章数（默认 6） |
| 02 HOMEPAGE | 特色文章数量 | 头条大卡开关（1 篇 / 不显示） |
| 02 HOMEPAGE | 卡片列数 | 两列 / 单列 |
| 02 HOMEPAGE | 显示摘要 | 卡片是否显示正文摘要 |
| 03 STYLE | 强调色 / 纸张颜色 | 主色与纸色 hex，自动派生深浅 |
| 04 LAB | 实验室分类 | 每行 `名称|简介`，渲染到 LAB 页面模板 |
| 05 SOCIAL | 社交链接 | 每行 `名称|URL|简介`，页脚显示 |
| 06 FOOTER | 备案信息 / 标签行 | 页脚文本与品牌标签行 |
| 07 ADVANCED | 代码高亮 / 自定义 CSS / 头部代码 / 页脚代码 / 404 文案 | 高级功能 |

> 暗色模式：默认**跟随系统**（`prefers-color-scheme`），顶栏有滑块可手动切换（记忆在 localStorage）。友链不在后台填写，见下方「友情链接页面」。

### 友情链接页面

1. 后台 → 内容 → 独立页面 → 新建页面，标题如「友情链接」。
2. 右侧「模板」选择 **友情链接**（`links.php`）。
3. 页面正文按固定格式写友链，模板会自动识别并渲染成名片卡片：

```
示例站点 | https://example.com | 一句话简介
另一个站点 | https://demo.example.org | 另一句话简介
Yet Another | https://link.example.net | 这里写简介
```

- 每行一条：`名称 | URL | 简介`（URL 可省略 `https://`，简介可省略）
- 其余正文正常显示（可写申请说明、格式要求等）

### 独立页面模板

| 模板 | 文件名 | 用途 |
| --- | --- | --- |
| 友情链接 | `links.php` | Friends Archive 名片卡片，数据来自后台设置 |
| LAB | `lab.php` | 实验室栏目（HOMELAB / AI / NETWORK / HARDWARE） |
| ABOUT | `about.php` | 关于页，底部带品牌签名 |
| 归档 | `page-archive.php` | 按年份分组的文章归档 |

后台 → 内容 → 独立页面 → 新建页面 → 右侧「模板」选择对应模板即可。

## 文件结构

```
Masthead/
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
