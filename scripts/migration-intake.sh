#!/usr/bin/env bash
set -euo pipefail

if [[ $# -lt 1 ]]; then
  echo "Verwendung: bash scripts/migration-intake.sh <projekt-name>"
  exit 1
fi

raw_name="$1"
slug="$(echo "$raw_name" | tr '[:upper:]' '[:lower:]' | sed -E 's/[^a-z0-9]+/-/g; s/^-+|-+$//g')"

if [[ -z "$slug" ]]; then
  echo "[migration] Fehler: Projektname ergibt keinen gueltigen Slug."
  exit 1
fi

base_dir="private-project-upload/$slug"
today="$(date +%Y-%m-%d)"

mkdir -p "$base_dir/source/php" "$base_dir/source/python" "$base_dir/source/java" "$base_dir/migration"

plan_file="$base_dir/migration/MIGRATIONSPLAN.md"
if [[ ! -f "$plan_file" ]]; then
  cat > "$plan_file" <<EOF
# Migrationsplan: $raw_name

- Erstellt am: $today
- Slug: $slug
- Status: intake

## Upload-Status

- [ ] PHP-Quellen unter source/php abgelegt
- [ ] Python-Quellen unter source/python abgelegt
- [ ] Java-Quellen unter source/java abgelegt

## Zielbild (SSOT)

- [ ] Tool-Schema in webapp/public/MyTheme/app/modell/form_schema_modell.php ergaenzen
- [ ] PHP-Engine in webapp/public/MyTheme/app/modell/php_engine_modell.php ergaenzen
- [ ] Python-Engine in webapp/public/MyTheme/pyApp/FormEvaluator.py ergaenzen
- [ ] Java-Variante fachlich dokumentieren und testen

## Qualitaetsgates

- [ ] bash scripts/validate-tool-parity.sh
- [ ] bash scripts/test-services.sh
- [ ] bash scripts/validate-security.sh
- [ ] bash scripts/validate-architecture.sh
- [ ] bash scripts/validate-docs.sh

## Notizen

-
EOF
fi

echo "[migration] Intake-Struktur bereit: $base_dir"
echo "[migration] Plan: $plan_file"
