<?php
require_once 'config.php';

$method = $_SERVER['REQUEST_METHOD'];

// GET = lecture publique (pour le site + admin)
if ($method === 'GET') {
    $products = readProducts();
    echo json_encode($products);
    exit;
}

// POST = modification (protégé)
if ($method === 'POST') {
    requireAuth();

    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['products']) || !is_array($data['products'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Données invalides']);
        exit;
    }

    $products = $data['products'];

    // Validation basique
    foreach ($products as &$product) {
        $product['id'] = isset($product['id']) ? intval($product['id']) : time() + rand(1, 9999);
        $product['basePrice'] = intval($product['basePrice'] ?? 0);
        $product['salePrice'] = !empty($product['salePrice']) ? intval($product['salePrice']) : null;
        $product['discount'] = !empty($product['discount']) ? intval($product['discount']) : null;
        $product['outOfStock'] = !empty($product['outOfStock']);

        // Nettoyage des couleurs
        if (isset($product['colors']) && is_array($product['colors'])) {
            foreach ($product['colors'] as &$color) {
                $color['name'] = htmlspecialchars(strip_tags($color['name'] ?? ''), ENT_QUOTES, 'UTF-8');
                $color['hex'] = preg_replace('/[^a-zA-Z0-9#]/', '', $color['hex'] ?? '#000000');
                $color['image'] = filter_var($color['image'] ?? '', FILTER_SANITIZE_URL);
            }
        }

        // Nettoyage des tailles
        if (isset($product['sizes']) && is_array($product['sizes'])) {
            $product['sizes'] = array_map('intval', $product['sizes']);
            sort($product['sizes']);
        }

        $product['name'] = htmlspecialchars(strip_tags($product['name'] ?? ''), ENT_QUOTES, 'UTF-8');
        $product['description'] = htmlspecialchars(strip_tags($product['description'] ?? ''), ENT_QUOTES, 'UTF-8');
        $product['image'] = filter_var($product['image'] ?? '', FILTER_SANITIZE_URL);
        $product['category'] = in_array($product['category'] ?? '', ['men', 'women', 'unisex']) 
            ? $product['category'] 
            : 'unisex';
    }

    if (writeProducts($products)) {
        echo json_encode(['success' => true, 'count' => count($products)]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Échec de l\'écriture du fichier']);
    }
    exit;
}

http_response_code(405);
echo json_encode(['error' => 'Méthode non autorisée']);
?>
