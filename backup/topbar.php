<div class="top-bar">
	<div class="top-bar-left">
		<ul class="menu">
			<li class="menu-text">
				<?php echo $naslov; ?>
			</li>
			<li>
				<?php if(isset($_SESSION[$sid . "autoriziran"])):
				?>
				<a href="<?php echo $putanjaAPP; ?>privatno/index.php">Početna</a>
			</li>
			<?php else: ?>
			<a href="<?php echo $putanjaAPP; ?>index.php">Početna</a></li>
			<?php endif; ?>
			<li>
				<a href="<?php echo $putanjaAPP; ?>about.php">O nama</a>
			</li>
			<li>
				<a href="<?php echo $putanjaAPP; ?>contact.php">Kontakt</a>
			</li>
		</ul>
	</div>
	<div class="top-bar-right">
		<ul class="menu">
			<?php if(isset($_SESSION[$sid . "autoriziran"])):
			?>
			
			<li>
				<a href="#">
				<img src="../img/<?php 				
				if(file_exists("../img/" . $_SESSION[$sid . "autoriziran"]->oib . ".jpg")){
					echo $_SESSION[$sid . "autoriziran"]->oib;
				}else{
					echo "unknown-person";
				} ?>.jpg" alt="" />
				<?php echo $_SESSION[$sid . "autoriziran"]->ime ?></a>
			</li>
			<li>
				<a href="<?php echo $putanjaAPP; ?>privatno/dashboard.php">Kontrolna ploča</a>
			</li>
			<li>
				<a href="<?php echo $putanjaAPP; ?>privatno/statistika.php">Statistika</a>
			</li>
			
			<?php endif; ?>
			<li>
				<?php if(isset($_SESSION[$sid . "autoriziran"])):
				?>
				<a href="<?php echo $putanjaAPP; ?>logout.php">Odjavi se</a>
			</li>
			<?php else: ?>
				<a  data-open="myModal"  href="#">Prijavi se</a>
			<?php endif; ?>
		</ul>
	</div>
</div>