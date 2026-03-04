<?php
/**
 * CSRF Secret Configuration Template
 * 
 * Copy file này thành config.csrf-secret.php
 * Và thay thế secret bằng giá trị từ .env
 */

// Load environment if not already loaded
if (!function_exists('env')) {
    require_once('env.loader.php');
}

// Get CSRF secret from environment
$secret = env('CSRF_SECRET', '');

// Fallback for development - MUST set in .env for production
if (empty($secret)) {
    $secret = md5(__DIR__ . 'csrf_default_secret');
}
