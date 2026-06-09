#!/usr/bin/env bash
set -euo pipefail

required_java_major=21

java_major_of() {
	local cmd="$1"
	if ! command -v "$cmd" >/dev/null 2>&1; then
		echo 0
		return
	fi

	local version_line major
	version_line="$($cmd -version 2>&1 | head -n1)"
	major="$(echo "$version_line" | sed -E 's/.*version "?([0-9]+).*/\1/')"
	if [[ "$major" =~ ^[0-9]+$ ]]; then
		echo "$major"
	else
		echo 0
	fi
}

run_local_java_test() {
	mkdir -p build/java
	javac --release "$required_java_major" -d build/java src/volleyball/*.java

	echo "[java] Kompilierung erfolgreich (Java ${required_java_major})"

	echo "[java] Starte Headless-Modell-Smoke-Tests..."
	java -cp build/java volleyball.ModelSmokeTest

	echo "[java] Modell-Tests erfolgreich"
}

run_docker_java_test() {
	if ! command -v docker >/dev/null 2>&1; then
		echo "[java] Fehler: Weder lokales JDK ${required_java_major}+ noch Docker verfuegbar."
		exit 1
	fi

	if [[ ! -f docker-compose.yml ]] || ! grep -qE "^[[:space:]]{2}java-test:" docker-compose.yml; then
		echo "[java] Fehler: docker-compose Service 'java-test' ist nicht konfiguriert."
		exit 1
	fi

	echo "[java] Lokales JDK ${required_java_major}+ nicht verfuegbar, nutze Docker-Service 'java-test'..."
	docker compose --profile test run --rm java-test
}

java_major="$(java_major_of java)"
javac_major="$(java_major_of javac)"

if [[ "$java_major" -ge "$required_java_major" && "$javac_major" -ge "$required_java_major" ]]; then
	run_local_java_test
else
	run_docker_java_test
fi
