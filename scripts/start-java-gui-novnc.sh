#!/usr/bin/env bash
set -euo pipefail

container_name="${NOVNC_CONTAINER_NAME:-java_gui_novnc}"
image="${NOVNC_IMAGE:-ghcr.io/linuxserver/webtop:ubuntu-xfce}"
host_port="${NOVNC_PORT:-6080}"
container_port="${NOVNC_CONTAINER_PORT:-3000}"
password="${NOVNC_PASSWORD:-dev}"
custom_user="${NOVNC_CUSTOM_USER:-dev}"
timezone="${NOVNC_TZ:-Europe/Berlin}"
workspace_dir="${NOVNC_WORKSPACE_DIR:-$PWD}"
shm_size="${NOVNC_SHM_SIZE:-1g}"

if ! command -v docker >/dev/null 2>&1; then
  echo "[novnc] Fehler: docker ist nicht installiert oder nicht im PATH."
  exit 1
fi

if [[ ! -d "$workspace_dir" ]]; then
  echo "[novnc] Fehler: NOVNC_WORKSPACE_DIR existiert nicht: $workspace_dir"
  exit 1
fi

if docker ps --format '{{.Names}}' | grep -qx "$container_name"; then
  echo "[novnc] Container '$container_name' laeuft bereits."
else
  if docker ps -a --format '{{.Names}}' | grep -qx "$container_name"; then
    docker start "$container_name" >/dev/null
    echo "[novnc] Container '$container_name' wurde gestartet."
  else
    docker run -d \
      --name "$container_name" \
      --shm-size="$shm_size" \
      -e "PUID=$(id -u)" \
      -e "PGID=$(id -g)" \
      -e "TZ=$timezone" \
      -e "CUSTOM_USER=$custom_user" \
      -e "PASSWORD=$password" \
      -p "$host_port:$container_port" \
      -v "$workspace_dir:/workspace" \
      "$image" >/dev/null
    echo "[novnc] Container '$container_name' wurde erstellt und gestartet."
  fi
fi

echo "[novnc] Lokaler Zugriff:    http://localhost:$host_port"
if [[ -n "${CODESPACE_NAME:-}" ]]; then
  forwarding_domain="${GITHUB_CODESPACES_PORT_FORWARDING_DOMAIN:-app.github.dev}"
  echo "[novnc] Codespaces-Zugriff: https://${CODESPACE_NAME}-${host_port}.${forwarding_domain}"
fi
echo "[novnc] Passwort: ${password}"
echo "[novnc] Stopp: bash scripts/stop-java-gui-novnc.sh"