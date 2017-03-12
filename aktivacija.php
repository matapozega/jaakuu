<?php include_once 'konfig.php'; 
include_once 'predlozak/inputpolja.php';
$poruke=array();
if(isset($_POST["aktivacija"])){
	include_once 'kontrolaaktivacija.php';
	if(count($poruke)==0){
		unset($_POST["aktivacija"]);
		$izraz=$veza->prepare("select sifra from korisnik where email=:email and oib=:oib and lozinka=:lozinka");
		$izraz->execute(array("email"=>$_POST["email"], "oib"=>$_POST["oib"], "lozinka"=>md5($_POST["lozinka"])));
		$sifra=$izraz -> fetchColumn();
		
		$izraz=$veza->prepare("update korisnik set aktivan=1 where sifra=:sifra");
		$izraz->execute(array("sifra"=>$sifra));
		
		header("location: login.php");


	}
}


 ?>


<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
	<?php include_once 'predlozak/head.php'; ?>
	</head>
	<body>
	<?php include_once 'predlozak/topbar.php';  ?>
<div class="row">
  <div class="medium-6 medium-centered large-6 large-centered columns">

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>" >
      <div class="row column log-in-form">
        <h4 class="text-center">Račun je deaktiviran, ukoliko želite ponovno aktivirati raučun upišite sljedeće!</h4>
        <label>
          <?php   inputPolje("email","email", "E-mail", $poruke);?>
        </label>
        <label>
         <?php  inputPolje("password","lozinka", "Lozinka", $poruke);?>
        </label>
        <label>
          <?php  inputPolje("text","oib", "OIB", $poruke);?>
        </label>
        <input type="submit" name="aktivacija" class="button expanded" value="Aktiviraj!" />
      </div>
     	
    </form>
    </div>
   </div>

	<?php include_once 'predlozak/footer.php'; ?>
	<?php include_once 'predlozak/skripte.php';  ?>
	</body>
</html>	