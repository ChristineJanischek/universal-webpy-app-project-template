# Legacy-System Analyse Dokumentation

Dieses Verzeichnis enthält die **Analyseergebnisse** von Legacy-System-Code. Diese Dateien werden ins Repository committed.

## 📋 Inhalte

### Struktur für Analyseergebnisse

```
legacy-analysis/
├── README.md                     # Dieses Dokument
├── 01-SYSTEMUEBERSICHT.md        # Uebersicht des Legacy-Systems
├── 02-ARCHITEKTUR-ANALYSE.md     # Architektur-Analyse
├── 03-CODEQUALITAET-AUDIT.md     # Code-Qualitaet & Probleme
├── 04-SICHERHEITS-AUDIT.md       # Sicherheitsprobleme
├── 05-MIGRATIONSPLAN.md          # Plan fuer Migration
├── 06-SCHAETZUNGEN.md            # Zeit- & Ressourcenschaetzungen
└── 99-DIAGRAMME/                 # PlantUML/Mermaid Diagramme
    ├── ARCHITEKTUR.md
    ├── DATENFLUSS.md
    └── ABHAENGIGKEITEN.md
```

## 📝 Wie man eine Analyse dokumentiert

### 1. Template für neue Analysedatei

```markdown
# Legacy-System Analyse: [Tema]

**Datum:** 14. April 2026
**Analysiert von:** [Name]
**Status:** Abgeschlossen / In Progress

## Zusammenfassung
[Kurze Übersicht]

## Erkenntnisse
- Punkt 1
- Punkt 2

## Empfehlungen
1. Aktion 1
2. Aktion 2
```

### 2. Upload-Prozess

1. **Quellcode:** In `/legacy-analysis/` hochladen (wird nicht committed)
2. **Analyse:** Code analysieren und verstehen
3. **Dokumentation:** Ergebnisse hier dokumentieren (wird committed)
4. **Nach Fertig:** Quellcode aus `/legacy-analysis/` löschen

### 3. Git-Behandlung

```bash
# Nur Analyseergebnisse committed:
git add docs/handbuch/legacy-analysis/
git commit -m "Legacy Analysis: [Thema]"

# Quellcode wird NICHT committed:
# (automatisch durch .gitignore geschützt)
```

## 📊 Analyse-Checkliste

- [ ] Quellcode-Struktur verstanden
- [ ] Architektur dokumentiert
- [ ] Codequalität bewertet
- [ ] Sicherheitsprobleme identifiziert
- [ ] Migrationsplan erstellt
- [ ] Schätzungen gemacht
- [ ] Diagramme erstellt

## 🔗 Verwandte Ressourcen

- Quellcode-Upload: [`/legacy-analysis/README.md`](../../../legacy-analysis/README.md)
- Migrationshandbuch: (noch zu erstellen)
- Refactoring-Guide: (noch zu erstellen)

---

**Status:** ✅ Ready für Analysen  
**Sicherheit:** ✅ Analyseergebnisse werden committed, Quellcode bleibt privat
