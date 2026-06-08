<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/modell/php_engine_modell.php';

header('Content-Type: application/json; charset=utf-8');

$input = [
    'aktion' => (string) ($_POST['aktion'] ?? 'anzeigen_kader'),
    'liste' => (string) ($_POST['liste'] ?? 'Kaderliste'),
    'von' => (string) ($_POST['von'] ?? ''),
    'nach' => (string) ($_POST['nach'] ?? ''),
    'spielername' => (string) ($_POST['spielername'] ?? ''),
    'position_insert' => (string) ($_POST['position_insert'] ?? ''),
    'position_delete' => (string) ($_POST['position_delete'] ?? ''),
    'sortierart' => (string) ($_POST['sortierart'] ?? 'BubbleSort'),
    'suchart' => (string) ($_POST['suchart'] ?? 'LineareSuche'),
];

try {
    $result = evaluate_with_php_modell('volleyball', $input);
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
} catch (Throwable $e) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'error' => 'Volleyball-Eingaben sind ungueltig.']);
}
