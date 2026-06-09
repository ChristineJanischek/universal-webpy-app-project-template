#!/usr/bin/env bash
set -euo pipefail

schema_file="webapp/public/MyTheme/app/modell/form_schema_modell.php"
php_file="webapp/public/MyTheme/app/modell/php_engine_modell.php"
python_file="webapp/public/MyTheme/pyApp/FormEvaluator.py"

for file in "$schema_file" "$php_file" "$python_file"; do
  if [[ ! -f "$file" ]]; then
    echo "[parity] Fehler: Datei fehlt: $file"
    exit 1
  fi
done

schema_tools="$({ grep -oE "^        '[a-z0-9_]+' => \[" "$schema_file" || true; } | sed -E "s/^        '([a-z0-9_]+)'.*/\1/" | sort -u)"
php_tools="$({ grep -oE "case '[a-z0-9_]+'" "$php_file" || true; } | sed -E "s/case '([a-z0-9_]+)'/\1/" | sort -u)"
python_tools="$({ grep -oE '"[a-z0-9_]+": [a-z_]+_model' "$python_file" || true; } | sed -E 's/"([a-z0-9_]+)":.*/\1/' | sort -u)"

missing_in_php="$(comm -23 <(printf '%s\n' "$schema_tools" | sed '/^$/d') <(printf '%s\n' "$php_tools" | sed '/^$/d') || true)"
missing_in_python="$(comm -23 <(printf '%s\n' "$schema_tools" | sed '/^$/d') <(printf '%s\n' "$python_tools" | sed '/^$/d') || true)"

extra_php="$(comm -13 <(printf '%s\n' "$schema_tools" | sed '/^$/d') <(printf '%s\n' "$php_tools" | sed '/^$/d') || true)"
extra_python="$(comm -13 <(printf '%s\n' "$schema_tools" | sed '/^$/d') <(printf '%s\n' "$python_tools" | sed '/^$/d') || true)"

if [[ -n "$missing_in_php" || -n "$missing_in_python" || -n "$extra_php" || -n "$extra_python" ]]; then
  echo "[parity] FAIL: Tool-Paritaet ist inkonsistent."
  [[ -n "$missing_in_php" ]] && echo "[parity] Fehlend in PHP: $missing_in_php"
  [[ -n "$missing_in_python" ]] && echo "[parity] Fehlend in Python: $missing_in_python"
  [[ -n "$extra_php" ]] && echo "[parity] Nur in PHP vorhanden: $extra_php"
  [[ -n "$extra_python" ]] && echo "[parity] Nur in Python vorhanden: $extra_python"
  exit 1
fi

echo "[parity] Tool-Paritaet erfolgreich (Schema = PHP = Python)"
