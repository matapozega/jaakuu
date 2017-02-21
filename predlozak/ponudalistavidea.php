<div class="large-12 columns end">
	<div style="text-align: center;" class="item-wrapper">
		<iframe allowfullscreen="allowfullscreen" src="https://www.youtube.com/embed/<?php echo $stavka -> videoid; ?>"></iframe>
		<h4 ><a href="https://www.youtube.com/watch?v=<?php echo $stavka -> videoid; ?>" id="t_<?php echo $stavka -> vid; ?>" target="_blank">
			<?php echo $stavka -> naziv; ?></a></h4>
		<div class="row" style="min-height: 50px">
			<div class="large-3 columns">
				<i class="fi-like"></i><p><?php echo $stavka -> likes; ?></p>
			</div>
			<div class="large-3 columns">
				<i class="fi-dislike"></i><p><?php echo $stavka -> dislikes; ?></p>
			</div>
			<div class="large-3 columns">
				<i class="fi-eye"></i><p><?php echo $stavka -> pregleda; ?></p>
			</div>
			<div class="large-3 columns">
				<i class="fi-calendar"></i><p><?php echo $stavka -> datum; ?></p>
					</div>
		</div>
		<table class="hover">
			<thead>
				<td>Ponuda tipa:</td>
				<td colspan="2">Koeficijent:</td>
			</thead>
			<?php
			$izraz1 = $veza -> prepare("select a.koeficijent,a.naziv,b.naziv as tip from ponuda a inner join tipponude b on a.tipponude=b.sifra where video=:videoid");
			$izraz1 -> execute(array("videoid" => $stavka -> sifra));
			$niz = $izraz1 -> fetchAll(PDO::FETCH_OBJ);
			foreach ($niz as $red) {
				include '../predlozak/izlistanjeponude.php';
			}
			 ?>
	 	</table>
	 
	</div>
</div>
