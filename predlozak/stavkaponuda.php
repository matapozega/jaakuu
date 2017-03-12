<tr>
	<td><b>ID</b>: <?php echo $red->videoid; ?> <br /> <b>Naziv</b>: <?php echo $red->video; ?></td>
	<td><?php echo $red->naziv; ?></td>
	<td><?php 			
				$d = strtotime($red->trajeod);
				if($d!=""){
			echo date($formatDatumaPHP, $d ); 
			}else{
				echo "&nbsp;";
			}
			?></td>
	<td><?php 			
				$d = strtotime($red->trajedo);
				if($d!=""){
			echo date($formatDatumaPHP, $d ); 
			}else{
				echo "&nbsp;";
			}
			?></td>
	<td><?php echo $red->vrijednost; ?></td>
	<td><?php echo $red->kolicina; ?></td>
	<td><?php echo $red->koeficijent; ?></td>
	<td style="width: 150px;"><a style="margin-bottom: 0px;" title="Uredi" class="button expanded" href="promjenaponuda.php?sifra=<?php echo $red -> sifra; ?>"><i class="fi-page-edit"></i> </a></td>
	<td style="width: 150px;"><a style="margin-bottom: 0px;" class="alert button expanded" title="Obriši" href="obrisiponuda.php?sifra=<?php echo $red -> sifra ?>"><i class="fi-trash"></i> </td>
</tr>