#!/usr/bin/env python3
import json
import math
import sys


def as_float(payload, key, minimum=None):
    value = float(payload.get(key, 0))
    if minimum is not None and value < minimum:
        raise ValueError(f"Ungueltiger Wert fuer {key}")
    return value


def bmi_model(data):
    gewicht = as_float(data, "gewicht", 1)
    groesse = as_float(data, "groesse", 0.2)
    alter = int(as_float(data, "alter", 1))
    geschlecht = "w" if data.get("geschlecht") == "w" else "m"

    bmi = gewicht / (groesse * groesse)
    kategorie = "Adipositas"
    if geschlecht == "m":
        if bmi < 20:
            kategorie = "Untergewicht"
        elif bmi <= 25:
            kategorie = "Normalgewicht"
        elif bmi <= 30:
            kategorie = "Uebergewicht"
    else:
        if bmi < 19:
            kategorie = "Untergewicht"
        elif bmi <= 24:
            kategorie = "Normalgewicht"
        elif bmi <= 30:
            kategorie = "Uebergewicht"

    opt = "keine Informationen fuer Kinder vorhanden"
    if 19 <= alter <= 24:
        opt = "19-24"
    elif alter <= 34:
        opt = "20-25"
    elif alter <= 44:
        opt = "21-26"
    elif alter <= 54:
        opt = "22-27"
    elif alter <= 64:
        opt = "23-28"
    elif alter >= 65:
        opt = "24-29"

    return {
        "ok": True,
        "title": "BMI Ergebnis",
        "rows": [
            {"label": "Gewicht", "value": f"{gewicht:.1f} kg"},
            {"label": "Groesse", "value": f"{groesse:.2f} m"},
            {"label": "Alter", "value": f"{alter} Jahre"},
            {"label": "Geschlecht", "value": "Weiblich" if geschlecht == "w" else "Maennlich"},
            {"label": "Kategorie", "value": kategorie},
            {"label": "Optimaler BMI-Bereich", "value": opt},
            {"label": "BMI", "value": f"{bmi:.2f}"},
        ],
    }


def noten_model(data):
    mathe = as_float(data, "mathe", 1)
    deutsch = as_float(data, "deutsch", 1)
    englisch = as_float(data, "englisch", 1)
    bwl = as_float(data, "bwl", 1)
    avg = (mathe + deutsch + englisch + bwl) / 4
    return {
        "ok": True,
        "title": "Noten Ergebnis",
        "rows": [
            {"label": "Mathe", "value": f"{mathe:.1f}"},
            {"label": "Deutsch", "value": f"{deutsch:.1f}"},
            {"label": "Englisch", "value": f"{englisch:.1f}"},
            {"label": "BWL", "value": f"{bwl:.1f}"},
            {"label": "Durchschnitt", "value": f"{avg:.2f}"},
        ],
    }


def taschenrechner_model(data):
    zahl1 = as_float(data, "zahl1")
    zahl2 = as_float(data, "zahl2")
    op = data.get("operator", "")

    if op == "+":
        erg = zahl1 + zahl2
    elif op == "-":
        erg = zahl1 - zahl2
    elif op == "*":
        erg = zahl1 * zahl2
    elif op == "/":
        if zahl2 == 0:
            return {"ok": False, "error": "Division durch 0 ist nicht erlaubt."}
        erg = zahl1 / zahl2
    elif op == "^":
        erg = math.pow(zahl1, zahl2)
    else:
        return {"ok": False, "error": "Bitte eine gueltige Operation waehlen."}

    return {
        "ok": True,
        "title": "Taschenrechner Ergebnis",
        "rows": [
            {"label": "Zahl 1", "value": f"{zahl1:.2f}"},
            {"label": "Operator", "value": op},
            {"label": "Zahl 2", "value": f"{zahl2:.2f}"},
            {"label": "Ergebnis", "value": f"{erg:.2f}"},
        ],
    }


def rabatt_model(data):
    betrag = as_float(data, "betrag", 0)
    menge = int(as_float(data, "menge", 0))

    satz = 0
    if menge >= 150:
        satz = 12
    elif menge >= 100:
        satz = 10
    elif menge >= 50:
        satz = 8
    elif menge >= 20:
        satz = 6

    rabatt = (betrag / 100) * satz
    zahlung = betrag - rabatt

    return {
        "ok": True,
        "title": "Rabatt Ergebnis",
        "rows": [
            {"label": "Betrag", "value": f"{betrag:.2f} EUR"},
            {"label": "Menge", "value": f"{menge} Stueck"},
            {"label": "Rabattsatz", "value": f"{satz} %"},
            {"label": "Rabattbetrag", "value": f"{rabatt:.2f} EUR"},
            {"label": "Zahlungsbetrag", "value": f"{zahlung:.2f} EUR"},
        ],
    }


def milchautomat_model(data):
    menge = int(as_float(data, "menge", 1))
    milchtyp = data.get("milchtyp", "Vollmilch")
    flaschengroesse = as_float(data, "flaschengroesse", 0.1)

    preise = {
        "Vollmilch": 1.30,
        "Laktosefreie Milch": 1.45,
        "Fettarme Milch": 1.10,
        "Sojamilch": 1.50,
    }

    preis_liter = preise.get(milchtyp, 0.0)
    flaschenpreis = preis_liter * flaschengroesse
    zahlung = flaschenpreis * menge

    return {
        "ok": True,
        "title": "Milchautomat Ergebnis",
        "rows": [
            {"label": "Milchtyp", "value": milchtyp},
            {"label": "Menge", "value": f"{menge} Stueck"},
            {"label": "Flaschengroesse", "value": f"{flaschengroesse:.1f} L"},
            {"label": "Preis pro Liter", "value": f"{preis_liter:.2f} EUR"},
            {"label": "Flaschenpreis", "value": f"{flaschenpreis:.2f} EUR"},
            {"label": "Zahlungsbetrag", "value": f"{zahlung:.2f} EUR"},
        ],
    }


def getraenkeautomat_model(data):
    getraenk = data.get("getraenk", "Wasser")
    groesse = as_float(data, "groesse", 0.1)
    menge = int(as_float(data, "menge", 1))

    preise_liter = {
        "Wasser": 1.20,
        "Saft": 2.40,
        "Cola": 2.00,
    }

    if getraenk not in preise_liter:
        return {"ok": False, "error": "Unbekanntes Getraenk."}

    preis_liter = preise_liter[getraenk]
    flaschenpreis = preis_liter * groesse
    gesamt = flaschenpreis * menge
    rabatt_satz = 5 if menge >= 10 else 0
    rabatt = (gesamt / 100) * rabatt_satz
    zahlung = gesamt - rabatt

    return {
        "ok": True,
        "title": "Getraenkeautomat Ergebnis",
        "rows": [
            {"label": "Getraenk", "value": getraenk},
            {"label": "Flaschengroesse", "value": f"{groesse:.2f} L"},
            {"label": "Menge", "value": f"{menge} Stueck"},
            {"label": "Preis pro Liter", "value": f"{preis_liter:.2f} EUR"},
            {"label": "Preis pro Flasche", "value": f"{flaschenpreis:.2f} EUR"},
            {"label": "Gesamtpreis", "value": f"{gesamt:.2f} EUR"},
            {"label": "Rabatt", "value": f"{rabatt_satz} %"},
            {"label": "Zahlungsbetrag", "value": f"{zahlung:.2f} EUR"},
        ],
    }


def urlaub_model(data):
    alter = int(as_float(data, "alter", 0))
    behinderung = "Ja" if data.get("behinderung") == "Ja" else "Nein"

    if alter <= 18:
        urlaub = 35
    elif alter < 55:
        urlaub = 30
    else:
        urlaub = 32

    if behinderung == "Ja":
        urlaub += 5

    return {
        "ok": True,
        "title": "Urlaubstage Ergebnis",
        "rows": [
            {"label": "Alter", "value": f"{alter} Jahre"},
            {"label": "Behinderung > 50%", "value": behinderung},
            {"label": "Urlaubstage", "value": str(urlaub)},
        ],
    }


def umsatz_model(data):
    filialnummer = int(as_float(data, "filialnummer", 1))
    filialname = str(data.get("filialname", "")).strip()
    if filialname == "":
        raise ValueError("Filialname darf nicht leer sein")

    operation = data.get("operation", "minimum")
    umsaetze = [1000, 1500, 1100, 1200, 1150, 950, 500, 8800, 16000, 433, 8000, 5000]

    if operation == "durchschnitt":
        ergebnis = sum(umsaetze) / len(umsaetze)
        op_name = "Durchschnitt"
    elif operation == "maximum":
        ergebnis = max(umsaetze)
        op_name = "Maximum"
    else:
        ergebnis = min(umsaetze)
        op_name = "Minimum"

    return {
        "ok": True,
        "title": "Umsatz Ergebnis",
        "rows": [
            {"label": "Filialnummer", "value": str(filialnummer)},
            {"label": "Filialname", "value": filialname},
            {"label": "Operation", "value": op_name},
            {"label": "Ergebnis", "value": f"{ergebnis:.2f}"},
        ],
    }


def _select_liste(key, spieler, ersatz, kader):
    if key == "Spielerliste":
        return list(spieler)
    if key == "Ersatzspieler":
        return list(ersatz)
    return list(kader)


def _bubble_sort(values):
    arr = list(values)
    n = len(arr)
    for i in range(1, n):
        for j in range(0, n - i):
            if arr[j] > arr[j + 1]:
                arr[j], arr[j + 1] = arr[j + 1], arr[j]
    return arr


def _selection_sort(values):
    arr = list(values)
    n = len(arr)
    for i in range(n):
        min_index = i
        for j in range(i + 1, n):
            if arr[j] < arr[min_index]:
                min_index = j
        if min_index != i:
            arr[i], arr[min_index] = arr[min_index], arr[i]
    return arr


def volleyball_model(data):
    spieler = ["Armin", "Batu", "Kai", "Sven", "Paul", "Milan"]
    ersatz = ["Chris", "Dennis", "Emin", "Goran", "Luca", "Nico"]
    kader = spieler + ersatz

    aktion = data.get("aktion", "anzeigen_start")
    liste = _select_liste(data.get("liste", "Kaderliste"), spieler, ersatz, kader)

    def rows(title, values):
        return {
            "ok": True,
            "title": title,
            "rows": [{"label": f"Pos {i}", "value": str(name)} for i, name in enumerate(values)],
        }

    if aktion == "anzeigen_start":
        return rows("Startaufstellung", spieler)
    if aktion == "anzeigen_ersatz":
        return rows("Ersatzspieler", ersatz)
    if aktion == "anzeigen_kader":
        return rows("Kader", kader)
    if aktion == "tauschen":
        von = int(as_float(data, "von", 1))
        nach = int(as_float(data, "nach", 1))
        if von < 1 or nach < 1 or von > len(spieler) or nach > len(spieler):
            return {"ok": False, "error": "Tauschpositionen muessen zwischen 1 und 6 liegen."}
        spieler[von - 1], spieler[nach - 1] = spieler[nach - 1], spieler[von - 1]
        return rows("Neue Startaufstellung", spieler)
    if aktion == "einfuegen":
        name = str(data.get("spielername", "")).strip()
        if not name:
            return {"ok": False, "error": "Spielername darf nicht leer sein."}
        pos = int(as_float(data, "position_insert", 0))
        pos = max(0, min(pos, len(liste)))
        liste.insert(pos, name)
        return rows("Aktualisierte Liste nach Einfuegen", liste)
    if aktion == "entfernen":
        pos = int(as_float(data, "position_delete", 0))
        if pos < 0 or pos >= len(liste):
            return {"ok": False, "error": "Position fuer Entfernen ist ungueltig."}
        liste.pop(pos)
        return rows("Aktualisierte Liste nach Entfernen", liste)
    if aktion == "sortieren":
        sortierart = data.get("sortierart", "BubbleSort")
        sorted_values = _selection_sort(liste) if sortierart == "SelectionSort" else _bubble_sort(liste)
        return rows(f"Sortierte Liste ({sortierart})", sorted_values)
    if aktion == "suchen":
        name = str(data.get("spielername", "")).strip()
        if not name:
            return {"ok": False, "error": "Bitte einen Namen fuer die Suche eingeben."}
        suchart = data.get("suchart", "LineareSuche")
        if suchart == "BinaereSuche":
            sorted_values = _selection_sort(liste)
            left, right = 0, len(sorted_values) - 1
            found, pos = False, -1
            while left <= right:
                mid = (left + right) // 2
                if sorted_values[mid] == name:
                    found, pos = True, mid
                    break
                if sorted_values[mid] > name:
                    right = mid - 1
                else:
                    left = mid + 1
            rows_data = [
                {"label": "Sortierte Liste", "value": ", ".join(sorted_values)},
                {"label": "Suchalgorithmus", "value": suchart},
                {"label": "Gesuchter Spieler", "value": name},
                {"label": "Ergebnis", "value": f"Gefunden an Position {pos}" if found else "Nicht gefunden"},
            ]
        else:
            found, pos = False, -1
            for i, value in enumerate(liste):
                if value == name:
                    found, pos = True, i
                    break
            rows_data = [
                {"label": "Liste", "value": ", ".join(liste)},
                {"label": "Suchalgorithmus", "value": suchart},
                {"label": "Gesuchter Spieler", "value": name},
                {"label": "Ergebnis", "value": f"Gefunden an Position {pos}" if found else "Nicht gefunden"},
            ]

        return {"ok": True, "title": "Suche im Kader", "rows": rows_data}

    return {"ok": False, "error": "Unbekannte Aktion fuer Volleyball."}


def evaluate(tool, data):
    mapping = {
        "bmi": bmi_model,
        "noten": noten_model,
        "taschenrechner": taschenrechner_model,
        "rabatt": rabatt_model,
        "milchautomat": milchautomat_model,
        "getraenkeautomat": getraenkeautomat_model,
        "urlaub": urlaub_model,
        "umsatz": umsatz_model,
        "volleyball": volleyball_model,
    }
    fn = mapping.get(tool)
    if fn is None:
        return {"ok": False, "error": "Unbekanntes Tool."}
    return fn(data)


def main():
    raw = sys.stdin.read()
    if not raw:
        print(json.dumps({"ok": False, "error": "Leerer Request"}))
        return

    payload = json.loads(raw)
    tool = str(payload.get("tool", ""))
    data = payload.get("input", {})
    if not isinstance(data, dict):
        data = {}

    try:
        result = evaluate(tool, data)
    except Exception:
        result = {"ok": False, "error": "Ungueltige Eingaben."}

    print(json.dumps(result, ensure_ascii=False))


if __name__ == "__main__":
    main()
