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
                	<legend>Betrag berechnen</legend>
              		<?php 
              		//EINGABE: Eingaben lesen
              		$pAlter = $_POST['tfAlter'];
              		$pBehinderung = $_POST['ddBehinderung'];
              		

              		
              		//Deklaration und Implementierung der Funktion/Methode
              		//Ermittle den Rabattsatz anhand der Menge
              		//Ermittle anhand des Values (Angabe aus dem Radiobuttonmenü)
              		function urlaubstage_berechnen($pAlter,$pBehinderung){
              		    $mUrlaub = 30;
              		    if ($pAlter > 18){
              		        if($pAlter < 55){
              		            $mUrlaub = 30;
              		        }else{
              		            $mUrlaub = 32;
              		        }
              		    }else{
              		        $mUrlaub = 35;
              		    }
              		    
              		    if($pBehinderung == "Ja"){
              		        $mUrlaub = $mUrlaub +5;
              		    }
              		    
              		    return $mUrlaub;
              		}

              		
              		//Todo-Plan: Methoden/Funktionsaufruf
              		$mUrlaubstage = urlaubstage_berechnen($pAlter,$pBehinderung);
              		//Ausgabe
              		echo "Alter (in Jahren): <h5>".$pAlter." Jahre</h5>";
              		echo "Behinderung: <h5>".$pBehinderung." </h5>";
              		echo "Urlaubstage:".round($mUrlaubstage,2)." Tage";
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
        
        	
