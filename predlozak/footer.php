
<footer class="footer">
  <div class="row">
    <div class="small-12 columns">
      <p class="slogan">It is time to have a permanent income</p>
      <p class="links">
      	<?php if(isset($_SESSION[$sid . "autoriziran"])):
				?>
        <a href="<?php echo $putanjaAPP; ?>privatno/index.php">Početna</a>
        <?php else:  ?>
        	<a href="<?php echo $putanjaAPP; ?>index.php">Početna</a>
        	<?php endif; ?>
        <a href="<?php echo $putanjaAPP; ?>about.php">O nama</a>
        <a href="<?php echo $putanjaAPP; ?>contact.php">Kontakt</a>
        <?php if(isset($_SESSION[$sid . "autoriziran"]) && isAdmin()): 
				?>
        <a href="<?php echo $putanjaAPP; ?>privatno/dashboard.php">Kontrolna ploča</a>
        <a href="<?php echo $putanjaAPP; ?>privatno/statistika.php">Statistika</a>
        <?php endif; ?>
      </p>
      <p class="copywrite">Edunova © 2017</p>
    </div>
  </div>
</footer>