	<div id="content">
				<fieldset>
				<legend>Volleyball Spieler organisieren</legend>
									<form name="Volleyballformular" method="post" action="volleyball1.php">							
    						<fieldset>
            					<legend>Anzeigeoption w&auml;hlen</legend>	
            					<div id="left">
            						<input type="radio" name="rbSpieler" value="1"/>(1) Startaufstellung<br/><br/>
            						<input type="radio" name="rbSpieler" value="2"/>(2) Ersatzspieler<br/><br/>
            						<input type="radio" name="rbSpieler" value="3"/>(3) Kader<br/><br/>
                					<input type="submit" value="Anzeigen" name='Anzeigen'/>  
            					</div>					
							</fieldset><br /><br /> 
							<fieldset>
						<legend>Tauschoption w&auml;hlen</legend>
							<div id="left">
            					
             					<input type="radio" name="rbSpieler" value="4"/>(4) tauschen<br/><br/>
            				</div> 
            				<div id="right">
            					<label for="tfVon">von Position:</label><br />
                				<input type="number" step="1.00" name="tfVon" 
                						id="tfVon" placeholder="##" /><br /><br />
                				<label for="tfNach">nach Position:</label> <br />
                				<input type="number" step="1.00" name="tfNach" 
                						id="tfNach" placeholder="##" /><br /><br />                				                                
    							<input type="submit" value="Tauschen" name='Tauschen'/>
            				</div> 
 
             				          					
            			</fieldset><br /><br /> 
            			<fieldset>
          					<legend>Einf&uuml;geoption w&auml;hlen</legend>	
          					<div id="left">            					
             					<input type="radio" name="rbSpieler" value="5"/>(5) Spieler einf&uuml;gen<br/><br/>
             					<label for="ddListe">Liste w&auml;hlen:</label>

                                <select name="ddListe" id="ddListe">
                                  <option value="Spielerliste">Spielerliste</option>
                                  <option value="Ersatzspieler">Ersatzspieler</option>
                                  <option value="Kaderliste">Kaderliste</option>
                                </select> 
            				</div> 
          					<div id="right">
            						<label for="tfSpielername">Spielername:</label><br />
                					<input type="text" name="tfSpielername" 
                						id="tfSpielername" placeholder="##"/><br /><br />
                					<label for="tfPosition_insert">An Position:</label><br />
                					<input type="text" name="tfPosition_insert" 
                						id="tfPosition_insert" placeholder="##"/><br /><br />
                					<input type="submit" value="Einf&uuml;gen" name='Einfuegen'/>  		
                			</div>			
						</fieldset><br /><br />
						            			<fieldset>
          					<legend>Entfernoption w&auml;hlen</legend>	
          					<div id="left">            					
             					<input type="radio" name="rbSpieler" value="6"/>(6) Spieler entfernen<br/><br/>
             					<label for="ddListe">Liste w&auml;hlen:</label>

                                <select name="ddListe" id="ddListe">
                                  <option value="Spielerliste">Spielerliste</option>
                                  <option value="Ersatzspieler">Ersatzspieler</option>
                                  <option value="Kaderliste">Kaderliste</option>
                                </select> 
            				</div> 
          					<div id="right">
                					<label for="tfPosition_delete">An Position:</label><br />
                					<input type="text" name="tfPosition_delete" 
                						id="tfPosition_delete" placeholder="##"/><br /><br />
                					<input type="submit" value="Entfernen" name='Entfernen'/>  		
                			</div>			
						</fieldset><br /><br />
						<fieldset>
          					<legend>Sortierungsoption w&auml;hlen</legend>	
          					<div id="left">            					
             					<input type="radio" name="rbSpieler" value="7"/>(7) Spieler sortieren<br/><br/>
             					<label for="ddListe">Liste w&auml;hlen:</label>

                                <select name="ddListe" id="ddListe">
                                  <option value="Spielerliste">Spielerliste</option>
                                  <option value="Ersatzspieler">Ersatzspieler</option>
                                  <option value="Kaderliste">Kaderliste</option>
                                </select> 
                                
            				</div> 
          					<div id="right">
								<label for="ddSortieren">Algorithmus w&auml;hlen:</label>
                                <select name="ddSortieren" id="ddSortieren">
                                  <option value="BubbleSort">BubbleSort</option>
                                  <option value="SelectionSort">SelectionSort</option>
                                </select><br /><br /><br /><br />
                				<input type="submit" value="Sortieren" name='Sortieren'/>  		
                			</div>			
						</fieldset><br /><br />
						<fieldset>
          					<legend>Suchoption w&auml;hlen</legend>	
          					<div id="left">            					
             					<input type="radio" name="rbSpieler" value="8"/>(8) Spieler suchen<br/><br/>          					
             					<label for="ddListe">Liste w&auml;hlen:</label>
                                <select name="ddListe" id="ddListe">
                                  <option value="Spielerliste">Spielerliste</option>
                                  <option value="Ersatzspieler">Ersatzspieler</option>
                                  <option value="Kaderliste">Kaderliste</option>
                                </select> <br /><br />
                                <label for="tfName_search">Name eingeben:</label><br />
                				<input type="text" name="tfName_search" id="tfName_search" placeholder="##"/><br /><br />	  
            				</div> 
          					<div id="right">
								<label for="ddSuchen">Algorithmus w&auml;hlen:</label>
                                <select name="ddSuchen" id="ddSuchen">
                                  <option value="LineareSuche">Linare Suche</option>
                                  <option value="BinaereSuche">Bin&auml;re Suche</option>
                                </select><br /><br /><br /><br />
                				<input type="submit" value="Suchen" name='Suchen'/>  		
                			</div>			
						</fieldset><br /><br />
            	
						<?php echo"<input type='button' value='Zur&uuml;ck' onClick='history.back()' />" ?>
					</form>
				</fieldset>	
	</div>	