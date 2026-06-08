<?php

declare(strict_types=1);

function evaluate_with_php_modell(string $tool, array $input): array
{
    switch ($tool) {
        case 'bmi':
            return bmi_modell($input);
        case 'noten':
            return noten_modell($input);
        case 'taschenrechner':
            return taschenrechner_modell($input);
        case 'rabatt':
            return rabatt_modell($input);
        case 'milchautomat':
            return milchautomat_modell($input);
        case 'getraenkeautomat':
            return getraenkeautomat_modell($input);
        case 'urlaub':
            return urlaub_modell($input);
        case 'umsatz':
            return umsatz_modell($input);
        case 'volleyball':
            return volleyball_modell($input);
        default:
            return ['ok' => false, 'error' => 'Unbekanntes Tool.'];
    }
}

function safe_number_modell(array $input, string $key, ?float $min = null): float
{
    $value = isset($input[$key]) ? (float) $input[$key] : 0.0;
    if ($min !== null && $value < $min) {
        throw new InvalidArgumentException('Ungueltiger Wert fuer ' . $key . '.');
    }
    return $value;
}

function bmi_modell(array $input): array
{
    $gewicht = safe_number_modell($input, 'gewicht', 1);
    $groesse = safe_number_modell($input, 'groesse', 0.2);
    $alter = (int) safe_number_modell($input, 'alter', 1);
    $geschlecht = ($input['geschlecht'] ?? 'm') === 'w' ? 'w' : 'm';

    $bmi = $gewicht / ($groesse * $groesse);
    $kategorie = 'Adipositas';

    if ($geschlecht === 'm') {
        if ($bmi < 20) {
            $kategorie = 'Untergewicht';
        } elseif ($bmi <= 25) {
            $kategorie = 'Normalgewicht';
        } elseif ($bmi <= 30) {
            $kategorie = 'Uebergewicht';
        }
    } else {
        if ($bmi < 19) {
            $kategorie = 'Untergewicht';
        } elseif ($bmi <= 24) {
            $kategorie = 'Normalgewicht';
        } elseif ($bmi <= 30) {
            $kategorie = 'Uebergewicht';
        }
    }

    $opt = 'keine Informationen fuer Kinder vorhanden';
    if ($alter >= 19 && $alter <= 24) {
        $opt = '19-24';
    } elseif ($alter <= 34) {
        $opt = '20-25';
    } elseif ($alter <= 44) {
        $opt = '21-26';
    } elseif ($alter <= 54) {
        $opt = '22-27';
    } elseif ($alter <= 64) {
        $opt = '23-28';
    } elseif ($alter >= 65) {
        $opt = '24-29';
    }

    return [
        'ok' => true,
        'title' => 'BMI Ergebnis',
        'rows' => [
            ['label' => 'Gewicht', 'value' => number_format($gewicht, 1, ',', '.') . ' kg'],
            ['label' => 'Groesse', 'value' => number_format($groesse, 2, ',', '.') . ' m'],
            ['label' => 'Alter', 'value' => $alter . ' Jahre'],
            ['label' => 'Geschlecht', 'value' => $geschlecht === 'm' ? 'Maennlich' : 'Weiblich'],
            ['label' => 'Kategorie', 'value' => $kategorie],
            ['label' => 'Optimaler BMI-Bereich', 'value' => $opt],
            ['label' => 'BMI', 'value' => number_format($bmi, 2, ',', '.')],
        ],
    ];
}

function noten_modell(array $input): array
{
    $mathe = safe_number_modell($input, 'mathe', 1);
    $deutsch = safe_number_modell($input, 'deutsch', 1);
    $englisch = safe_number_modell($input, 'englisch', 1);
    $bwl = safe_number_modell($input, 'bwl', 1);

    $durchschnitt = ($mathe + $deutsch + $englisch + $bwl) / 4;

    return [
        'ok' => true,
        'title' => 'Noten Ergebnis',
        'rows' => [
            ['label' => 'Mathe', 'value' => number_format($mathe, 1, ',', '.')],
            ['label' => 'Deutsch', 'value' => number_format($deutsch, 1, ',', '.')],
            ['label' => 'Englisch', 'value' => number_format($englisch, 1, ',', '.')],
            ['label' => 'BWL', 'value' => number_format($bwl, 1, ',', '.')],
            ['label' => 'Durchschnitt', 'value' => number_format($durchschnitt, 2, ',', '.')],
        ],
    ];
}

function taschenrechner_modell(array $input): array
{
    $zahl1 = safe_number_modell($input, 'zahl1');
    $zahl2 = safe_number_modell($input, 'zahl2');
    $op = (string) ($input['operator'] ?? '');

    switch ($op) {
        case '+':
            $erg = $zahl1 + $zahl2;
            break;
        case '-':
            $erg = $zahl1 - $zahl2;
            break;
        case '*':
            $erg = $zahl1 * $zahl2;
            break;
        case '/':
            if ($zahl2 == 0.0) {
                return ['ok' => false, 'error' => 'Division durch 0 ist nicht erlaubt.'];
            }
            $erg = $zahl1 / $zahl2;
            break;
        case '^':
            $erg = pow($zahl1, $zahl2);
            break;
        default:
            return ['ok' => false, 'error' => 'Bitte eine gueltige Operation waehlen.'];
    }

    return [
        'ok' => true,
        'title' => 'Taschenrechner Ergebnis',
        'rows' => [
            ['label' => 'Zahl 1', 'value' => number_format($zahl1, 2, ',', '.')],
            ['label' => 'Operator', 'value' => $op],
            ['label' => 'Zahl 2', 'value' => number_format($zahl2, 2, ',', '.')],
            ['label' => 'Ergebnis', 'value' => number_format((float) $erg, 2, ',', '.')],
        ],
    ];
}

function rabatt_modell(array $input): array
{
    $betrag = safe_number_modell($input, 'betrag', 0);
    $menge = (int) safe_number_modell($input, 'menge', 0);

    $satz = 0;
    if ($menge >= 150) {
        $satz = 12;
    } elseif ($menge >= 100) {
        $satz = 10;
    } elseif ($menge >= 50) {
        $satz = 8;
    } elseif ($menge >= 20) {
        $satz = 6;
    }

    $rabatt = ($betrag / 100) * $satz;
    $zahlung = $betrag - $rabatt;

    return [
        'ok' => true,
        'title' => 'Rabatt Ergebnis',
        'rows' => [
            ['label' => 'Betrag', 'value' => number_format($betrag, 2, ',', '.') . ' EUR'],
            ['label' => 'Menge', 'value' => $menge . ' Stueck'],
            ['label' => 'Rabattsatz', 'value' => $satz . ' %'],
            ['label' => 'Rabattbetrag', 'value' => number_format($rabatt, 2, ',', '.') . ' EUR'],
            ['label' => 'Zahlungsbetrag', 'value' => number_format($zahlung, 2, ',', '.') . ' EUR'],
        ],
    ];
}

function milchautomat_modell(array $input): array
{
    $menge = (int) safe_number_modell($input, 'menge', 1);
    $milchtyp = (string) ($input['milchtyp'] ?? 'Vollmilch');
    $flaschengroesse = safe_number_modell($input, 'flaschengroesse', 0.1);

    $preise = [
        'Vollmilch' => 1.30,
        'Laktosefreie Milch' => 1.45,
        'Fettarme Milch' => 1.10,
        'Sojamilch' => 1.50,
    ];

    $preisLiter = $preise[$milchtyp] ?? 0.0;
    $flaschenpreis = $preisLiter * $flaschengroesse;
    $zahlung = $flaschenpreis * $menge;

    return [
        'ok' => true,
        'title' => 'Milchautomat Ergebnis',
        'rows' => [
            ['label' => 'Milchtyp', 'value' => $milchtyp],
            ['label' => 'Menge', 'value' => $menge . ' Stueck'],
            ['label' => 'Flaschengroesse', 'value' => number_format($flaschengroesse, 1, ',', '.') . ' L'],
            ['label' => 'Preis pro Liter', 'value' => number_format($preisLiter, 2, ',', '.') . ' EUR'],
            ['label' => 'Flaschenpreis', 'value' => number_format($flaschenpreis, 2, ',', '.') . ' EUR'],
            ['label' => 'Zahlungsbetrag', 'value' => number_format($zahlung, 2, ',', '.') . ' EUR'],
        ],
    ];
}

function getraenkeautomat_modell(array $input): array
{
    $getraenk = (string) ($input['getraenk'] ?? 'Wasser');
    $groesse = safe_number_modell($input, 'groesse', 0.1);
    $menge = (int) safe_number_modell($input, 'menge', 1);

    $preiseLiter = [
        'Wasser' => 1.20,
        'Saft' => 2.40,
        'Cola' => 2.00,
    ];

    if (!isset($preiseLiter[$getraenk])) {
        return ['ok' => false, 'error' => 'Unbekanntes Getraenk.'];
    }

    $preisLiter = $preiseLiter[$getraenk];
    $flaschenpreis = $preisLiter * $groesse;
    $gesamt = $flaschenpreis * $menge;
    $rabattSatz = $menge >= 10 ? 5 : 0;
    $rabatt = ($gesamt / 100) * $rabattSatz;
    $zahlung = $gesamt - $rabatt;

    return [
        'ok' => true,
        'title' => 'Getraenkeautomat Ergebnis',
        'rows' => [
            ['label' => 'Getraenk', 'value' => $getraenk],
            ['label' => 'Flaschengroesse', 'value' => number_format($groesse, 2, ',', '.') . ' L'],
            ['label' => 'Menge', 'value' => $menge . ' Stueck'],
            ['label' => 'Preis pro Liter', 'value' => number_format($preisLiter, 2, ',', '.') . ' EUR'],
            ['label' => 'Preis pro Flasche', 'value' => number_format($flaschenpreis, 2, ',', '.') . ' EUR'],
            ['label' => 'Gesamtpreis', 'value' => number_format($gesamt, 2, ',', '.') . ' EUR'],
            ['label' => 'Rabatt', 'value' => $rabattSatz . ' %'],
            ['label' => 'Zahlungsbetrag', 'value' => number_format($zahlung, 2, ',', '.') . ' EUR'],
        ],
    ];
}

function urlaub_modell(array $input): array
{
    $alter = (int) safe_number_modell($input, 'alter', 0);
    $behinderung = ((string) ($input['behinderung'] ?? 'Nein')) === 'Ja' ? 'Ja' : 'Nein';

    if ($alter <= 18) {
        $urlaub = 35;
    } elseif ($alter < 55) {
        $urlaub = 30;
    } else {
        $urlaub = 32;
    }

    if ($behinderung === 'Ja') {
        $urlaub += 5;
    }

    return [
        'ok' => true,
        'title' => 'Urlaubstage Ergebnis',
        'rows' => [
            ['label' => 'Alter', 'value' => $alter . ' Jahre'],
            ['label' => 'Behinderung > 50%', 'value' => $behinderung],
            ['label' => 'Urlaubstage', 'value' => (string) $urlaub],
        ],
    ];
}

function umsatz_modell(array $input): array
{
    $filialnummer = (int) safe_number_modell($input, 'filialnummer', 1);
    $filialname = trim((string) ($input['filialname'] ?? ''));
    if ($filialname === '') {
        throw new InvalidArgumentException('Filialname darf nicht leer sein.');
    }

    $operation = (string) ($input['operation'] ?? 'minimum');
    $umsaetze = [1000, 1500, 1100, 1200, 1150, 950, 500, 8800, 16000, 433, 8000, 5000];

    if ($operation === 'durchschnitt') {
        $ergebnis = array_sum($umsaetze) / count($umsaetze);
        $opName = 'Durchschnitt';
    } elseif ($operation === 'maximum') {
        $ergebnis = max($umsaetze);
        $opName = 'Maximum';
    } else {
        $ergebnis = min($umsaetze);
        $opName = 'Minimum';
    }

    return [
        'ok' => true,
        'title' => 'Umsatz Ergebnis',
        'rows' => [
            ['label' => 'Filialnummer', 'value' => (string) $filialnummer],
            ['label' => 'Filialname', 'value' => $filialname],
            ['label' => 'Operation', 'value' => $opName],
            ['label' => 'Ergebnis', 'value' => number_format((float) $ergebnis, 2, ',', '.')],
        ],
    ];
}

function volleyball_modell(array $input): array
{
    $spieler = ['Armin', 'Batu', 'Kai', 'Sven', 'Paul', 'Milan'];
    $ersatz = ['Chris', 'Dennis', 'Emin', 'Goran', 'Luca', 'Nico'];
    $kader = array_merge($spieler, $ersatz);

    $aktion = (string) ($input['aktion'] ?? 'anzeigen_start');
    $listeKey = (string) ($input['liste'] ?? 'Kaderliste');
    $liste = volleyball_select_list_modell($listeKey, $spieler, $ersatz, $kader);

    if ($aktion === 'anzeigen_start') {
        return volleyball_rows_modell('Startaufstellung', $spieler);
    }
    if ($aktion === 'anzeigen_ersatz') {
        return volleyball_rows_modell('Ersatzspieler', $ersatz);
    }
    if ($aktion === 'anzeigen_kader') {
        return volleyball_rows_modell('Kader', $kader);
    }

    if ($aktion === 'tauschen') {
        $von = (int) safe_number_modell($input, 'von', 1);
        $nach = (int) safe_number_modell($input, 'nach', 1);
        if ($von < 1 || $nach < 1 || $von > count($spieler) || $nach > count($spieler)) {
            return ['ok' => false, 'error' => 'Tauschpositionen muessen zwischen 1 und 6 liegen.'];
        }
        $temp = $spieler[$von - 1];
        $spieler[$von - 1] = $spieler[$nach - 1];
        $spieler[$nach - 1] = $temp;
        return volleyball_rows_modell('Neue Startaufstellung', $spieler);
    }

    if ($aktion === 'einfuegen') {
        $name = trim((string) ($input['spielername'] ?? ''));
        $pos = (int) safe_number_modell($input, 'position_insert', 0);
        if ($name === '') {
            return ['ok' => false, 'error' => 'Spielername darf nicht leer sein.'];
        }
        if ($pos < 0) {
            return ['ok' => false, 'error' => 'Position fuer Einfuegen ist ungueltig.'];
        }
        $pos = min($pos, count($liste));
        array_splice($liste, $pos, 0, [$name]);
        return volleyball_rows_modell('Aktualisierte Liste nach Einfuegen', $liste);
    }

    if ($aktion === 'entfernen') {
        $pos = (int) safe_number_modell($input, 'position_delete', 0);
        if ($pos < 0 || $pos >= count($liste)) {
            return ['ok' => false, 'error' => 'Position fuer Entfernen ist ungueltig.'];
        }
        array_splice($liste, $pos, 1);
        return volleyball_rows_modell('Aktualisierte Liste nach Entfernen', $liste);
    }

    if ($aktion === 'sortieren') {
        $sortierart = (string) ($input['sortierart'] ?? 'BubbleSort');
        $sorted = $liste;
        if ($sortierart === 'SelectionSort') {
            $sorted = volleyball_selection_sort_modell($sorted);
        } else {
            $sorted = volleyball_bubble_sort_modell($sorted);
        }
        return volleyball_rows_modell('Sortierte Liste (' . $sortierart . ')', $sorted);
    }

    if ($aktion === 'suchen') {
        $name = trim((string) ($input['spielername'] ?? ''));
        if ($name === '') {
            return ['ok' => false, 'error' => 'Bitte einen Namen fuer die Suche eingeben.'];
        }
        $suchart = (string) ($input['suchart'] ?? 'LineareSuche');
        $gefunden = false;
        $position = -1;

        if ($suchart === 'BinaereSuche') {
            $sorted = volleyball_selection_sort_modell($liste);
            [$gefunden, $position] = volleyball_binary_search_modell($sorted, $name);
            $rows = [['label' => 'Sortierte Liste', 'value' => implode(', ', $sorted)]];
        } else {
            [$gefunden, $position] = volleyball_linear_search_modell($liste, $name);
            $rows = [['label' => 'Liste', 'value' => implode(', ', $liste)]];
        }

        $rows[] = ['label' => 'Suchalgorithmus', 'value' => $suchart];
        $rows[] = ['label' => 'Gesuchter Spieler', 'value' => $name];
        $rows[] = ['label' => 'Ergebnis', 'value' => $gefunden ? 'Gefunden an Position ' . $position : 'Nicht gefunden'];

        return ['ok' => true, 'title' => 'Suche im Kader', 'rows' => $rows];
    }

    return ['ok' => false, 'error' => 'Unbekannte Aktion fuer Volleyball.'];
}

function volleyball_select_list_modell(string $listKey, array $spieler, array $ersatz, array $kader): array
{
    if ($listKey === 'Spielerliste') {
        return $spieler;
    }
    if ($listKey === 'Ersatzspieler') {
        return $ersatz;
    }
    return $kader;
}

function volleyball_rows_modell(string $title, array $liste): array
{
    $rows = [];
    foreach ($liste as $index => $name) {
        $rows[] = ['label' => 'Pos ' . $index, 'value' => (string) $name];
    }
    return ['ok' => true, 'title' => $title, 'rows' => $rows];
}

function volleyball_bubble_sort_modell(array $liste): array
{
    $n = count($liste);
    for ($i = 1; $i < $n; $i++) {
        for ($j = 0; $j < $n - $i; $j++) {
            if (strcmp((string) $liste[$j], (string) $liste[$j + 1]) > 0) {
                $tmp = $liste[$j];
                $liste[$j] = $liste[$j + 1];
                $liste[$j + 1] = $tmp;
            }
        }
    }
    return $liste;
}

function volleyball_selection_sort_modell(array $liste): array
{
    $n = count($liste);
    for ($i = 0; $i < $n; $i++) {
        $min = $i;
        for ($j = $i + 1; $j < $n; $j++) {
            if (strcmp((string) $liste[$j], (string) $liste[$min]) < 0) {
                $min = $j;
            }
        }
        if ($min !== $i) {
            $tmp = $liste[$i];
            $liste[$i] = $liste[$min];
            $liste[$min] = $tmp;
        }
    }
    return $liste;
}

function volleyball_linear_search_modell(array $liste, string $name): array
{
    foreach ($liste as $index => $value) {
        if ((string) $value === $name) {
            return [true, $index];
        }
    }
    return [false, -1];
}

function volleyball_binary_search_modell(array $liste, string $name): array
{
    $left = 0;
    $right = count($liste) - 1;

    while ($left <= $right) {
        $mid = (int) floor(($left + $right) / 2);
        if ((string) $liste[$mid] === $name) {
            return [true, $mid];
        }
        if (strcmp((string) $liste[$mid], $name) > 0) {
            $right = $mid - 1;
        } else {
            $left = $mid + 1;
        }
    }

    return [false, -1];
}
