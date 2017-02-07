						<fieldset>
							<legend>Osobni podaci</legend>
							<?php 
							
								inputPolje("text","ime", "Ime", $poruke);
								inputPolje("text","prezime", "Prezime", $poruke);
								inputPolje("number","oib", "Oib", $poruke);
								inputPolje("date","datumrodenja", "Datum rođenja", $poruke);
							
							 ?>
						</fieldset>
						<fieldset>
							<legend>Adresa stanovanja</legend>
							<?php 
							
								inputPolje("text","ulica", "Ulica", $poruke);
								inputPolje("text","mjesto", "Mjesto", $poruke);
								inputPolje("text","drzava", "Država", $poruke);
								inputPolje("number","postanskibr", "Poštanski broj", $poruke);
							
							 ?>
						</fieldset>
						<fieldset>
							<legend>Login podaci</legend>
							<?php 
							
								inputPolje("email","email", "E-mail", $poruke);
								inputPolje("password","lozinka", "Lozinka", $poruke);
								inputPolje("password","potvrid_lozinku", "Ponovi lozinku", $poruke);
								inputPolje("date","datumrodenja", "Datum rođenja", $poruke);
							
							 ?>
						</fieldset>
						