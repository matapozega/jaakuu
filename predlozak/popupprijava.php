

<div id="myModal" class="reveal" data-reveal>
	<div class="row">
		<div class="large-6 columns auth-plain">
			<div class="signup-panel left-solid">
				<p class="welcome">
					Postojeći si korisnik?
				</p>
				<form method="post" action="autorizacija.php">
					<div class="row collapse">
						<div class="small-2  columns">
							<span class="prefix"><i class="fi-torso-female"></i></span>
						</div>
						<div class="small-10  columns">
							<input type="text" required="required" name="korisnik" placeholder="somebody@example.com" value="<?php echo isset($_GET["korisnik"]) ? $_GET["korisnik"] : "" ?>">
						</div>
					</div>
					<div class="row collapse">
						<div class="small-2 columns ">
							<span class="prefix"><i class="fi-lock"></i></span>
						</div>
						<div class="small-10 columns ">
							<input type="password" required="required" name="lozinka" placeholder="Password">
						</div>
					</div>

					<input type="submit" name="autorizacija" class="button" value="Prijavi se" />
				</form>
			</div>
		</div>

		<div class="large-6 columns auth-plain">
			<div class="signup-panel newusers">
				<p class="welcome">
					Još nemaš račun?
				</p>
				<p>
					Registriraj se i kreni sa klađenjem na Youtube videe!
				</p>
				<br>
				<a type="button" class="button button1" href="register.php" />Registriraj  se</a>
			</div>
		</div>

	</div>
	<button class="close-button" data-close aria-label="Close modal" type="button">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
	