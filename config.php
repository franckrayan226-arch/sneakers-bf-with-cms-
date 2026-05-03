<?php
session_start();

// === CONFIGURATION ===
// Change ce mot de passe ! Génère un hash avec : password_hash('tonmotdepasse', PASSWORD_DEFAULT)
// Par défaut : mot de passe = "admin123"
define('ADMIN_PASSWORD_HASH', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
define('PRODUCTS_FILE', __DIR__ . '/products.json');
define('SESSION_KEY', 'cms_auth_2026');

// CORS pour autoriser ton domaine (modifie si besoin)
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

function isAuthenticated() {
    return isset($_SESSION[SESSION_KEY]) && $_SESSION[SESSION_KEY] === true;
}

function requireAuth() {
    if (!isAuthenticated()) {
        http_response_code(401);
        echo json_encode(['error' => 'Non authentifié']);
        exit;
    }
}

function readProducts() {
    if (!file_exists(PRODUCTS_FILE)) {
        return [];
    }
    $content = file_get_contents(PRODUCTS_FILE);
    return json_decode($content, true) ?: [];
}

function writeProducts($products) {
    $json = json_encode($products, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    if ($json === false) {
        return false;
    }
    // Backup avant écriture
    if (file_exists(PRODUCTS_FILE)) {
        copy(PRODUCTS_FILE, PRODUCTS_FILE . '.backup.' . time());
    }
    return file_put_contents(PRODUCTS_FILE, $json) !== false;
}
?>
