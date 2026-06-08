<?php

declare(strict_types=1);

function get_tool_schema_modell(): array
{
    return [
        'bmi' => [
            'title' => 'BMI-Rechner',
            'type' => 'rechner',
            'description' => 'Trage Gewicht und Groesse ein. Die App berechnet den BMI und zeigt eine Kategorie.',
            'fields' => [
                ['name' => 'gewicht', 'label' => 'Gewicht (kg)', 'type' => 'number', 'step' => '0.1', 'min' => '1', 'max' => '500', 'placeholder' => 'z. B. 72.5', 'help' => 'Kommazahl erlaubt, z. B. 72.5', 'required' => true],
                ['name' => 'groesse', 'label' => 'Groesse (m)', 'type' => 'number', 'step' => '0.01', 'min' => '0.50', 'max' => '2.50', 'placeholder' => 'z. B. 1.75', 'required' => true],
                ['name' => 'alter', 'label' => 'Alter (Jahre)', 'type' => 'number', 'step' => '1', 'min' => '1', 'max' => '120', 'placeholder' => 'z. B. 20', 'required' => true],
                ['name' => 'geschlecht', 'label' => 'Geschlecht', 'type' => 'select', 'required' => true, 'options' => [
                    ['value' => 'm', 'label' => 'Maennlich'],
                    ['value' => 'w', 'label' => 'Weiblich'],
                ]],
            ],
        ],
        'noten' => [
            'title' => 'Notenrechner',
            'type' => 'rechner',
            'description' => 'Trage vier Noten ein. Die App berechnet den Durchschnitt.',
            'fields' => [
                ['name' => 'mathe', 'label' => 'Mathe', 'type' => 'number', 'step' => '0.1', 'min' => '1', 'max' => '6', 'required' => true],
                ['name' => 'deutsch', 'label' => 'Deutsch', 'type' => 'number', 'step' => '0.1', 'min' => '1', 'max' => '6', 'required' => true],
                ['name' => 'englisch', 'label' => 'Englisch', 'type' => 'number', 'step' => '0.1', 'min' => '1', 'max' => '6', 'required' => true],
                ['name' => 'bwl', 'label' => 'BWL', 'type' => 'number', 'step' => '0.1', 'min' => '1', 'max' => '6', 'required' => true],
            ],
        ],
        'taschenrechner' => [
            'title' => 'Taschenrechner',
            'type' => 'rechner',
            'description' => 'Waehle zwei Zahlen und eine Rechenoperation.',
            'fields' => [
                ['name' => 'zahl1', 'label' => 'Zahl 1', 'type' => 'number', 'step' => '0.01', 'placeholder' => 'z. B. 12.5', 'required' => true],
                ['name' => 'zahl2', 'label' => 'Zahl 2', 'type' => 'number', 'step' => '0.01', 'placeholder' => 'z. B. 3', 'required' => true],
                ['name' => 'operator', 'label' => 'Operation', 'type' => 'select', 'required' => true, 'options' => [
                    ['value' => '+', 'label' => 'Addition (+)'],
                    ['value' => '-', 'label' => 'Subtraktion (-)'],
                    ['value' => '*', 'label' => 'Multiplikation (*)'],
                    ['value' => '/', 'label' => 'Division (/)'],
                    ['value' => '^', 'label' => 'Potenz (^)'],
                ]],
            ],
        ],
        'rabatt' => [
            'title' => 'Rabattrechner',
            'type' => 'rechner',
            'description' => 'Berechnet Rabattsatz, Rabattbetrag und Zahlungsbetrag.',
            'fields' => [
                ['name' => 'betrag', 'label' => 'Betrag (EUR)', 'type' => 'number', 'step' => '0.01', 'min' => '0', 'placeholder' => 'z. B. 250.00', 'required' => true],
                ['name' => 'menge', 'label' => 'Menge (Stueck)', 'type' => 'number', 'step' => '1', 'min' => '0', 'required' => true],
            ],
        ],
        'milchautomat' => [
            'title' => 'Milchautomat',
            'type' => 'automat',
            'description' => 'Waehle Milchtyp, Flaschengroesse und Menge.',
            'fields' => [
                ['name' => 'menge', 'label' => 'Menge (Stueck)', 'type' => 'number', 'step' => '1', 'min' => '1', 'required' => true],
                ['name' => 'milchtyp', 'label' => 'Milchtyp', 'type' => 'select', 'required' => true, 'options' => [
                    ['value' => 'Vollmilch', 'label' => 'Vollmilch'],
                    ['value' => 'Laktosefreie Milch', 'label' => 'Laktosefreie Milch'],
                    ['value' => 'Fettarme Milch', 'label' => 'Fettarme Milch'],
                    ['value' => 'Sojamilch', 'label' => 'Sojamilch'],
                ]],
                ['name' => 'flaschengroesse', 'label' => 'Flaschengroesse (Liter)', 'type' => 'select', 'required' => true, 'options' => [
                    ['value' => '1.5', 'label' => 'Gross (1.5 L)'],
                    ['value' => '0.7', 'label' => 'Mittel (0.7 L)'],
                    ['value' => '1.0', 'label' => 'Normal (1.0 L)'],
                    ['value' => '0.5', 'label' => 'Klein (0.5 L)'],
                ]],
            ],
        ],
        'getraenkeautomat' => [
            'title' => 'Getraenkeautomat',
            'type' => 'automat',
            'description' => 'Waehle Getraenk, Groesse und Menge. Optional gibt es Mengenrabatt.',
            'fields' => [
                ['name' => 'getraenk', 'label' => 'Getraenk', 'type' => 'select', 'required' => true, 'options' => [
                    ['value' => 'Wasser', 'label' => 'Wasser'],
                    ['value' => 'Saft', 'label' => 'Saft'],
                    ['value' => 'Cola', 'label' => 'Cola'],
                ]],
                ['name' => 'groesse', 'label' => 'Flaschengroesse (Liter)', 'type' => 'select', 'required' => true, 'options' => [
                    ['value' => '0.33', 'label' => '0.33 L'],
                    ['value' => '0.50', 'label' => '0.50 L'],
                    ['value' => '1.00', 'label' => '1.00 L'],
                ]],
                ['name' => 'menge', 'label' => 'Menge (Stueck)', 'type' => 'number', 'step' => '1', 'min' => '1', 'required' => true],
            ],
        ],
        'urlaub' => [
            'title' => 'Urlaubstagerechner',
            'type' => 'rechner',
            'description' => 'Ermittelt Urlaubstage aus Alter und Behinderungsgrad.',
            'fields' => [
                ['name' => 'alter', 'label' => 'Alter (Jahre)', 'type' => 'number', 'step' => '1', 'min' => '0', 'max' => '120', 'required' => true],
                ['name' => 'behinderung', 'label' => 'Behinderung > 50%', 'type' => 'select', 'required' => true, 'options' => [
                    ['value' => 'Ja', 'label' => 'Ja'],
                    ['value' => 'Nein', 'label' => 'Nein'],
                ]],
            ],
        ],
        'umsatz' => [
            'title' => 'Umsatzrechner',
            'type' => 'rechner',
            'description' => 'Berechnet Minimum, Durchschnitt oder Maximum aus den vorgegebenen Umsaetzen.',
            'fields' => [
                ['name' => 'filialnummer', 'label' => 'Filialnummer', 'type' => 'number', 'step' => '1', 'min' => '1', 'required' => true],
                ['name' => 'filialname', 'label' => 'Filialname', 'type' => 'text', 'placeholder' => 'z. B. Nordstadt', 'required' => true],
                ['name' => 'operation', 'label' => 'Operation', 'type' => 'select', 'required' => true, 'options' => [
                    ['value' => 'minimum', 'label' => 'Minimum'],
                    ['value' => 'durchschnitt', 'label' => 'Durchschnitt'],
                    ['value' => 'maximum', 'label' => 'Maximum'],
                ]],
            ],
        ],
        'volleyball' => [
            'title' => 'Volleyball-Team-Manager',
            'type' => 'automat',
            'description' => 'Waehle zuerst eine Aktion. Danach werden nur passende Eingabefelder gezeigt.',
            'fields' => [
                ['name' => 'aktion', 'label' => 'Aktion', 'type' => 'select', 'required' => true, 'options' => [
                    ['value' => 'anzeigen_start', 'label' => 'Startaufstellung anzeigen'],
                    ['value' => 'anzeigen_ersatz', 'label' => 'Ersatzspieler anzeigen'],
                    ['value' => 'anzeigen_kader', 'label' => 'Kader anzeigen'],
                    ['value' => 'tauschen', 'label' => 'Positionen tauschen'],
                    ['value' => 'einfuegen', 'label' => 'Spieler einfuegen'],
                    ['value' => 'entfernen', 'label' => 'Spieler entfernen'],
                    ['value' => 'sortieren', 'label' => 'Spieler sortieren'],
                    ['value' => 'suchen', 'label' => 'Spieler suchen'],
                ]],
                ['name' => 'liste', 'label' => 'Liste', 'type' => 'select', 'required' => false, 'show_on' => ['einfuegen', 'entfernen', 'sortieren', 'suchen'], 'options' => [
                    ['value' => 'Spielerliste', 'label' => 'Spielerliste'],
                    ['value' => 'Ersatzspieler', 'label' => 'Ersatzspieler'],
                    ['value' => 'Kaderliste', 'label' => 'Kaderliste'],
                ]],
                ['name' => 'von', 'label' => 'Von Position', 'type' => 'number', 'step' => '1', 'min' => '1', 'max' => '6', 'required' => false, 'show_on' => ['tauschen']],
                ['name' => 'nach', 'label' => 'Nach Position', 'type' => 'number', 'step' => '1', 'min' => '1', 'max' => '6', 'required' => false, 'show_on' => ['tauschen']],
                ['name' => 'spielername', 'label' => 'Spielername', 'type' => 'text', 'placeholder' => 'z. B. Leon', 'required' => false, 'show_on' => ['einfuegen', 'suchen']],
                ['name' => 'position_insert', 'label' => 'Position fuer Einfuegen', 'type' => 'number', 'step' => '1', 'min' => '0', 'required' => false, 'show_on' => ['einfuegen']],
                ['name' => 'position_delete', 'label' => 'Position fuer Entfernen', 'type' => 'number', 'step' => '1', 'min' => '0', 'required' => false, 'show_on' => ['entfernen']],
                ['name' => 'sortierart', 'label' => 'Sortieralgorithmus', 'type' => 'select', 'required' => false, 'show_on' => ['sortieren'], 'options' => [
                    ['value' => 'BubbleSort', 'label' => 'BubbleSort'],
                    ['value' => 'SelectionSort', 'label' => 'SelectionSort'],
                ]],
                ['name' => 'suchart', 'label' => 'Suchalgorithmus', 'type' => 'select', 'required' => false, 'show_on' => ['suchen'], 'options' => [
                    ['value' => 'LineareSuche', 'label' => 'Lineare Suche'],
                    ['value' => 'BinaereSuche', 'label' => 'Binaere Suche'],
                ]],
            ],
        ],
    ];
}
