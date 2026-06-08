<?php

declare(strict_types=1);

/** @var array<string, mixed> $schema */
/** @var string $tool */
/** @var string $engine */
/** @var array<string, mixed>|null $result */
/** @var array<string, string> $oldInput */

function esc_view(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$current = $schema[$tool] ?? null;
if ($current === null) {
    http_response_code(404);
    echo 'Tool nicht gefunden.';
    return;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyTheme Lern-App</title>
    <link rel="stylesheet" href="app/view/app_view.css">
</head>
<body>
<div class="app-shell">
    <aside class="app-nav">
        <div class="brand">
            <h1>MyTheme Lern-App</h1>
            <p>Rechner und Automaten im MVC-Format</p>
        </div>
        <button class="menu-toggle" type="button" id="menuToggle" aria-expanded="false">Menue</button>
        <ul class="menu-list" id="menuList">
            <?php foreach ($schema as $slug => $meta): ?>
                <li>
                    <a href="app_controler.php?tool=<?= esc_view((string) $slug) ?>" class="<?= $slug === $tool ? 'active' : '' ?>">
                        <?= esc_view((string) $meta['title']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </aside>

    <main class="app-main">
        <div class="badges">
            <span class="badge"><?= esc_view((string) $current['type']) ?></span>
            <span class="badge">Engine: <?= esc_view($engine) ?></span>
        </div>

        <h2><?= esc_view((string) $current['title']) ?></h2>
        <p><?= esc_view((string) $current['description']) ?></p>

        <form method="post" action="app_controler.php?tool=<?= esc_view($tool) ?>">
            <input type="hidden" name="tool" value="<?= esc_view($tool) ?>">

            <div class="engine-switch">
                <label>
                    <input type="radio" name="engine" value="php" <?= $engine === 'php' ? 'checked' : '' ?>> PHP
                </label>
                <label>
                    <input type="radio" name="engine" value="python" <?= $engine === 'python' ? 'checked' : '' ?>> Python
                </label>
            </div>

            <div class="form-grid">
                <?php foreach ($current['fields'] as $field): ?>
                    <?php
                    $name = (string) $field['name'];
                    $label = (string) $field['label'];
                    $type = (string) $field['type'];
                    $required = !empty($field['required']);
                    $value = $oldInput[$name] ?? '';
                    $showOn = isset($field['show_on']) && is_array($field['show_on']) ? implode(',', $field['show_on']) : '';
                    ?>
                    <div class="form-field <?= $type === 'text' ? 'full' : '' ?>" data-field-name="<?= esc_view($name) ?>" data-show-on="<?= esc_view($showOn) ?>">
                        <label for="<?= esc_view($name) ?>"><?= esc_view($label) ?></label>
                        <?php if (isset($field['help'])): ?>
                            <small class="field-help"><?= esc_view((string) $field['help']) ?></small>
                        <?php endif; ?>

                        <?php if ($type === 'select'): ?>
                            <select id="<?= esc_view($name) ?>" name="<?= esc_view($name) ?>" <?= $required ? 'required' : '' ?>>
                                <?php foreach ($field['options'] as $option): ?>
                                    <?php
                                    $optValue = (string) $option['value'];
                                    $selected = $value === $optValue ? 'selected' : '';
                                    ?>
                                    <option value="<?= esc_view($optValue) ?>" <?= $selected ?>>
                                        <?= esc_view((string) $option['label']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        <?php else: ?>
                            <input
                                id="<?= esc_view($name) ?>"
                                type="<?= esc_view($type) ?>"
                                name="<?= esc_view($name) ?>"
                                value="<?= esc_view($value) ?>"
                                <?= isset($field['step']) ? 'step="' . esc_view((string) $field['step']) . '"' : '' ?>
                                <?= isset($field['min']) ? 'min="' . esc_view((string) $field['min']) . '"' : '' ?>
                                <?= isset($field['max']) ? 'max="' . esc_view((string) $field['max']) . '"' : '' ?>
                                <?= isset($field['placeholder']) ? 'placeholder="' . esc_view((string) $field['placeholder']) . '"' : '' ?>
                                <?= $required ? 'required' : '' ?>
                            >
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <p><button type="submit" name="run" value="1">Auswerten</button></p>
        </form>

        <?php if (is_array($result) && !empty($result['ok'])): ?>
            <section class="result">
                <h3><?= esc_view((string) ($result['title'] ?? 'Ergebnis')) ?></h3>
                <table>
                    <tbody>
                    <?php foreach (($result['rows'] ?? []) as $row): ?>
                        <tr>
                            <th><?= esc_view((string) ($row['label'] ?? '')) ?></th>
                            <td><?= esc_view((string) ($row['value'] ?? '')) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        <?php elseif (is_array($result) && isset($result['error'])): ?>
            <section class="error-box">
                <strong>Fehler:</strong> <?= esc_view((string) $result['error']) ?>
            </section>
        <?php endif; ?>
    </main>
</div>
<script>
    (function () {
        var toggle = document.getElementById('menuToggle');
        var menu = document.getElementById('menuList');
        if (!toggle || !menu) return;
        toggle.addEventListener('click', function () {
            menu.classList.toggle('open');
            var expanded = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', expanded ? 'false' : 'true');
        });

        var aktion = document.getElementById('aktion');
        if (aktion) {
            var allFields = document.querySelectorAll('.form-field[data-show-on]');

            function setFieldEnabled(input, enabled) {
                if (!input) return;
                if (enabled) {
                    if (input.dataset.requiredBase === 'true') {
                        input.setAttribute('required', 'required');
                    }
                    input.removeAttribute('disabled');
                } else {
                    input.removeAttribute('required');
                    input.setAttribute('disabled', 'disabled');
                }
            }

            function toggleVolleyballFields() {
                var actionValue = aktion.value;

                allFields.forEach(function (field) {
                    var showOn = field.getAttribute('data-show-on');
                    if (!showOn) {
                        field.classList.remove('is-hidden');
                        return;
                    }

                    var allowed = showOn.split(',').map(function (item) { return item.trim(); });
                    var visible = allowed.indexOf(actionValue) !== -1;
                    var input = field.querySelector('input, select');

                    if (input && !input.dataset.requiredBase) {
                        input.dataset.requiredBase = input.hasAttribute('required') ? 'true' : 'false';
                    }

                    if (visible) {
                        field.classList.remove('is-hidden');
                        setFieldEnabled(input, true);
                    } else {
                        field.classList.add('is-hidden');
                        setFieldEnabled(input, false);
                    }
                });
            }

            aktion.addEventListener('change', toggleVolleyballFields);
            toggleVolleyballFields();
        }
    })();
</script>
</body>
</html>
