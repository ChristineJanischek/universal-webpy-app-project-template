# MARSCHPLAN WEBAPP (BEREINIGT)

## Zweck

Dieser Marschplan ist keine Umsetzungsanleitung mehr, sondern ein kompakter Status- und Pflegeplan.
Die fruehere Migrationsphase (Konsolenlogik zu Webapp-Fluss) ist abgeschlossen.

## Aktueller Stand

- Die MyTheme-Webapp laeuft als strukturierte MVC-Variante mit klarer Trennung von Controller, Modell und View.
- PHP- und Python-Auswertung sind ueber die bestehende App-Struktur nutzbar.
- Die alten, dateibasierten Einzelstaende wurden in Legacy-Bereiche verschoben oder ersetzt.
- Die Handbuch-Dokumentation ist auf konsistente Grossschreibung bei Dateinamen im Bereich docs/handbuch umgestellt.

## Verbindliche Leitplanken fuer weitere Aenderungen

- Keine Rueckkehr zu doppelter Fachlogik in mehreren Dateien.
- Keine direkte Kopplung von UI und Fachlogik.
- Keine Weitergabe interner Fehlerdetails an Clients.
- Doku bleibt SSOT: relevante Architektur- und Ablaufaenderungen immer im Handbuch nachziehen.

## Wo stehen die aktiven Detailanleitungen

- Architektur und Erweiterung der MyTheme-MVC-Struktur: ../anleitungen/MYTHEME-MVC-ERWEITERUNG.md
- Vorgehen fuer neue Routinen: ../prozesse/NEUE-ROUTINE-ERSTELLEN.md
- Pflege und Weiterentwicklung bestehender Routinen: ../prozesse/ROUTINE-AKTUALISIEREN.md
- Redundanz- und Review-Regeln: ../prozesse/REDUNDANZ-MANAGEMENT.md und ../prozesse/REVIEW-PROZESS.md
- Qualitaets-Gates: ../prozesse/QUALITAETS-GATES-AUTOMATISIERUNG.md

## Naechste Schritte bei Bedarf

Nur wenn fachlich neue Anforderungen entstehen:

1. Fachliche Aenderung als Routine dokumentieren.
2. Anpassung in genau einer verantwortlichen Schicht umsetzen.
3. Handbuch-Referenzen pruefen und aktualisieren.
4. Qualitaets-Gates ausfuehren.

## Abschlusskriterium dieses Dokuments

Dieses Dokument bleibt absichtlich kurz und verweist auf die jeweils gueltigen Prozess- und Architekturquellen, statt veraltete Migrationsschritte zu duplizieren.
