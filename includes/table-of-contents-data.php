<?php
/**
 * This file contains a function that adds unique IDs to headings in the content and generates a global `$tableOfContentsData` array.
 */

/**
 * Adds unique IDs to headings in the content and generates a table of contents data array.
 *
 * @param string $content The content to process.
 * @return string The processed content with unique IDs added to headings.
 */
global $tableOfContentsData;
function add_unique_id_to_headings($content)
{
    // Check if content is empty
    if (!$content)
        return $content;

    // Create a DOMDocument object and load the content
    $dom = new DOMDocument();
    @$dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    $xpath = new DOMXPath($dom);

    // Query all h2 and h3 elements
    $nodes = $xpath->query('//h2 | //h3');
    foreach ($nodes as $node) {
        // Add unique ID to headings that don't have one
        if (!$node->hasAttribute('id')) {
            $node->setAttribute('id', 'heading-' . uniqid());
        }
    }

    // Query all h2 and h3 elements with an ID
    $headings = $xpath->query('//h2[@id] | //h3[@id]');
    if ($headings->length) {
        // Reset the table of contents data array
        global $tableOfContentsData;
        $tableOfContentsData = array();
    }
    foreach ($headings as $heading) {
        // Add heading data to the table of contents data array
        global $tableOfContentsData;
        $tableOfContentsData[] = array(
            'title' => strip_tags($heading->textContent),
            'id' => $heading->getAttribute('id')
        );
    }

    // Save the modified HTML and return it
    $html = $dom->saveHTML();
    return $html;
}

// Add the 'add_unique_id_to_headings' function as a filter for 'the_content' hook with priority 5
add_filter('the_content', 'add_unique_id_to_headings', 5);
