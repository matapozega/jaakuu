
		<div class="row">
			<div class="large-4 columns">
				<div class="item-wrapper">
					<a href="#"><h3><?php
					echo video_title('E2PglxuFtUg');
					function video_title($id) {
						$content = file_get_contents("http://youtube.com/get_video_info?video_id=" . $id);
						parse_str($content, $output);
						return $output['title'];
					}
					?></h3>
					</a>
					<a class="button expand"><?php echo $stavka->vise; ?></a>
					<a class="button expand"><?php echo $stavka->manje; ?></a>
					<div class="row">
						<div class="large-12 columns">
							<h5><?php echo $stavka->naziv; ?></h5>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<p>
								<?php echo $stavka->opis; ?>
							</p>
						</div>
					</div>
					<div class="row">
						<div class="large-6 columns">
							<p>Pogledii: <?php echo $stavka->pregleda; ?></p>
						</div>
						<div class="large-6 columns">
							<p>Like-ovi: <?php echo $stavka->likes; ?></p>
						</div>
					</div>
					<div class="row">
						<div class="large-6 columns">
							<p>Dislike-ovi:<?php echo $stavka->dislikes; ?></p>
						</div>
						<div class="large-6 columns">
							<p>Published:<?php echo $stavka->datum; ?></p>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<h5>Ponuda traje:</h5>
						</div>
					</div>
					<div class="row">
						<div class="large-6 columns">
							<h5>Od:<?php echo $stavka->trajeod; ?></h5>
						</div>
						<div class="large-6 columns">
							<h5>Do:<?php echo $stavka->trajedo; ?></h5>
						</div>
					</div>
				</div>
			</div>
		</div>