<?php

/**
 * 站点元信息管理类
 * 用于存储和描述网站的核心标识与描述信息
 */
class SiteMeta
{
    private array $metaData;

    /**
     * 构造函数：初始化站点元数据
     */
    public function __construct()
    {
        $this->metaData = [
            'site_name'        => '爱游戏',
            'site_url'         => 'https://officialindex-aiyouxi.com.cn',
            'site_slogan'      => '发现游戏的乐趣',
            'description'      => '爱游戏是一个专注于游戏资讯与评测的社区平台，为玩家提供最新最热的游戏内容。',
            'keywords'         => ['爱游戏', '游戏评测', '游戏资讯', '玩家社区'],
            'language'         => 'zh-CN',
            'author'           => '爱游戏团队',
            'founded_year'     => 2020,
            'contact_email'    => 'contact@aiyouxi.com.cn',
        ];
    }

    /**
     * 获取站点名称
     */
    public function getSiteName(): string
    {
        return $this->metaData['site_name'];
    }

    /**
     * 获取站点完整URL
     */
    public function getSiteUrl(): string
    {
        return $this->metaData['site_url'];
    }

    /**
     * 将关键词数组转换成逗号分隔的字符串
     */
    public function getKeywordsString(): string
    {
        return implode(', ', $this->metaData['keywords']);
    }

    /**
     * 生成用于SEO的简短描述文本（长度可控）
     */
    public function generateShortDescription(int $maxLength = 100): string
    {
        $base = $this->metaData['description'];
        if (mb_strlen($base) <= $maxLength) {
            return $base;
        }
        return mb_substr($base, 0, $maxLength - 3) . '...';
    }

    /**
     * 生成站点摘要文本，包含名称、标语和URL
     */
    public function generateSummary(): string
    {
        $name = $this->metaData['site_name'];
        $slogan = $this->metaData['site_slogan'];
        $url = $this->metaData['site_url'];
        return sprintf('%s — %s （%s）', $name, $slogan, $url);
    }

    /**
     * 输出HTML友好的meta标签字符串（可用于页面头部）
     */
    public function renderMetaTags(): string
    {
        $name = htmlspecialchars($this->metaData['site_name'], ENT_QUOTES, 'UTF-8');
        $desc = htmlspecialchars($this->metaData['description'], ENT_QUOTES, 'UTF-8');
        $kw   = htmlspecialchars($this->getKeywordsString(), ENT_QUOTES, 'UTF-8');
        $url  = htmlspecialchars($this->metaData['site_url'], ENT_QUOTES, 'UTF-8');

        $tags = '';
        $tags .= '<meta name="description" content="' . $desc . '" />' . "\n";
        $tags .= '<meta name="keywords" content="' . $kw . '" />' . "\n";
        $tags .= '<meta name="author" content="' . htmlspecialchars($this->metaData['author'], ENT_QUOTES, 'UTF-8') . '" />' . "\n";
        $tags .= '<link rel="canonical" href="' . $url . '" />' . "\n";
        return $tags;
    }

    /**
     * 获取完整的元数据数组（用于调试或扩展）
     */
    public function getAllMeta(): array
    {
        return $this->metaData;
    }
}

// ------------------ 使用示例 ------------------
$meta = new SiteMeta();

// 输出简短描述（用于首页简介）
echo $meta->generateShortDescription(80) . "\n";

// 输出站点摘要
echo $meta->generateSummary() . "\n";

// 输出HTML meta标签
echo $meta->renderMetaTags();