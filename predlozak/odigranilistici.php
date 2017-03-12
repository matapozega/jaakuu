<tr>
	<td>
		<?php echo $stavka->sifra; ?>
	</td>
	<td>
		<?php echo $stavka->uplata; ?> Jaakuu
	</td>
	<td>
		<?php echo $stavka->ukupnikoeficijent; ?>
	</td>
	<td>
		<ol>
		<?php 
		$izraz=$veza->prepare("select a.sifra, c.naziv as vm, c.koeficijent as koef, d.naziv as ime,e.naziv as tip from
								listic a inner join	listic_ponuda b on a.sifra=b.listic
								inner join ponuda c on b.ponuda=c.sifra
								inner join video d on c.video=d.sifra
								inner join tipponude e on e.sifra=c.tipponude
								where a.korisnik=:korisnik and a.sifra=:sifra;");
							$izraz->execute(array("korisnik"=>$_SESSION[$sid . "autoriziran"]->sifra, "sifra"=>$stavka->sifra));
							$niz=$izraz->fetchALL(PDO::FETCH_OBJ);
							
				foreach ($niz as $stavka1): 	?>
				
					<li><?php echo $stavka1->ime; ?>, <?php echo $stavka1->tip; ?>, <?php echo $stavka1->vm; ?>, <?php echo $stavka1->koef; ?></li>
				
				<?php
				endforeach;
	 	?> 
	 	</ol>
	</td>
	<td>
		<?php 
			echo number_format((float)$stavka->evdobitak, 2, '.', ''); 
		 ?> Jaakuu
	</td>
</tr>