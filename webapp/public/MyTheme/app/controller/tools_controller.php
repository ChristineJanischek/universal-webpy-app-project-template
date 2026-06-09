<?php

declare(strict_types=1);

require_once __DIR__ . '/../modell/form_schema_modell.php';
require_once __DIR__ . '/../modell/php_engine_modell.php';
require_once __DIR__ . '/../modell/python_bridge_modell.php';

function sanitize_input_controller(array $raw): array
{
    $result = [];
    foreach ($raw as $key => $value) {
        if (is_array($value)) {
            continue;
        }
        $result[(string) $key] = trim((string) $value);
    }
    return $result;
}

function run_tool_controller(string $tool, array $input, string $engine): array
{
    $schema = get_tool_schema_modell();
    if (!isset($schema[$tool])) {
        return ['ok' => false, 'error' => 'Tool nicht gefunden.'];
    }

    try {
        if ($engine === 'python') {
            $result = evaluate_with_python_modell($tool, $input);
        } else {
            $result = evaluate_with_php_modell($tool, $input);
        }
    } catch (Throwable $e) {
        return ['ok' => false, 'error' => 'Ungueltige Eingabe.'];
    }

    if (!isset($result['engine'])) {
        $result['engine'] = $engine;
    }

    return $result;
}

// Backward-compatible aliases for older includes.
function sanitize_input_controler(array $raw): array
{
    return sanitize_input_controller($raw);
}

function run_tool_controler(string $tool, array $input, string $engine): array
{
    return run_tool_controller($tool, $input, $engine);
}
