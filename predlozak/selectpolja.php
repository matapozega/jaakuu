<?php

function selectPolje($naziv,$naslov,$poruke){
	?>
	
		<label><?php echo strtoupper(substr($naslov,0,1)) . substr($naslov, 1); ?>
						<select>
							<?php
							$izraz2 = $veza -> prepare("select naziv from tipponude;");
							$izraz2 -> execute();
							$tip = $izraz2 -> fetchALL(PDO::FETCH_OBJ);
							foreach ($tip as $stavka) {
								echo '<option  name="tipponnude" value="' . $_POST[$naziv] . '">' . $stavka -> naziv . '</option>';
							}
							?>
						</select> 
						</label>
						<?php if (isset($poruke[$naziv])): ?>
						<p class="help-text" id="<?php echo $naziv ?>Pomoc"><?php echo $poruke[$naziv]; ?></p>
						<?php endif;
						

}
	