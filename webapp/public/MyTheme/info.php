<?php
function beispiel_springen(){
    for ($i = 0, $j = 50; $i < 100; $i++) {
        
            if ($j == 50/2) {
                
                //Sprunglable setzen: springe nach "end:" 
                goto end;
            }
    }
    echo "i = $i";
    //Sprungmarke
    end:
    echo "i ist halbsogroß";
}
?>