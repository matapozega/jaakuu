<?php include_once 'konfig.php';  ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
	<?php include_once 'predlozak/head.php'; ?>
	</head>
	<body>
	<?php include_once 'predlozak/topbar.php';  ?>
<div class="row">
  <div class="medium-6 medium-centered large-6 large-centered columns">

    <form method="post" action="autorizacija.php" >
      <div class="row column log-in-form">
        <h4 class="text-center">Prijavi se sa korisničkim imenom!</h4>
        <label>Korisničko ime
          <input type="text" required="required" name="korisnik" placeholder="somebody@example.com" value="<?php echo isset($_GET["korisnik"]) ? $_GET["korisnik"] : "" ?>">
        </label>
        <label>Lozinka
          <input type="password" required="required" name="lozinka" placeholder="Password">
        </label>
        <input type="submit" name="autorizacija" class="button expanded" value="Prijavi se!" />
      </div>
     	
    </form>
        <?php
    if (isset($_GET["korisnik"])):
    ?>
    <div class="alert callout">
    	Neispravno korisničko ime ili lozinka!
    </div>
    <?php
	endif;
    ?>
    </div>
   </div>

	<?php include_once 'predlozak/footer.php'; ?>
	<?php include_once 'predlozak/skripte.php';  ?>
	</body>
</html>
