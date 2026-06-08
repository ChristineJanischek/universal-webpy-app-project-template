
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
				<legend>Ergebnis berechnen</legend>
				<?php 
			      //EIMGABE: Eingabe lesen
			         $pFilialnummer = $_POST['tfFilialnummer'];
			         $pFilialname = $_POST['tfFilialname'];
			         
			         #Deklaration und Initialisierung
			         $umsaetze = array(1000, 1500 ,1100 ,1200, 1150, 950, 500, 
			                                 8800, 16000, 433, 8000, 5000);
			         $operation= "";
			         
			      //Verhaltensweise: Methode/Funkton  
						
					// 1.Schritt der Zerlegung:Minimum ermitteln	
			         function ermittle_Minimum($pUmsaetze){
			             //###EIMGABE###
			             // Fehler im Struktogramm, hier ausgebessert!
			             $ergebnis= $pUmsaetze[0];
			             $i = 0;
			             while($i < COUNT($pUmsaetze)){
			                 $mBetrag_1 =$pUmsaetze[$i];
			                 if($mBetrag_1 < $ergebnis){
			                   //JA_Fall 
			                   $ergebnis = $mBetrag_1;
			                   $i++;
			                 }else{//SONST-Fall (NEIN-FALL)
			                   $i++;  
			                 }
			                 
			                 return $ergebnis;
			             }			             
			         }
			         
			         // 2.Schritt der Zerlegung:Minimum ermitteln
			         function ermittle_Durchschnitt($pUmsaetze){
			             //###EIMGABE###
			             $ergebnis = 0;
			             $mAnzahl= COUNT($pUmsaetze);
			             //###VERARBEITUNG###
			             
			             for($i = 0;$i<$mAnzahl;$i++){
			                 //kummuliert (aufaddieren) die Umsätze schrittweise 
			                 //bei jedem Schleifendurchlauf
			                 $ergebnis = $ergebnis + $pUmsaetze[$i];
			                
			             }
			             //Berechnung des Durchschnitts
			             $durchschnitt = $ergebnis/COUNT($pUmsaetze);
			             //Rückgabe
			             return $durchschnitt;
			         }
			         
			         // 3.Schritt der Zerlegung:Maximum ermitteln
			         function ermittle_Maximum($pUmsaetze){
			             //###EIMGABE###
			             $ergebnis = $pUmsaetze[0];
			             $mAnzahl= COUNT($pUmsaetze);
			             $i = 0;
			             
			             //###VERARBEITUNG###
			             
			             do{
			                 $mBetrag_1 = $pUmsaetze[1];
			                 if($pUmsaetze[$i] > $ergebnis){
			                     $ergebnis = $pUmsaetze[$i];
			                 }
			                 
			                 $i++;
			                 
			             } while($i < $mAnzahl);
			             
			             return $ergebnis;
			         }
                    
			         //4. Schritt: Prüfe welche Operation (Minimum, Durchschnitt, Maximum) 
			         //aufgeführt werden soll!
			         function pruefe_und_ermittle($pUmsaetze){

			             if(isset($_POST['btMinimum'])){
			                 $ergebnis = ermittle_Minimum($pUmsaetze);
			                 
			             }elseif(isset($_POST['btDurchschnitt'])){			                 
			                 $ergebnis = ermittle_Durchschnitt($pUmsaetze);
			                 
			             }elseif(isset($_POST['btMaximum'])){
			                 $ergebnis = ermittle_Maximum($pUmsaetze);
			                 
			             }
			             return $ergebnis;
			         }
			         
			         //5. Schritt: Prüfe welche Operation (Minimum, Durchschnitt, Maximum)
			         //und setzte die Bezeichnung für die Operation
			         function ermittle_Operation($pUmsaetze){			             
			             if(isset($_POST['btMinimum'])){
			                 $operation = "Minimum ermitteln";
			             }elseif(isset($_POST['btDurchschnitt'])){
			                 $operation = "Durchschnitt ermitteln";
			             }elseif(isset($_POST['btMaximum'])){
			                 $operation = "Maximum ermitteln";
			             }
			             return $operation;
			         }
					  			 
			         /* Funktions-/Methodenaufrauf: Die Berechnung */
			         $ergebnis = pruefe_und_ermittle($umsaetze);
			         $operation = ermittle_Operation($umsaetze);
			         
			         //###AUSGABE###
			         echo "Filialnummer: <h5>".$pFilialnummer."</h5>";
			         echo "Filiamname: <h5>".$pFilialname."</h5>";
			         echo "Ergebnis:<h5> ".$ergebnis."</h5>";
			         echo "Operation:<h5> ".$operation."</h5>";

			?>
			</fieldset><!--Fieldset-Box schließen-->
		</form><!--Form-Box schließen-->
	</div><!--Content-Box schließen-->
	<?php 
	   include ("sidebar.php"); 
    ?>
    
	<?php
        include ("footer.php"); 
    ?>
	</div><!--Wrapper-Box schließen-->
</body>
</html>
	
	
