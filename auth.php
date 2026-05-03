<?php
require_once 'config.php';

$action = $_GET['action'] ?? '';

if ($action === 'login') {
    $data = json_decode(file_get_contents('php://input'), true);
    $password = $data['password'] ?? '';

    if (password_verify($password, ADMIN_PASSWORD_HASH)) {
        $_SESSION[SESSION_KEY] = true;
        echo json_encode(['success' => true, 'message' => 'Connecté']);
    } else {
        http_response_code(401);
        echo json_encode(['success' => false, 'error' => 'Mot de passe incorrect']);
    }
    exit;
}

if ($action === 'logout') {
    unset($_SESSION[SESSION_KEY]);
    session_destroy();
    echo json_encode(['success' => true]);
    exit;
}

if ($action === 'check') {
    echo json_encode(['authenticated' => isAuthenticated()]);
    exit;
}

http_response_code(400);
echo json_encode(['error' => 'Action invalide']);
?>
