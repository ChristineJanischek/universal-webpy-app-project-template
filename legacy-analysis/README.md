# Legacy-Code Analyse - Upload Verzeichnis

**Dieses Verzeichnis ist gesichert und wird NICHT ins Repository committed.**

## 📁 Zweck

Dieses Verzeichnis dient zum Upload und zur Analyse von **Legacy-System Quellcode** als Ausgangssituation für:
- Code-Migrations-Analysen
- Architektur-Reviews
- Security Audits
- Best-Practice Vergleiche
- Refactoring-Planung

## 🔒 Sicherheit

- ✅ Alle Dateien in diesem Verzeichnis werden durch `.gitignore` geschützt
- ✅ Quellcode wird **nicht ins Repository committed**
- ✅ Ideal für sensible oder proprietary Code
- ✅ Nur lokal verfügbar für Analyse

## 📤 Upload-Anleitung

### 1. Quellcode hochladen
```bash
# Kopiere den Legacy-Code in dieses Verzeichnis
cp -r /path/to/legacy-system/* ./legacy-analysis/

# Oder direkt in Terminal
cd /workspaces/universal-webpy-app-project-template/legacy-analysis
# Dateien hier ablegen...
```

### 2. Struktur für Analyse
```
legacy-analysis/
├── README.md                    # Dieses Dokument
├── .gitignore                   # Schutz vor commits
└── [Legacy-System-Code]/        # Hier Upload erfolgt
    ├── src/
    ├── config/
    ├── data/
    └── docs/
```

### 3. Analyse durchführen
```bash
# Analyse-Scripts starten
cd legacy-analysis
# Hier können Analysen durchgeführt werden
```

## ⚠️ Wichtig

- **Diese Dateien werden nicht committed** (siehe `.gitignore`)
- Sensible Daten können hier sicher abgelegt werden
- Nach der Analyse: Dateien manuell löschen (nicht auto-cleanup)
- Für Archivierung: Manuell sichern (Git trägt es nicht ab)

## 📝 Dokumentation der Analyse

Wenn Sie die **Ergebnisse** der Analyse möchten:
- Erstellen Sie eine neue Analyse-Datei in `docs/handbuch/` 
- Skizzen und Diagramme können dort dokumentiert werden
- Die Analyse-Ergebnisse WERDEN committed

Beispiel:
```
docs/handbuch/
├── legacy-analysis/
│   ├── architektur-vergleich.md
│   ├── migrationsplan.md
│   └── sicherheits-audit.md
```

## 🔍 Checkliste

- [ ] Legacy-Code hochgeladen
- [ ] Verzeichnisstruktur überprüft
- [ ] Analyse durchgeführt
- [ ] Ergebnisse in `docs/handbuch/legacy-analysis/` dokumentiert
- [ ] Source-Code aus diesem Verzeichnis gelöscht

---

**Status:** ✅ Bereit zum Upload  
**Sicherheit:** ✅ Geschützt durch .gitignore  
**Backup:** ⚠️ Manuell — nicht git-verwaltbar
