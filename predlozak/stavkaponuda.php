<tr>
	<td><?php echo $red->videoid; ?></td>
	<td><?php echo $red->naziv; ?></td>
	<td><?php echo $red->trajeod; ?></td>
	<td><?php echo $red->trajedo; ?></td>
	<td><?php echo $red->vise; ?></td>
	<td><?php echo $red->manje; ?></td>
	<td style="width: 150px;"><a style="margin-bottom: 0px;" title="Uredi" class="button expanded" href="promjenaponuda.php?sifra=<?php echo $red -> sifra; ?>"><i class="fi-page-edit"></i> </a></td>
	<td style="width: 150px;"><a style="margin-bottom: 0px;" class="alert button expanded" title="Obriši" href="obrisiponuda.php?sifra=<?php echo $red -> sifra ?>"><i class="fi-trash"></i> </td>
</tr>