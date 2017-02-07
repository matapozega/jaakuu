
		
			<div class="large-6 columns end">
				<div style="text-align: center;" class="item-wrapper">
					<a href="https://www.youtube.com/watch?v=<?php echo $stavka -> videoid; ?>"><h3>Ime videa</h3>
					</a>
					<p style="min-height: 50px"><a  href="https://www.youtube.com/watch?v=<?php echo $stavka -> videoid; ?>"  target="_blank">https://www.youtube.com/watch?v=<?php echo $stavka -> videoid; ?></a></p>
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
						  <a class="button expand"><?php echo $stavka -> vise; ?></a> 
						</div>
						<div class="large-6 columns">
						  <a class="button success expand"><?php echo $stavka -> manje; ?></a>
						</div>
					</div>			
					<div class="row">
						<div class="large-12 columns">
							<h5><?php echo $stavka -> naziv; ?></h5>
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
							<p>Pogledi: <?php echo $stavka -> pregleda; ?></p>
						</div>
						<div class="large-6 columns">
							<p>Like-ovi: <?php echo $stavka -> likes; ?></p>
						</div>
					</div>
					<div class="row">
						<div class="large-6 columns">
							<p>Dislike-ovi:<?php echo $stavka -> dislikes; ?></p>
						</div>
						<div class="large-6 columns">
							<p>Published:<?php echo $stavka -> datum; ?></p>
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
