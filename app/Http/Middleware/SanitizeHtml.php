<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Sanitizes HTML input fields to prevent XSS attacks.
 *
 * Allows safe HTML tags (headings, paragraphs, lists, links, images, formatting)
 * while stripping out dangerous elements like <script>, <iframe>, event handlers, etc.
 *
 * Apply this middleware to routes that accept rich-text user input
 * (stories, news, posts, notices, etc.)
 */
class SanitizeHtml
{
    /**
     * Fields that should be treated as rich HTML (not fully stripped).
     * All other string fields will be fully escaped.
     */
    protected array $htmlFields = [
        'body',
        'details',
        'description',
        'content',
        'responsibilities',
        'requirements',
        'bio',
    ];

    /**
     * Tags allowed in rich HTML fields.
     */
    protected string $allowedTags = '<h1><h2><h3><h4><h5><h6><p><br><hr><ul><ol><li><a><img><strong><b><em><i><u><s><blockquote><pre><code><table><thead><tbody><tr><th><td><span><div><figure><figcaption><sub><sup>';

    public function handle(Request $request, Closure $next)
    {
        $input = $request->all();
        $cleaned = $this->sanitize($input);
        $request->merge($cleaned);

        return $next($request);
    }

    protected function sanitize(array $data): array
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = $this->sanitize($value);
            } elseif (is_string($value)) {
                if (in_array($key, $this->htmlFields)) {
                    // Rich HTML field: strip dangerous tags but keep safe ones
                    $data[$key] = $this->cleanHtml($value);
                }
                // Non-HTML string fields are escaped by Blade's {{ }} automatically
            }
        }

        return $data;
    }

    /**
     * Remove dangerous HTML while keeping safe structural tags.
     */
    protected function cleanHtml(string $html): string
    {
        // Remove <script> tags and their contents
        $html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);

        // Remove <iframe>, <object>, <embed>, <applet>, <form> tags and contents
        $html = preg_replace('#<(iframe|object|embed|applet|form)(.*?)>(.*?)</\1>#is', '', $html);
        // Also catch self-closing versions
        $html = preg_replace('#<(iframe|object|embed|applet|form)(.*?)\s*/?>#is', '', $html);

        // Remove event handlers (onclick, onerror, onload, onmouseover, etc.)
        $html = preg_replace('#\s*on\w+\s*=\s*["\'][^"\']*["\']#is', '', $html);
        $html = preg_replace('#\s*on\w+\s*=\s*\S+#is', '', $html);

        // Remove javascript: and data: URIs in href/src attributes
        $html = preg_replace('#(href|src)\s*=\s*["\']?\s*(javascript|data|vbscript)\s*:[^"\'>\s]*["\']?#is', '$1=""', $html);

        // Strip remaining disallowed tags
        $html = strip_tags($html, $this->allowedTags);

        return $html;
    }
}
