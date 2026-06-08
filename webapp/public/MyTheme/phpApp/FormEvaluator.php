<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/modell/php_engine_modell.php';

header('Content-Type: application/json; charset=utf-8');

$raw = file_get_contents('php://input');
if (!is_string($raw) || $raw === '') {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Leerer Request.']);
    exit;
}

$data = json_decode($raw, true);
if (!is_array($data)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Ungueltiges JSON.']);
    exit;
}

$tool = (string) ($data['tool'] ?? '');
$input = is_array($data['input'] ?? null) ? $data['input'] : [];

try {
    $result = evaluate_with_php_modell($tool, $input);
} catch (Throwable $e) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'error' => 'Eingaben sind ungueltig.']);
    exit;
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
