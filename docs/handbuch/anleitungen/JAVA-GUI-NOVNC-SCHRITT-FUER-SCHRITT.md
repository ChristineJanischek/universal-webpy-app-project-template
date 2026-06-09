# Java-GUI im Docker-Container testen (noVNC) - Schritt-fuer-Schritt

## Ziel

Diese Anleitung zeigt, wie du die Java-Swing-GUI aus `src/volleyball` in einer Browser-Desktop-Umgebung (noVNC) startest.

Damit kannst du auch in Codespaces oder auf Rechnern ohne lokales Display die GUI demonstrieren.

---

## Voraussetzungen

1. Docker ist installiert und laeuft.
2. Repository ist im Projektroot geoeffnet.
3. Projektservices sind gestartet (optional, aber empfohlen fuer den Gesamtcheck).

```bash
cd /workspaces/universal-webpy-app-project-template
bash scripts/start-services.sh
```

Schnellweg (empfohlen):

```bash
bash scripts/start-java-gui-novnc.sh
```

Das Skript startet den noVNC-Container mit Standardwerten und zeigt dir die passende URL direkt an.

---

## Unterrichtsmodus (2-Minuten-Start)

Fuer eine schnelle Live-Demo im Unterricht reichen diese Schritte:

1. Projektservices starten:

```bash
bash scripts/start-services.sh
```

2. noVNC-Desktop starten:

```bash
bash scripts/start-java-gui-novnc.sh
```

3. Im noVNC-Terminal die GUI starten:

```bash
cd /workspace
mkdir -p build/java
javac --release 21 -d build/java src/volleyball/*.java
java -cp build/java volleyball.MainWindow
```

4. Nach der Stunde aufraeumen:

```bash
bash scripts/stop-java-gui-novnc.sh
```

Hinweis fuer Lehrkraefte:
- Falls im noVNC-Container Java noch fehlt, zuerst Schritt 3 aus dieser Anleitung ausfuehren.

---

## Schritt 1: noVNC-Desktop-Container starten

Option A (empfohlen): per Skript

```bash
bash scripts/start-java-gui-novnc.sh
```

Option B: manuell per `docker run`

```bash
docker run -d \
  --name java_gui_novnc \
  --shm-size=1g \
  -e PUID="$(id -u)" \
  -e PGID="$(id -g)" \
  -e TZ="Europe/Berlin" \
  -e CUSTOM_USER="dev" \
  -e PASSWORD="dev" \
  -p 6080:3000 \
  -v "$PWD":/workspace \
  ghcr.io/linuxserver/webtop:ubuntu-xfce
```

Hinweis:
- Die Web-Desktop-Oberflaeche ist danach auf Port `6080` erreichbar.
- Fuer Unterricht unbedingt ein eigenes Passwort statt `dev` setzen.
- Das Startskript kann ueber Umgebungsvariablen konfiguriert werden, z. B.:

```bash
NOVNC_PASSWORD='starkes-passwort' NOVNC_PORT=6080 bash scripts/start-java-gui-novnc.sh
```

---

## Schritt 2: noVNC im Browser oeffnen

Lokal:
- `http://localhost:6080`

Codespaces:
- `https://<dein-codespace>-6080.app.github.dev`

Login mit dem Passwort aus Schritt 1 (im Beispiel: `dev`).

---

## Schritt 3: Java 21 im noVNC-Desktop installieren

Im noVNC-Desktop ein Terminal oeffnen und ausfuehren:

```bash
sudo apt-get update
sudo apt-get install -y openjdk-21-jdk
java -version
javac -version
```

Erwartung: Version `21.x`.

---

## Schritt 4: Java-GUI kompilieren und starten

Im selben noVNC-Terminal:

```bash
cd /workspace
mkdir -p build/java
javac --release 21 -d build/java src/volleyball/*.java
java -cp build/java volleyball.MainWindow
```

Jetzt sollte das Fenster `Volleyball-Team-Manager` im noVNC-Desktop sichtbar sein.

---

## Schritt 5: Schnelltest der GUI

1. Kategorie waehlen (`Startaufstellung`, `Ersatzspieler`, `Kaderspieler`).
2. `anzeigen` klicken.
3. `tauschen` und `einfuegen` mit Testwerten pruefen.

Optional parallel im Host-Terminal:

```bash
bash scripts/test-java.sh
bash scripts/test-services.sh
```

---

## Aufraeumen

Nach dem Test:

```bash
bash scripts/stop-java-gui-novnc.sh
```

Alternative manuell:

```bash
docker rm -f java_gui_novnc
```

---

## Troubleshooting

### noVNC-Seite laedt nicht

Pruefen, ob der Container laeuft:

```bash
docker ps --filter name=java_gui_novnc
```

### Java-Fenster startet nicht

1. Java-Version im noVNC-Container pruefen (`java -version`).
2. Neu kompilieren mit `--release 21`.
3. Sicherstellen, dass du in `/workspace` bist.

### GUI wirkt traege

Container mit mehr Shared Memory starten, z. B. `--shm-size=2g`.
