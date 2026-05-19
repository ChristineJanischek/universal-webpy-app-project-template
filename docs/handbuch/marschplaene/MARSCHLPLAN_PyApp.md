# Marschplan: Webapp des VolleyballspielerManagers

## Ziel

Dieses Dokument beschreibt, wie du die vorhandenen Dateien in der Webapp zusammenfuehrst, damit

- Header und Navigation aus MyTheme in der Webapp verwendet werden,
- das Menue des VolleyballspielerManagers in die Navigation uebernommen wird,
- der bisherige Python-Konsolenablauf als Webinterface mit Formularen nutzbar wird.

## Ausgangsanalyse

### Aktuelle Webapp

- Die aktuelle PHP-Seite in `webapp/public/index.php` ist ein kleines Dashboard mit zwei Karten fuer MySQL- und API-Tests.
- Das Styling in `webapp/public/style.css` ist eigenstaendig und verwendet nicht die Strukturen aus MyTheme.
- Das JavaScript in `webapp/public/app.js` ruft nur die Endpunkte `/health` und `/json-items` der Python-API ab.

### Vorhandenes Theme MyTheme

- `webapp/public/MyTheme/nav.css` bringt ein komplettes Layout fuer Header, Content-Bereich und Navigation mit.
- `webapp/public/MyTheme/content.css` definiert Farben, Typografie, Kopfbereich und allgemeine Inhaltsstile.
- `webapp/public/MyTheme/my_js.js` steuert ein responsives Menue, setzt aber auf jQuery sowie auf eXeLearning-spezifische globale Objekte wie `$exe` und `$exe_i18n`.

### Aktueller VolleyballspielerManager

- `webapp/public/pyApp/VolleyballspielerManager.py` ist ein interaktives Konsolenprogramm mit `input()` und `print()`.
- Die Fachlogik und die Benutzerschnittstelle sind dort direkt vermischt.
- Die Daten liegen aktuell in globalen Listen wie `spieler`, `ersatz` und `kader`.
- Fuer eine Webapp ist das in der aktuellen Form nicht direkt nutzbar, weil Browser kein Python-Skript mit `input()` ausfuehren koennen.

### Bereits vorhandene API-Schicht

- `services/python-api/app.py` stellt schon eine Flask-API bereit.
- Diese API ist der richtige Ort, um den VolleyballspielerManager fuer die Webapp bereitzustellen.
- Die Webapp sollte also nicht direkt `VolleyballspielerManager.py` ansprechen, sondern neue API-Endpunkte nutzen.

## Zielbild

Die saubere Zielarchitektur ist:

1. Das Theme liefert Header, Navigation und Grundlayout.
2. Die PHP-Seite liefert nur die HTML-Struktur und bindet CSS sowie JavaScript ein.
3. Die Fachlogik des VolleyballspielerManagers wird in Python von der Konsolen-Ein- und Ausgabe getrennt.
4. Die Flask-API kapselt diese Fachlogik ueber wohldefinierte Endpunkte.
5. Das Frontend baut Formulare und Aktionsflaechen und ruft die API per Fetch auf.

## Empfohlene Umsetzungsreihenfolge

### Schritt 1: Fachlogik aus dem Konsolenskript herausloesen

Ziel: Der VolleyballspielerManager darf nicht mehr von `input()` und `print()` abhaengen.

Vorgehen:

1. Erstelle in `services/python-api/` ein neues Modul fuer die Fachlogik, zum Beispiel `volleyball_manager.py`.
2. Kapsle die Daten in einer Klasse, zum Beispiel `VolleyballManager`.
3. Ueberfuehre die globalen Listen `spieler`, `ersatz` und `kader` in internen Objektzustand.
4. Ersetze die Konsolenfunktionen durch Methoden mit klaren Rueckgabewerten.

Empfohlene Methoden:

- `get_startaufstellung()`
- `get_ersatzspieler()`
- `get_kader()`
- `tausche_position(position_von, position_nach)`
- `spieler_einfuegen(name, position)`
- `spieler_entfernen(position)`
- `bubble_sort_kader()`
- `selection_sort_kader()`
- `suche_linear(name)`
- `suche_binaer(name)`

Wichtig:

- Rueckgaben sollten strukturierte Daten sein, also Listen oder Dictionaries.
- Fehlerfaelle wie ungueltige Positionen muessen kontrolliert behandelt werden.
- Interne Listen sollten nicht ungeschuetzt nach aussen gegeben werden. Nutze Kopien oder klar definierte DTO-aehnliche Antworten.

### Schritt 2: Die Konsolenanwendung optional erhalten

Ziel: Die bisherige Python-Datei kann fuer den Unterricht oder lokale Tests weiter existieren, greift aber nur noch auf die neue Fachlogik zu.

Vorgehen:

1. Lass `webapp/public/pyApp/VolleyballspielerManager.py` nicht mehr die eigentliche Logik enthalten.
2. Verwende sie stattdessen nur noch als kleine CLI-Huelle.
3. Die Datei liest Benutzereingaben ein und ruft dann die Methoden der neuen Klasse auf.

Nutzen:

- Keine doppelte Logik.
- Webapp und CLI verwenden dieselbe Fachlogik.
- Aenderungen am Verhalten muessen nur an einer Stelle gemacht werden.

### Schritt 3: API-Endpunkte fuer alle Menueaktionen anlegen

Ziel: Jede Menuefunktion wird ueber einen klaren REST-Endpunkt oder eine saubere Aktionsroute nutzbar.

Vorgehen in `services/python-api/app.py`:

1. Instanziiere den `VolleyballManager` an einer zentralen Stelle.
2. Ergaenze Endpunkte fuer das Lesen des Zustands.
3. Ergaenze Endpunkte fuer Aenderungen am Kader.
4. Gib nur sichere und strukturierte JSON-Antworten zurueck.

Moegliche Endpunkte:

- `GET /volleyball/status`
- `GET /volleyball/startaufstellung`
- `GET /volleyball/ersatzspieler`
- `GET /volleyball/kader`
- `POST /volleyball/tauschen`
- `POST /volleyball/einfuegen`
- `POST /volleyball/entfernen`
- `POST /volleyball/sortieren/bubble`
- `POST /volleyball/sortieren/selection`
- `GET /volleyball/suche/linear?name=...`
- `GET /volleyball/suche/binaer?name=...`

Wichtig:

- Validierung fuer Namen, Zahlenbereiche und leere Eingaben einbauen.
- Keine internen Python-Fehler direkt an den Browser durchreichen.
- Ein einheitliches JSON-Schema fuer Erfolg und Fehler verwenden.

### Schritt 4: Das Menue fachlich in Navigationspunkte uebersetzen

Ziel: Das bisherige Python-Menue wird zu einer Navigationsstruktur in der Webapp.

Das bestehende Menue enthaelt fachlich diese Punkte:

1. Startaufstellung anzeigen
2. Ersatzspieler anzeigen
3. Kader anzeigen
4. Position tauschen
5. Spieler einfuegen
6. Spieler entfernen
7. Kader per BubbleSort sortieren
8. Kader per SelectionSort sortieren
9. Spieler per linearer Suche suchen
10. Spieler per binaerer Suche suchen

Hinweis:

- Im Python-Skript ist der Text fuer Punkt 6 aktuell doppelt als "Spieler einfuegen" hinterlegt. Fachlich ist damit aber `entfernen_spieler()` gemeint. Diesen Fehler solltest du bei der Uebernahme zuerst korrigieren.

Empfohlene Gliederung fuer die Navigation:

- Uebersicht
- Anzeigen
- Aendern
- Sortieren
- Suchen

Darunter koennen die einzelnen Menuepunkte als Links oder Aktionsschaltflaechen erscheinen.

### Schritt 5: HTML-Struktur der Webapp auf das Theme ausrichten

Ziel: Die Webapp muss die Layout-Hooks liefern, die MyTheme erwartet.

In `webapp/public/index.php` solltest du die bisherige Minimalstruktur in eine Layout-Struktur ueberfuehren, die zu `nav.css` und `content.css` passt.

Empfohlene Struktur:

1. Ein aeusserer Bereich mit `#content`
2. Ein Header mit `#header`
3. Eine Navigation mit `#siteNav`
4. Ein Inhaltsbereich mit `#main-wrapper` und `#main`
5. Ein Bereich fuer Statusmeldungen und API-Fehler

Wichtig:

- Die bestehenden Theme-CSS-Dateien erwarten IDs wie `#header`, `#siteNav`, `#content`, `#main-wrapper` und `#main`.
- Wenn du andere HTML-Namen verwendest, greifen die Theme-Regeln nicht sauber.

### Schritt 6: Theme-Assets gezielt einbinden

Ziel: Header und Navigation aus MyTheme optisch uebernehmen, ohne unnötige Altlasten mitzuschleppen.

Vorgehen:

1. Binde in `index.php` zuerst `MyTheme/content.css` und `MyTheme/nav.css` ein.
2. Binde danach ein eigenes Webapp-CSS ein, zum Beispiel weiter `style.css`, aber nur fuer projektbezogene Anpassungen.
3. Pruefe die Bildpfade aus MyTheme, damit Headergrafiken und Navigationselemente korrekt geladen werden.

Empfehlung:

- Uebernimm nicht blind `my_js.js`.
- Der Grund ist die Abhaengigkeit von jQuery und eXeLearning-spezifischen Objekten.
- Wenn du das mobile Menue brauchst, baue lieber eine kleine eigene Navigation in modernem Vanilla-JavaScript nach.

### Schritt 7: Formularbereiche fuer jede Aktion aufbauen

Ziel: Jede bisherige Konsolenabfrage wird als Webformular abgebildet.

Empfohlene UI-Bloecke im Hauptbereich:

- Anzeige der Startaufstellung
- Anzeige der Ersatzspieler
- Anzeige des gesamten Kaders
- Formular fuer Positionstausch
- Formular fuer Spieler einfuegen
- Formular fuer Spieler entfernen
- Aktionen zum Sortieren
- Formular fuer lineare Suche
- Formular fuer binaere Suche

Formularbeispiele:

- Positionstausch: zwei numerische Eingabefelder und ein Button
- Spieler einfuegen: Textfeld fuer Name, Zahlenfeld fuer Position, Button
- Spieler entfernen: Zahlenfeld fuer Position, Button
- Suche: Textfeld fuer Spielername, Auswahl fuer Suchart, Button

Wichtig:

- Nutze pro Formular eindeutige IDs.
- Zeige Erfolg und Fehler in einem separaten Meldungsbereich an.
- Lade danach den aktualisierten Kader neu, damit die Oberflaeche konsistent bleibt.

### Schritt 8: Frontend-JavaScript neu auf den Volleyball-Flow ausrichten

Ziel: `webapp/public/app.js` soll nicht mehr nur Health-Checks laden, sondern die eigentliche Anwendung steuern.

Vorgehen:

1. Lege zentrale Funktionen fuer API-Requests an.
2. Lade beim Seitenstart den aktuellen Volleyball-Zustand.
3. Binde Event-Listener an Navigation und Formulare.
4. Aktualisiere nach jeder Aktion nur die benoetigten Bereiche.

Empfohlene Funktionen:

- `loadStatus()` fuer den Gesamtzustand
- `renderStartaufstellung(data)`
- `renderErsatzspieler(data)`
- `renderKader(data)`
- `submitTausch(formData)`
- `submitEinfuegen(formData)`
- `submitEntfernen(formData)`
- `submitSuche(name, suchart)`

Praxisregel:

- Trenne API-Kommunikation, DOM-Rendering und Event-Bindung klar voneinander.
- So bleibt das Frontend wartbar und spaeter leichter erweiterbar.

### Schritt 9: Navigation mit den Formularsektionen verbinden

Ziel: Das Menue in der Navigation steuert die Ansicht der Seite.

Es gibt zwei sinnvolle Varianten:

1. Einseiten-Ansatz: Die Navigation springt zu Sektionen auf derselben Seite.
2. Bereichs-Ansatz: Die Navigation blendet einzelne Panels ein und aus.

Fuer den aktuellen Projektstand ist der Einseiten-Ansatz einfacher.

Empfehlung:

- Baue im Hauptbereich logisch getrennte Sektionen mit Anker-IDs auf.
- Verlinke die Navigation direkt auf diese IDs.
- Fuer Aktionen wie Sortieren kannst du zusaetzlich Buttons im Inhaltsbereich vorsehen.

### Schritt 10: Validierung, Tests und Robustheit ergaenzen

Ziel: Die neue Weboberflaeche soll stabil und nachvollziehbar funktionieren.

Pruefpunkte:

1. API validiert alle Eingaben serverseitig.
2. Frontend validiert Eingaben zusaetzlich fuer bessere Nutzbarkeit.
3. Ungueltige Positionen fuehren zu einer kontrollierten Fehlermeldung.
4. Suchfunktionen geben eindeutig an, ob ein Spieler gefunden wurde.
5. Sortieraktionen veraendern den Zustand nachvollziehbar.

Sinnvolle Tests:

- API-Tests fuer jeden Endpunkt
- Tests fuer Grenzfaelle bei Positionen
- Test fuer Suche nach nicht vorhandenen Spielern
- Test fuer korrekte Uebernahme des Menues in die Navigation
- Responsiver Test der Navigation auf kleinen Bildschirmen

## Empfohlene Reihenfolge fuer die konkrete Umsetzung

Arbeite in dieser Reihenfolge, damit du keine UI auf instabile Logik baust:

1. Menuefehler inhaltlich bereinigen und Fachlogik modellieren.
2. Neue Python-Klasse fuer den Manager erstellen.
3. CLI-Datei auf die neue Klasse umstellen.
4. Flask-API um Volleyball-Endpunkte erweitern.
5. JSON-Antworten und Fehlermodell vereinheitlichen.
6. `index.php` auf Theme-Struktur umbauen.
7. MyTheme-CSS einbinden und eigenes CSS danach gezielt anpassen.
8. Navigationspunkte aus dem Menue ableiten.
9. Formulare und Ergebnisbereiche im HTML anlegen.
10. `app.js` auf die neuen Endpunkte und Formulare umbauen.
11. Manuell testen, dann Security-, Architektur- und Doku-Checks ausfuehren.

## Minimaler erster Meilenstein

Wenn du klein starten willst, setze zuerst nur diesen vertikalen Schnitt um:

1. Theme-Header und Theme-Navigation in `index.php` einbauen.
2. Einen API-Endpunkt `GET /volleyball/kader` erstellen.
3. Eine Websektion "Kader anzeigen" bauen.
4. Das Menue mit einem Link auf diese Sektion versehen.

Damit hast du frueh ein sichtbares Ergebnis und eine tragfaehige Struktur fuer die restlichen Funktionen.

## Technische Risiken und Hinweise

- `my_js.js` ist nicht direkt wiederverwendbar, solange jQuery und eXeLearning-Hilfsobjekte fehlen.
- Das bisherige Python-Skript arbeitet mit globalem Zustand. Fuer parallele Requests ist das spaeter relevant.
- Wenn mehrere Nutzer gleichzeitig arbeiten sollen, solltest du den Zustand mittelfristig nicht nur im Speicher halten.
- Fuer den ersten Schritt reicht aber ein einzelner In-Memory-Manager fuer die lokale Demo aus.

## Abschlusskriterien

Die Umsetzung ist fachlich auf Kurs, wenn folgende Punkte sichtbar erreicht sind:

- Header und Navigation stammen aus MyTheme.
- Das Menue des VolleyballspielerManagers ist in die Navigation uebernommen.
- Die Webapp besitzt Formulare statt Konsoleneingaben.
- Das Frontend spricht die Python-API an, nicht direkt das Python-Skript.
- Die Fachlogik ist von Darstellung und Eingabe getrennt.
