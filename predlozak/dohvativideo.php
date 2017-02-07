
<?php

include_once 'konfig.php';

$izraz=$veza->prepare("select a.videoid, a.pregleda, a.likes, a.dislikes, a.datum,
										b.trajeod, b.trajedo, b.vise, b.manje,
										c.naziv, c.opis
										from video a inner join ponuda b on a.sifra=b.video
										inner join tipponude c on c.sifra=b.tipponude limit :odKuda,:poStranici
							");
							$izraz->execute(array("odKuda"=>$odKuda,"poStranici"=>$poStranici));
							$niz=$izraz->fetchALL(PDO::FETCH_OBJ);
							
				foreach ($niz as $stavka) {					
				include '../predlozak/videolista.php';
			};
			
			
					?>
					
