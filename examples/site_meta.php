<?php
/**
 * Site metadata management for example repository.
 * 
 * This file provides a data structure and helper functions to manage
 * site information, including name, description, keywords, and URL.
 * It is intended for use in static site generators or simple CMS contexts.
 */

/**
 * Represents the metadata for a single site or project.
 */
class SiteMeta {
    /** @var string Site name */
    public string $name;

    /** @var string Site description */
    public string $description;

    /** @var string Site URL */
    public string $url;

    /** @var array List of keywords */
    public array $keywords;

    /** @var string Language code (e.g., zh-CN) */
    public string $language;

    /** @var string Author or maintainer */
    public string $author;

    /** @var int Version of this metadata schema */
    public int $version;

    /**
     * Constructor.
     *
     * @param string $name        Site name.
     * @param string $description Brief description.
     * @param string $url         Site URL.
     * @param array  $keywords    Associated keywords.
     * @param string $language    Language code.
     * @param string $author      Author name.
     * @param int    $version     Metadata version.
     */
    public function __construct(
        string $name,
        string $description,
        string $url,
        array $keywords,
        string $language = 'zh-CN',
        string $author = 'Example Team',
        int $version = 1
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->url = $url;
        $this->keywords = $keywords;
        $this->language = $language;
        $this->author = $author;
        $this->version = $version;
    }

    /**
     * Generate a short description text that combines name, URL, and keywords.
     *
     * @param int $maxLength Maximum length of the description (optional).
     * @return string A concise description string.
     */
    public function generateShortDescription(int $maxLength = 150): string {
        $keywordStr = implode(', ', $this->keywords);
        $base = sprintf(
            '%s (%s) — 关键词：%s。',
            $this->name,
            $this->url,
            $keywordStr
        );

        if (mb_strlen($base) <= $maxLength) {
            return $base;
        }

        // Truncate and append ellipsis if too long.
        return mb_substr($base, 0, $maxLength - 3) . '...';
    }

    /**
     * Return a plain text summary line.
     *
     * @return string Summary in plain text.
     */
    public function toPlainText(): string {
        return sprintf(
            "Site: %s\nURL: %s\nDescription: %s\nKeywords: %s\nLanguage: %s\nAuthor: %s\nVersion: %d",
            $this->name,
            $this->url,
            $this->description,
            implode(', ', $this->keywords),
            $this->language,
            $this->author,
            $this->version
        );
    }

    /**
     * Return HTML-safe summary for embedding in web pages.
     *
     * @return string HTML-safe description.
     */
    public function toHtml(): string {
        $escapedName = htmlspecialchars($this->name, ENT_QUOTES, 'UTF-8');
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES, 'UTF-8');
        $escapedDesc = htmlspecialchars($this->description, ENT_QUOTES, 'UTF-8');
        $escapedKeywords = htmlspecialchars(implode(', ', $this->keywords), ENT_QUOTES, 'UTF-8');

        return "<div class=\"site-meta\">"
            . "<h3>{$escapedName}</h3>"
            . "<p>URL: <a href=\"{$escapedUrl}\">{$escapedUrl}</a></p>"
            . "<p>{$escapedDesc}</p>"
            . "<p>关键词: {$escapedKeywords}</p>"
            . "</div>";
    }
}

/**
 * Create a default SiteMeta instance with example data.
 *
 * @return SiteMeta
 */
function createDefaultSiteMeta(): SiteMeta {
    return new SiteMeta(
        name: '爱游戏',
        description: '提供最新游戏资讯和攻略社区，专注于玩家体验。',
        url: 'https://cnofficial-i-game.com.cn',
        keywords: ['爱游戏', '游戏资讯', '攻略', '社区'],
        language: 'zh-CN',
        author: '爱游戏团队',
        version: 2
    );
}

/**
 * Generate a short description from a SiteMeta instance.
 *
 * @param SiteMeta $meta The metadata object.
 * @return string Short description.
 */
function describeSite(SiteMeta $meta): string {
    return $meta->generateShortDescription(120);
}

// --- Example usage (uncomment to test) ---
/*
$site = createDefaultSiteMeta();
echo describeSite($site) . "\n";
echo $site->toPlainText() . "\n";
echo $site->toHtml() . "\n";
*/