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
                	<legend>Notendurchschnitt ausrechnen</legend>
              		<?php 
              		//EINGABE: Eingaben lesen
              		$pMathe= $_POST['tfMathe'];
              		$pDeutsch = $_POST['tfDeutsch'];
              		$pEnglisch= $_POST['tfEnglisch'];
              		$pBwl = $_POST['tfBwl'];
              		
              		//Deklaration und Implementierung der Funktion/Methode
              		function berechne_notendurchschnitt($pMathe,$pDeutsch,$pEnglisch,$pBwl){
              		    
              		    $mNotendurchschnitt = ($pMathe+$pDeutsch+$pEnglisch+$pBwl)/4;
              		    return $mNotendurchschnitt;
              		}
              		
              		//Methoden/Funktionsaufruf
              		$ausgabe = berechne_notendurchschnitt($pMathe,$pDeutsch,$pEnglisch,$pBwl);
              		
              		//Ausgabe
              		echo "Note in Mathematik: <h5>".$pMathe."</h5>";
              		echo "Note in Deutsch: <h5>".$pDeutsch."</h5>";
              		echo "Note in Englisch: <h5>".$pEnglisch."</h5>";
              		echo "Note in Bwl: <h5>".$pBwl."</h5>";
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
        
        	
