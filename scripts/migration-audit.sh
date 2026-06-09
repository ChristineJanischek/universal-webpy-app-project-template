#!/usr/bin/env bash
set -euo pipefail

if [[ $# -lt 1 ]]; then
  echo "Verwendung: bash scripts/migration-audit.sh <projekt-slug>"
  exit 1
fi

slug="$1"
base_dir="private-project-upload/$slug"

if [[ ! -d "$base_dir" ]]; then
  echo "[migration] Fehler: Projektordner nicht gefunden: $base_dir"
  exit 1
fi

missing=0

for lang in php python java; do
  dir="$base_dir/source/$lang"
  if [[ ! -d "$dir" ]]; then
    echo "[migration] Fehlender Ordner: $dir"
    missing=1
    continue
  fi

  if [[ -z "$(find "$dir" -type f 2>/dev/null | head -n 1)" ]]; then
    echo "[migration] Hinweis: Keine Dateien in $dir gefunden."
    missing=1
  fi
done

if [[ $missing -ne 0 ]]; then
  echo "[migration] Audit nicht bestanden: Upload unvollstaendig."
  exit 1
fi

bash scripts/validate-tool-parity.sh

echo "[migration] Audit erfolgreich fuer $slug"
