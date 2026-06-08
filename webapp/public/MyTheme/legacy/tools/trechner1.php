	<?php
	    include ("head.php");
	?>

<body>

	<div id="wrapper">
    	<?php
    	    include ("header.php");
    	?>
    
        <div id="content">
            <form>
                <fieldset>
                	<legend>Rechenoperation durchf&uumlhren</legend>
              		<?php 
              		//EINGABE: Eingaben lesen
              		$pZahl1 = $_POST['tfZahl1'];
              		$pZahl2 = $_POST['tfZahl2'];
              		
              		//Deklaration und Implementierung der Funktion/Methode
              		//Prüfung: Wurde ein Radio-Button ausgewählt?
              		function pruefe(){
              		    // Für den Fall, dass ein Radio-Button ausgewählt wurde..
              		    if(isset($_POST['rbOperator'])){
              		        /* Soll der Wert (value) von rbOperator(1-5) in eine lokale Variable 
              		        * (Platzhalter für Wert) übernommen werden (Zuweisung)*/
              		        $pOption = $_POST['rbOperator'];
              		    /*Ansonsten*/
              		    }else{
              		        /* Soll der Wert 0 zugewiesen werden*/
              		        $pOption = 0;
              		    }
              		    /*Abschließend soll der Wert von $pOption zurückgegeben werden*/
              		    return $pOption;
              		}
              		
              		function addieren($pZahl1,$pZahl2){
              		    $ergebnis = $pZahl1 + $pZahl2;
              		    return $ergebnis;
              		}
              		
              		//subtrahieren
              		function subtrahieren($pZahl1,$pZahl2){
              		    $ergebnis = $pZahl1 - $pZahl2;  
              		    return $ergebnis;
              		}
              		
              		//multiplizieren
              		function multiplizieren($pZahl1,$pZahl2){
              		    $ergebnis = $pZahl1 * $pZahl2;
              		    return $ergebnis;
              		}
              		
              		function dividieren($pZahl1,$pZahl2){
              		    if($pZahl2 != 0){
              		        $ergebnis = $pZahl1 / $pZahl2;
              		    }else{
              		        $ergebnis = "Devision by zero";
              		        echo "Division durch Null nicht m&ouml;glich!<br><br>";
              		    }
              		    return $ergebnis;
              		}
              		
              		function potenzieren($pZahl1,$pZahl2){
              		    $mErgebnis = pow($pZahl1,$pZahl2);
              		    return $mErgebnis;
              		}
              		
              		//Methodenaufruf/Funktionsaufruf
              		$value = pruefe();
              		
              		function entscheide_und_berechne($value,$pZahl1,$pZahl2){
              		    $mErgebnis = 0;
              		    if($value == 1){
              		        //Methodenaufruf/Funktionsaufruf
              		        $mErgebnis = addieren($pZahl1,$pZahl2);
              		    }else if($value == 2){
              		        //Methodenaufruf/Funktionsaufruf
              		        $mErgebnis = subtrahieren($pZahl1,$pZahl2);
              		    }else if($value == 3){
              		        //Methodenaufruf/Funktionsaufruf
              		        $mErgebnis = multiplizieren($pZahl1,$pZahl2);
              		    }else if($value == 4){
              		        //Methodenaufruf/Funktionsaufruf
              		        $mErgebnis = dividieren($pZahl1,$pZahl2);
              		    }else if($value == 5){
              		        //Methodenaufruf/Funktionsaufruf
              		        $mErgebnis = potenzieren($pZahl1,$pZahl2);
              		    }else{
              		        $mErgebnis = "Bitte wählen Sie eine der Rechenoperationen aus!";
              		    }
              		    return $mErgebnis;
              		}
              		
              		function ermittle_Rechenoperation($value,$pZahl1,$pZahl2){
              		    $zeichen = "";
              		    switch ($value){
              		        case 1:
                  		        //Zuweisung eines Wertes --> Initialisierung
                  		        $zeichen ="+";
                  		        break;
              		        case 2:
                  		        //Zuweisung eines Wertes --> Initialisierung
                  		        $zeichen ="-";
                  		        break;
              		        case 3:
                  		        //Zuweisung eines Wertes --> Initialisierung
                  		        $zeichen ="*";
                  		        break;
              		        case 4:
                  		        //Zuweisung eines Wertes --> Initialisierung
                  		        $zeichen ="/";
                  		        break;
              		        
              		        case 5:
                  		        //Zuweisung eines Wertes --> Initialisierung
                  		        $zeichen ="^";
                  		        break;
              		        default:
                  		        //Zuweisung eines Wertes --> Initialisierung
                  		        $zeichen ="";
              		    }
              		    return $zeichen;
              		}
              		
              		//Methoden/Funktionsaufruf
              		$ausgabe = entscheide_und_berechne($value,$pZahl1,$pZahl2);
              		$zeichen = ermittle_Rechenoperation($value,$pZahl1,$pZahl2);
              		//Ausgabe
              		echo "Zahl1: <h5>".$pZahl1."</h5>";
              		echo "Zahl2: <h5>".$pZahl2."</h5>";
              		echo "Operator:<h5>".$zeichen."</h5>";
              		echo "Ergebnis:".round($ausgabe,2);
              		?>
              		
              	
              	
              	</fieldset>
          	</form>
        </div><!-- Content-Box -->
        <?php
            include ("sidebar.php"); 
        ?>
        
        <?php
            include ("footer.php"); 
        ?>
        
     </div>  <!-- Wrapper-Box -->
</body> 
</html>
        
        	
