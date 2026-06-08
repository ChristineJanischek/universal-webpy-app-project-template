<?php

declare(strict_types=1);

require_once __DIR__ . '/app/controler/tools_controler.php';

$schema = get_tool_schema_modell();
$tool = (string) ($_GET['tool'] ?? $_POST['tool'] ?? 'bmi');
if (!isset($schema[$tool])) {
    $tool = 'bmi';
}

$engine = (string) ($_POST['engine'] ?? $_GET['engine'] ?? 'php');
$engine = $engine === 'python' ? 'python' : 'php';

$result = null;
$oldInput = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['run'])) {
    $oldInput = sanitize_input_controler($_POST);
    $result = run_tool_controler($tool, $oldInput, $engine);
}

require __DIR__ . '/app/view/app_view.php';
