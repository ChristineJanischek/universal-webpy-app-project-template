 
		<div id="content">

                  <div id="form">
                  		<form name="filialumsatzrechnerformular"method="post" action="umsatz1.php">
							<fieldset>
								<legend>Filialdaten eingeben</legend>
								<label for="tfFilialnummer">
									Filialnummer:
								</label> <br />
								<input type="number" step="1.0" name="tfFilialnummer" 
									id="tfFilialnummer" placeholder="##.##" 
									required="required"
									autofocus="autofocus" /><br /><br />
								<label for="tfFilialname">
									Filialname:
								</label> <br />
								<input type="text" name="tfFilialname" 
									id="tfFilialname" placeholder="############" 
									required="required"/><br /><br />

								<?php echo"<input type='button' value='Zur&uuml;ck' 
                                    onClick='history.back()' />" ?> 
								
							</fieldset>
							<fieldset>
								<legend>Operationen</legend>

								<input type="submit" 
									value="Minimum ermitteln" name='btMinimum'/>
								<input type="submit" 
									value="Durchschnitt ermitteln" name='btDurchschnitt'/>
								<input type="submit" 
									value="Maximum ermitteln" name='btMaximum'/>
								
							</fieldset>
						</form>
                  </div>
		</div>	
 

