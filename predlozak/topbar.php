<div class="top-bar stacked-for-medium" data-topbar role="navigation">
	<div class="top-bar-title">
	<span data-responsive-toggle="responsive-menu" data-hide-for="medium">
      <button class="menu-icon dark" type="button" data-toggle></button>
    </span>
     <strong><?php echo $naslov; ?></strong>
     </div>
    <div id="responsive-menu">
	<div class="top-bar-left">
		<ul class="menu">
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
				<a href="<?php echo $putanjaAPP; ?>contact.php">Contact</a>
			</li>
		</ul>
	</div>
	<div class="top-bar-right">
		<ul class="dropdown menu" data-dropdown-menu>
			
			<?php
			 if(isset($_SESSION[$sid . "autoriziran"])):
				if (stripos($_SERVER['REQUEST_URI'], 'privatno/index.php')):
			?>
				
				<li>
					<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="GET">
						<input id="uvjet" value="<?php echo str_replace("%","", $uvjet); ?>" class="search-field" type="text" name="uvjet" placeholder="Search" />
					</form>
				</li>
				<?php endif; ?>
			<li>
				<a href="<?php echo $putanjaAPP; ?>privatno/profil.php?sifra=<?php echo $_SESSION[$sid . "autoriziran"]->sifra; ?>">
				<img src="<?php echo $putanjaAPP; ?>img/<?php
					if (file_exists($putanjaIMG . $_SESSION[$sid . "autoriziran"] -> oib . ".jpg")) {
						echo $_SESSION[$sid . "autoriziran"] -> oib;
					} else {
						echo "Unknown-person";
					}
				 ?>.jpg" alt="" />
				<?php echo $_SESSION[$sid . "autoriziran"]->ime ?></a>
				
			</li>
			<li>
				<a href="#">Unos</a>
				<ul class="menu vertical">
					<li>
						<a href="<?php echo $putanjaAPP; ?>privatno/dodaj/tip/index.php">Tip ponude</a>
					</li>
					<li>
						<a href="<?php echo $putanjaAPP; ?>privatno/dodaj/video/index.php">Video</a>
					</li>
					<li>
						<a href="<?php echo $putanjaAPP; ?>privatno/dodaj/ponuda/index.php">Ponuda</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="<?php echo $putanjaAPP; ?>privatno/dashboard.php">Kontrolna ploča</a>
			</li>
			<li>
				<a href="<?php echo $putanjaAPP; ?>privatno/statistika.php">Statistika</a>
			</li>
			<li>
				<a href="<?php echo $putanjaAPP; ?>privatno/era.php">ERA</a>
			</li>
				<?php endif; ?>
			<li>
				<?php if(isset($_SESSION[$sid . "autoriziran"])):
				?>
				<a href="<?php echo $putanjaAPP; ?>logout.php">Odjavi se</a>
			</li>
			<?php else: 
				if (!stripos($_SERVER['REQUEST_URI'], 'register')):
				?>
				<a  data-open="myModal"  href="#">Prijavi se</a>
			<?php endif; endif; ?>
		</ul>
	</div>
</div>
</div>