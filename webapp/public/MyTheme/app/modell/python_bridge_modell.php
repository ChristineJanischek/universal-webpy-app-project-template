<?php

declare(strict_types=1);

function evaluate_with_python_modell(string $tool, array $input): array
{
    $pythonScript = __DIR__ . '/../../pyApp/FormEvaluator.py';

    if (!is_file($pythonScript)) {
        return ['ok' => false, 'error' => 'Python-Engine ist nicht verfuegbar.'];
    }

    $payload = json_encode(['tool' => $tool, 'input' => $input], JSON_UNESCAPED_UNICODE);
    if ($payload === false) {
        return ['ok' => false, 'error' => 'Eingaben konnten nicht verarbeitet werden.'];
    }

    $descriptorSpec = [
        0 => ['pipe', 'r'],
        1 => ['pipe', 'w'],
        2 => ['pipe', 'w'],
    ];

    $process = proc_open('python3 ' . escapeshellarg($pythonScript), $descriptorSpec, $pipes);
    if (!is_resource($process)) {
        return ['ok' => false, 'error' => 'Python-Prozess konnte nicht gestartet werden.'];
    }

    fwrite($pipes[0], $payload);
    fclose($pipes[0]);

    $stdout = stream_get_contents($pipes[1]);
    fclose($pipes[1]);
    $stderr = stream_get_contents($pipes[2]);
    fclose($pipes[2]);

    $exitCode = proc_close($process);
    if ($exitCode !== 0) {
        return ['ok' => false, 'error' => 'Python-Fehler bei der Auswertung.', 'details' => trim((string) $stderr)];
    }

    $decoded = json_decode((string) $stdout, true);
    if (!is_array($decoded)) {
        return ['ok' => false, 'error' => 'Python-Antwort ist ungueltig.'];
    }

    return $decoded;
}
