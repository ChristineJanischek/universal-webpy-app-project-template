


	<div id="content">
        <form name="notenrechnerformular"
        method="post" action="note1.php">
        	 <fieldset>
                <legend>Notendurchschnitt ausrechnen</legend>
             <label for="tfMathe">
				Note in Mathematik:
			 </label> <br />
             <input type="number" 
             	min = 1
             	max = 6
             	step="0.1"
             	name="tfMathe" 
				id="tfMathe" 
				placeholder="#.#" 
				required="required"
				autofocus="autofocus"/><br /><br />
             <label for="tfDeutsch">
				Note in Deutsch:
			 </label> <br />
             <input type="number" 
             	min = 1
             	max = 6
             	step="0.1"
             	name="tfDeutsch" 
				id="tfDeutsch" 
				placeholder="#.#" 
				required="required"/><br /><br />  
             <label for="tfEnglisch">
				Note in Englisch:
			 </label> <br />
             <input type="number" 
             	min = 1
             	max = 6
             	step="0.1"
             	name="tfEnglisch" 
				id="tfEnglisch" 
				placeholder="#.#" 
				required="required"/><br /><br />  
             <label for="tfBwl">
				Note in Bwl:
			 </label> <br />
             <input type="number" 
             	min = 1
             	max = 6
             	step="0.1"
             	name="tfBwl" 
				id="tfBwl" 
				placeholder="#.#" 
				required="required"/><br /><br />  
           	<input type="submit" 
					value="Ausrechnen" name='durchschnittAusrechnen'/>
            <?php echo"<input type='button' value='Zur&uuml;ck' 
                onClick='history.back()' />" ?> 
                        
             </fieldset>        	 
        </form>           
	</div>	


