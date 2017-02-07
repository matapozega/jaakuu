<tr>
	<td><?php echo $red->videoid; ?></td>
	<td style="max-width: 400px;"><?php echo $red->naziv; ?></td>
	<td><?php echo $red->pregleda; ?></td>
	<td><?php echo $red->likes; ?></td>
	<td><?php echo $red->dislikes; ?></td>
	<td>
			<?php 			
				$d = strtotime($red->datum);
				if($d!=""){
			echo date($formatDatumaPHP, $d ); 
			}else{
				echo "&nbsp;";
			}
			?></td>
	<td style="width: 150px;"><a style="margin-bottom: 0px;" title="Uredi" class="button expanded" href="promjenavideo.php?sifra=<?php echo $red -> sifra; ?>"><i class="fi-page-edit"></i> </a></td>
	<td style="width: 150px;"><a style="margin-bottom: 0px;" class="alert button expanded" title="Obriši" href="obrisivideo.php?sifra=<?php echo $red -> sifra ?>"><i class="fi-trash"></i> </td>
</tr>