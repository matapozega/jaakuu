<?php
include_once 'konfig.php';
  ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once 'predlozak/head.php';
		?>
	</head>
	<body>
		<?php
		include_once 'predlozak/topbar.php';
		?>
		<div class="row" style="margin-bottom: 2%; margin-top: 1%;">

			<div id="contactForm" class="small-8 medium-8 large-8 columns">
				<form id="myForm" method="post" data-abide>

					<h5>Kontaktiraj nas</h5>
					<label>Ime i prezime</label>
					<input type="text" placeholder="Ime i prezime" required>

					<label>Email</label>
					<input type="email" placeholder="username@address.com" required>
					
					<label>Poruka</label>
					<textarea rows="3" placeholder="Napiši svoju poruku" required></textarea>										
          
 <input type="submit" class="nice blue radius button" value="Pošalji">
					</button></a>
				</form>
			</div><!--end 8 columns-->
			<div class="large-4 columns">
					<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d2793.8853563805096!2d18.716517787495945!3d45.552631726291175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1shr!2shr!4v1480354143071" 
					width="450" height="450" 
					frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
		</div>
		
		
				<?php
		include_once 'predlozak/popupprijava.php';
		?>
			<?php include_once 'predlozak/footer.php';
			?>
			
			<?php
			include_once 'predlozak/skripte.php';
			?>

			<script>
				$(document).foundation();
			</script>
			<script>
				$('#myForm').on('invalid', function() {
					var invalid_fields = $(this).find('[data-invalid]');
					console.log(invalid_fields);
				}).on('valid', function() {
					console.log('valid!');
				});
			</script>
	</body>
</html>
