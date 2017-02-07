<tr>
	<td><?php echo $red -> naziv; ?></td>
	<td><?php echo $red -> opis; ?></td>
	<td style="width: 150px;"><a style="margin-bottom: 0px;" title="Uredi" class="button expanded" href="promjenatip.php?sifra=<?php echo $red -> sifra; ?>"><i class="fi-page-edit"></i> </a></td>
	<td style="width: 150px;"><a style="margin-bottom: 0px;" class="alert button expanded" title="Obriši" href="obrisitip.php?sifra=<?php echo $red -> sifra ?>"><i class="fi-trash"></i> </td>
</tr>