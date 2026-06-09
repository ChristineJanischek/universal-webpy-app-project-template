#!/usr/bin/env bash
set -euo pipefail

container_name="${NOVNC_CONTAINER_NAME:-java_gui_novnc}"

if ! command -v docker >/dev/null 2>&1; then
  echo "[novnc] Fehler: docker ist nicht installiert oder nicht im PATH."
  exit 1
fi

if docker ps -a --format '{{.Names}}' | grep -qx "$container_name"; then
  docker rm -f "$container_name" >/dev/null
  echo "[novnc] Container '$container_name' wurde entfernt."
else
  echo "[novnc] Kein Container '$container_name' vorhanden."
fi