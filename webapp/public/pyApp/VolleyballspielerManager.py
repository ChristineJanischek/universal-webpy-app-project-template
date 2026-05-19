spieler = ["Armin", "Batu", "Kai", "Sven", "Paul", "Milan"] 
ersatz  = ["Chris", "Dennis", "Emin", "Goran", "Luca", "Nico"] 
 
kader = spieler + ersatz 

menue = ["(1) Startaufstellung anzeigen",
         "(2) Ersatzspieler anzeigen",
         "(3) Kader anzeigen",
         "(4) Position tauschen",
         "(5) Spieler einfügen",
         "(6) Spieler einfügen",
         "(7) Kader mittels BubbleSort sortieren",
         "(8) Kader mittels SelectionSort sortieren",
         "(9) Kaderspieler mittels linearer Suche suchen",
         "(10) Kaderspieler mittels binärer Suche suchen"]

def menue_anzeigen(): 
    print("(1) Startaufstellung anzeigen") 
    print("(2) Ersatzspieler anzeigen") 
    print("(3) Kader anzeigen")
    print("(4) Position tauschen")
    print("(5) Spieler einfügen")
    print("(6) Spieler einfügen")
    print("(7) Kader mittels BubbleSort sortieren")
    print("(8) Kader mittels SelectionSort sortieren")
    print("(9) Kaderspieler mittels linearer Suche suchen")
    print("(10) Kaderspieler mittels binärer Suche suchen")
 
    return int(input("Anzeigewunsch (1-10): ")) 
 
#funktion für die startaufstellung 
def zeige_startaufstellung(): 
    print("-------------------------") 
    print("Startaufstellung") 
    print("-------------------------") 
    for i in range(0,len(spieler),1): 
        print(spieler[i])

    #Rückgabe  
    return spieler
     
#funktion für die ersatzspieler 
def zeige_ersatzspieler(): 
    print("-------------------------") 
    print("Ersatzspieler") 
    print("-------------------------") 
    for i in range(0,len(ersatz),1): 
        print(ersatz[i])

    #Rückgabe  
    return ersatz
     
#funktion für die kaderspieler 
def zeige_kader(): 
    print("-------------------------") 
    print("Kader") 
    print("-------------------------") 
    for i in range(0,len(kader),1): 
        print(kader[i])

    #Rückgabe  
    return kader

#Funktion Volleyballspieler tauschen
def mannschaft_umstellen_pos():
    print("Startaufstellung umstellen")
    position_von = int(input("Tausche Position:" ))
    position_nach = int(input("mit Position: " ))
    parkplatz = spieler[position_von -1]
    spieler[position_von-1] = spieler[position_nach-1]
    spieler[position_nach-1] = parkplatz
    print("---------------------")
    print("Neue Startaufstellung")
    print("---------------------")
    for i in range(0,len(spieler),1):
        print(spieler[i])

    #Rückgabe  
    return spieler
        
def einfuegen_spieler():
    spielername = str(input("Spielername:" ))
    position = int(input("Index: " ))
    anzahl = len(kader)
    kader.append(spielername)   
    for i in range(anzahl,position,-1):
        parkplatz = kader[i-1]
        kader[i-1] = kader[i]
        kader[i] = parkplatz
    print("---------------------")
    print("Kader")
    print("---------------------")
    for i in range(0,anzahl,1): 
        print(kader[i])

    #Rückgabe      
    return kader
        
def entfernen_spieler():
    #EINGABEN
    index = int(input("Entferne Spieler an der Stelle mit dem Index: "))
    laenge = len(kader)
    
    #WERARBEITUNG
    #Rücke den Spieler dann Schritt für Schritt nach vorn
    for i in range(index, laenge-1,1):    
        kader[i] = kader[i+1]
    
    #letztes Element mit nichts überschreiben
    kader[laenge-1] = ""
    
    #AUSGABE
    print("--------------")
    print("Kader")
    print("--------------")
    for i in range(0,laenge,1): 
        print(kader[i])

    #Rückgabe  
    return kader

def spieler_mittels_BubbleSort_sortieren():
    laenge = len(kader)
    zwischenspeicher = 0
    for i in range(1,laenge,1):
        for j in range(0,laenge-i,1):
            if(kader[j]>kader[j+1]):
                zwischenspeicher = kader[j]
                kader[j] = kader[j+1]
                kader[j+1] = zwischenspeicher

    #Ausgabe
    for k in range(0,laenge,1):
        print(kader[k])

    #Rückgabe  
    return kader

def spieler_mittels_SelectionSort_sortieren():
    laenge = len(kader)
    zwischenspeicher = 0
    
    for akt_index in range(0,laenge,1):
        min_index = akt_index
        for j in range(akt_index +1,laenge,1):
            if(kader[j] < kader[min_index]):
                min_index = j
        if(akt_index != min_index):
            zwischenspeicher = kader[akt_index]
            kader[akt_index] = kader[min_index]
            kader[min_index] = zwischenspeicher

    #Ausgabe
    for k in range(0,laenge,1):
        print(kader[k])
    
    #Rückgabe    
    return kader

def spieler_mittels_linearer_Suche_suchen():    
    #Deklaration und einlesen
    eingabe = input("Kaderspielername eingeben:")
    
    #Deklaration und Initialisierung
    # laenge = Anzahl der Elemente des  Array mnr
    laenge = len(kader)
    
    name = ""
    position=0
    
    #Deklaration und Initialisierung
    gefunden = False
    #Wiederhole
    for i in range(0,laenge,1):
        #Prüfe
        if(kader[i]== eingabe):
            #Ja:Fall
            #Zuweisung
            gefunden = True
            name = kader[i]
            position = i
    
    #Prüfe
    if(gefunden):
        #Ja-Fall
        #Ausgabe
        meldung = "Kaderspieler gefunden:",name, "an Position", position 
        
    else:
        #Sonst-Fall
        #Ausgabe
        meldung = "Dieser Kaderspieler wurde nicht gefunden!"  

    #Ausgabe
    print(meldung)
    
    #Rückgabe
    return meldung
        
def spieler_mittels_binaerer_Suche_suchen():
    sortiert = spieler_mittels_SelectionSort_sortieren()

    name = input("Gesuchter Kaderspielername:")
    gefunden = False
    index_anfang = 0
    index_ende = len(sortiert)-1
    position = 0

    while gefunden == False and index_anfang <= index_ende:
        index_mitte = int((index_anfang + index_ende) / 2)
        
        if sortiert[index_mitte] == name:
            gefunden = True
            position = index_mitte
        elif sortiert[index_mitte] > name:        
            index_ende = index_mitte - 1
        else:
            index_anfang = index_mitte + 1

    if gefunden:
        meldung= "Kaderspieler gefunden:",name, "an Position", position
    else:
        meldung= "Dieser Kaderspieler wurde nicht gefunden!"

    #Ausgabe
    print(meldung)
    
    #Rückgabe
    return meldung

def auswahl_anzeigen(anzeige):
    if anzeige == 1: zeige_startaufstellung()
    
    elif anzeige == 2: zeige_ersatzspieler()
    
    elif anzeige == 3: zeige_kader()
    
    elif anzeige == 4: mannschaft_umstellen_pos()
    
    elif anzeige == 5: einfuegen_spieler()
    
    elif anzeige == 6: entfernen_spieler()
    
    elif anzeige == 7: spieler_mittels_BubbleSort_sortieren()
    
    elif anzeige == 8: spieler_mittels_SelectionSort_sortieren()
    
    elif anzeige == 9: spieler_mittels_linearer_Suche_suchen()
    
    elif anzeige == 10: spieler_mittels_binaerer_Suche_suchen()
            
anzeige = menue_anzeigen() 
auswahl_anzeigen(anzeige) 
