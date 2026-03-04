<?php
/**
 * Environment Loader for CUSC CRM
 * 
 * Đọc cấu hình từ file .env
 * Sử dụng: include('env.loader.php');
 */

/**
 * Load environment variables from .env file
 */
function loadEnv($path = null) {
    if ($path === null) {
        $path = dirname(__FILE__) . '/.env';
    }
    
    if (!file_exists($path)) {
        return false;
    }
    
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    foreach ($lines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        
        // Parse key=value
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            
            // Remove quotes if present
            if (preg_match('/^(["\'])(.*)\\1$/', $value, $matches)) {
                $value = $matches[2];
            }
            
            // Set environment variable
            if (!array_key_exists($key, $_ENV)) {
                $_ENV[$key] = $value;
                putenv("$key=$value");
            }
        }
    }
    
    return true;
}

/**
 * Get environment variable with default value
 */
function env($key, $default = null) {
    $value = getenv($key);
    
    if ($value === false) {
        $value = isset($_ENV[$key]) ? $_ENV[$key] : $default;
    }
    
    // Handle null/empty
    if ($value === null || $value === '') {
        return $default;
    }
    
    // Convert string booleans
    switch (strtolower($value)) {
        case 'true':
        case '(true)':
            return true;
        case 'false':
        case '(false)':
            return false;
        case 'null':
        case '(null)':
            return null;
        case 'empty':
        case '(empty)':
            return '';
    }
    
    return $value;
}

/**
 * Get branding configuration for templates
 */
function getBrandingConfig() {
    return array(
        'app_name' => env('APP_NAME', 'CUSC CRM'),
        'app_tagline' => env('APP_TAGLINE', 'Customer Relationship Management'),
        'app_logo' => env('APP_LOGO', 'layouts/v7/resources/Images/cusc-logo.png'),
        'login_background' => env('LOGIN_BACKGROUND', 'layouts/v7/resources/Images/cusc-login-bg.jpg'),
        'app_copyright' => env('APP_COPYRIGHT', '© ' . date('Y') . ' CUSC CRM'),
        'app_website' => env('APP_WEBSITE', ''),
        'show_marketing_panel' => env('SHOW_MARKETING_PANEL', true),
        'marketing_title' => env('MARKETING_TITLE', 'Welcome'),
        'marketing_description' => env('MARKETING_DESCRIPTION', ''),
        'marketing_features' => explode('|', env('MARKETING_FEATURES', '')),
    );
}

// Auto-load .env if exists
loadEnv();
