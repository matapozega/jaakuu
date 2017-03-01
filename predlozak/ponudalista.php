
		
			<div class="large-6 columns end">
				<div style="text-align: center;" class="item-wrapper">
					<iframe allowfullscreen="allowfullscreen" src="https://www.youtube.com/embed/<?php echo $stavka -> videoid;?>"></iframe>
					<h4 style="min-height: 120px;" ><a href="https://www.youtube.com/watch?v=<?php echo $stavka -> videoid; ?>" id="t_<?php echo $stavka->vid; ?>" target="_blank">
						<?php echo $stavka -> ime; ?></a></h4>
					<div class="row">
						<div  class="large-6 columns">
						  Više
						</div>
						<div class="large-6 columns">
						  Manje
						</div>
					</div>
					<div class="row">
						<div class="large-6 columns">
						  <a class="button k1" id="p1_<?php echo $stavka->sifra ?>_<?php echo $stavka -> vise; ?>_<?php echo $stavka->vid ?>_<?php echo $stavka->tip; ?>"><?php echo $stavka -> vise; ?></a> 
						</div>
						<div class="large-6 columns">
						  <a class="button success k2" id="p2_<?php echo $stavka->sifra ?>_<?php echo $stavka -> manje; ?>_<?php echo $stavka->vid ?>_<?php echo $stavka->tip; ?>"><?php echo $stavka -> manje; ?></a>
						</div>
					</div>			
					<div class="row">
						<div class="large-12 columns">
							<h5 id="n_<?php echo $stavka->tip; ?>"><?php echo $stavka -> naziv; ?></h5>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns" style="min-height: 50px">
							<p>
								<?php echo $stavka -> opis; ?><br />
							</p>
							
						</div>
					</div>
					<div class="row" style="min-height: 50px">
						<div class="large-6 columns">
							<i class="fi-like"></i><p><?php echo $stavka -> likes; ?></p>
						</div>
						<div class="large-6 columns">
							<i class="fi-dislike"></i><p><?php echo $stavka -> dislikes; ?></p>
						</div>
					</div>
					<div class="row">
						<div class="large-6 columns">
							<i class="fi-eye"></i><p><?php echo $stavka -> pregleda; ?></p>
						</div>
						<div class="large-6 columns">
							<i class="fi-calendar"></i><p><?php echo $stavka -> datum; ?></p>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<h5>Ponuda traje:</h5>
						</div>
					</div>
					<div class="row">
						<div class="large-6 columns">
							<h5>Od:  <?php echo $stavka -> trajeod; ?></h5>
						</div>
						<div class="large-6 columns">
							<h5>Do:  <?php echo $stavka -> trajedo; ?></h5>
						</div>
					</div>
				</div>
			</div>
