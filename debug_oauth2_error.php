<?php
echo "=== GOOGLE OAUTH2 ERROR 400 TROUBLESHOOTING ===\n\n";

// Check current configuration
echo "1. Checking OAuth2 Configuration:\n";
if (file_exists('oauth2callback/config.oauth2.php')) {
    $config = include 'oauth2callback/config.oauth2.php';
    $google_config = $config['Google'] ?? [];
    
    echo "Client ID: " . ($google_config['clientId'] ?? 'NOT SET') . "\n";
    echo "Client Secret: " . (isset($google_config['clientSecret']) ? 'SET' : 'NOT SET') . "\n";
    
    // Check if still using placeholder values
    if ($google_config['clientId'] === 'your-client-id.apps.googleusercontent.com') {
        echo "❌ ERROR: Still using placeholder Client ID!\n";
    }
    if ($google_config['clientSecret'] === 'your-client-secret') {
        echo "❌ ERROR: Still using placeholder Client Secret!\n";
    }
} else {
    echo "❌ Config file not found\n";
}

// Check database configuration
echo "\n2. Checking Database Configuration:\n";
$conn = new mysqli('localhost', 'root', '', 'demo');
$result = $conn->query("SELECT * FROM vtiger_systems WHERE server_type='email'");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "Server: " . $row['server'] . "\n";
    echo "Username: " . $row['server_username'] . "\n";
    echo "Auth Type: " . $row['smtp_auth_type'] . "\n";
}

// Common Error 400 causes
echo "\n3. COMMON ERROR 400 CAUSES:\n";
echo "❌ Invalid Client ID/Secret (placeholder values)\n";
echo "❌ Wrong Redirect URI in Google Console\n";
echo "❌ Missing scopes in Google Console\n";
echo "❌ Project not properly configured\n";

echo "\n4. REQUIRED REDIRECT URI:\n";
echo "Add this EXACT URL to Google Console:\n";
echo "http://localhost/vtigercrm/oauth2callback/index.php\n";

echo "\n5. REQUIRED SCOPES:\n";
echo "Make sure these scopes are enabled in Google Console:\n";
echo "- https://www.googleapis.com/auth/gmail.send\n";
echo "- https://mail.google.com/\n";

$conn->close();
?>