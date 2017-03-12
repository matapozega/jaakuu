<tr>
	
	<td id="n_<?php echo $red->sifra; ?>"><?php echo $red->naziv; ?> <?php echo $red->tip; ?> od <?php echo $red->kolicina; ?></td>
	<td><b>Od:</b> <?php 			
				$d = strtotime($red->trajeod);
				if($d!=""){
			echo date($formatDatumaPHP, $d ); 
			}else{
				echo "&nbsp;";
			}
			?> <b>Do:</b> <?php 			
				$d = strtotime($red->trajedo);
				if($d!=""){
			echo date($formatDatumaPHP, $d ); 
			}else{
				echo "&nbsp;";
			}
			?> </td>
	<td id="st_<?php echo $red->sifra; ?>">
		<a class="button k1" id="p1_<?php echo $red->sifra ?>_<?php echo $red -> koeficijent; ?>_<?php echo $stavka->sifra ?>_<?php echo $red->sifratip; ?>">
			<?php echo $red -> koeficijent; ?>
			</a> </td>
</tr>
		
