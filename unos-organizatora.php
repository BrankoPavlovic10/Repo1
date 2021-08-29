<!doctype html>
<html>
<head>
	 <meta charset="UTF-8">
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <title>Peticija</title>
	 <link rel="stylesheet" href="projekat1.css">
	 <link rel="stylesheet" href="novi.css">
</head>
	<body>
		<div class="header">
			<div class="column">
				<div id="logo-i-social">
					<div id="logo-holder">
						<img alt="Loading logo" src="social/img/tree.svg">
					</div>
					
					<div id="social-holder">
					<?php
						session_start();
						if( isset($_SESSION['mejl'] ) ){
							echo'<span style="color:green;font-size:30px; ">Uspesno ste ulogovani kao '.$_SESSION['zvanje'].' !</span>';
						}
								 ?>
						<a href="#">
							<img alt="Facebook"	src="social/img/facebook.svg">
						</a>
						<a href="#">
							<img alt="Twitter" src="social/img/twitter.svg">
						</a>
						<a href="#">
							<img alt="Instagram" src="social/img/instagram.svg">
						</a>


					</div>
				</div>
				
				<nav id="main-menu">
					<ul>
						<li><a href="naslovna.php">Naslovna</a></li>
						<li><a href="naslovna.php">Peticija</a></li>
						<li><a href="vesti.php">Vesti</a></li>
						<li><a href="potpisi.php">Potpisi</a></li>
						<li><a href="potpishi.php">Potpiši</a></li>
					
						<li>
							<a href="#organizacija">Organizacija</a>
							<ul>
								<li><a href="uloguj-se.php">Uloguj se</a></li>
								<li><a href="registracija.php">Registracija</a></li>
								<?php
								if( isset($_SESSION['mejl'])  ){
									echo '
								<li><a href="lokacije.php">Lokacije</a></li>
								<li><a href="organizatori.php" class="active">Organizatori</a></li>
								<li><a href="kompletni-potpisi.php">Kompletni potpisi</a></li>
								<li><a href="php/logout.php">Izloguj se</a></li>';
								}
								?>
							</ul> 
						</li>

						<?php
						if(isset($_SESSION['mejl'])  ){
						echo '<li>
							<a href="#unos">Unos</a>
							<ul>
								<li><a href="unos-vesti.php">Unos vesti</a></li>
								<li><a href="unos-organizatora.php">Unos organizatora</a></li>
								<li><a href="unos-lokacije.php">Unos lokacije</a></li>
							</ul> 
						</li>';
						}
						?>
						<li><a href="kontakt.php">Kontakt</a></li>
					</ul>
				</nav>
			</div>
		</div>
		<div class="page">
			<div class="column">
				<div class="comment">
				<?php

                     require 'php/vezaSaBazom.php';
                     $sql="SELECT * FROM potpisnici;";

					$rezultat=mysqli_query($conn,$sql);
                    $provera=mysqli_num_rows($rezultat);

                    if($provera > 0){
	                       echo "<p style='color:black;'>Imena potpisnika koji su dali dozvolu za objavu potpisa i njihovi komentari:   </p>";
	                       while($red=mysqli_fetch_assoc($rezultat)  ){
					                 echo "<p style=';color:black;text-align:center;'>".$red['komentar'];
				                       }
	                         }
                  ?>

				</div>
				
				<div class="content" id="potpishi">
					<div class="petition">
						<h1>Unos organizatora</h1>
						<?php
                              if(isset($_GET['error'])  ){//provera koja sledi nakon sto se vratimo na ovu stranicu
	                                if($_GET['error'] == "mail" ){
										echo "<p style='text-align:center;font-size:30px;'>Niste uneli validan mejl,ponovo se ulogujte.</p>";
	                                    }elseif($_GET['error'] == "razliciteLozinke"  ) {
											echo "<p style='text-align:center;font-size:30px;'>Uneli ste razlicite lozinke, molim Vas ponovo pokusajte!</p>";
										}elseif($_GET['error'] == "dupliMejl"  ) {
											echo "<p style='text-align:center;font-size:30px;'>Vec postoji uneti mejl,unesite novi mejl.</p>";
										}elseif($_GET['error'] == "uspesnoLogovanje") {//znaci da smo uspeli
											echo "<p style='text-align:center;font-size:30px;'>Uspesno ste registrovali organizatora!</p>";
										}

									}


						?>
						<div class="pozicija">

							<div class="position">
								<form method="post" action="php/organizatori-formular.php">

									<label for="input-ime">Ime:</label><br> 
									<input type="text" placeholder="Ime" name="org-ime" id="input-ime" required><br><br>

									<label for="input-ime">Prezime:</label><br> 
									<input type="text" placeholder="Prezime" name="org-prezime"  required><br><br>
									
									<label for="i-tel">Broj telefona:</label><br>
									<input type="phone" placeholder="Broj telefona" name="org-telefon" id="i-tel" required><br><br><br>
									
									<label for="input-predlagac">ID organizatora predlagača:</label><br>
									<input type="text" name="org-predlagac" colums="5" required><br><br>


								<div style="height:100px;width:200px;background-color:whitesmoke; text-align:left; padding-left:85px;overflow:auto;margin-left:90px; ">
									<?php                  
									    
									   echo "ID  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp   Ime organizatora <br>";
                                       include_once 'php/vezaSaBazom.php';
						               $sql="SELECT * FROM orgadmin ;";

						               $rezultat=mysqli_query($conn,$sql);
						               $provera=mysqli_num_rows($rezultat);

						               if($provera > 0){
										
							            while($row=mysqli_fetch_assoc($rezultat) ){								
											echo  $row['IDorg']."&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp  "; echo $row['orgIme']." "; echo $row['orgPrezime']."<br>"; 
																	
						             	}

					            	 } 
									?>
									</div>
						
							</div>
							<div class="message">
							  						

							        <label>Kako zelite da budete ulogavani?</label> <br>
									<div class="main-div">
										<div class="div-input">
											<input class="radio-btn" type="radio" value="organizator" name="admini">
											<input class="radio-btn" type="radio" value="admin" name="admini">
										</div>
										<div>
											<label for="male">Organizator</label> 
											<label for="female">Admin</label>  
										</div>
									</div>
									<br>

								    <label for="input-ime">Broj licne karte:</label><br> 
								    <input type="text" placeholder="Broj licne karte" name="org-licnaKarta"  required><br><br>
								
									<label for="input-email">E-mail adresa:</label><br>
									<input type="text" placeholder="e-mail adresa" name="org-email" required ><br><br>
								
									<label for="input-sifra">Šifra:</label><br>
									<input type="password" name="org-sifra" id="input-sifra" required > <br><br>

									<label for="input-sifra">Ponovite šifru:</label><br>
									<input type="password" placeholder="Unesite lozinku" name="org-OpetSifra"  required > <br><br>
								
									<button type="submit" name="unesi-org">Unesi</button>	
									<button type="reset">Poništi</button>	



							
							</div>
						
								</form>

						</div>	

						<div style="color:whitesmoke;text-align:center;font-size:30px">
						
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<script>
				// timer 5 sekundi
		var timeoutInMiliseconds = 5000;
		var timeoutId; 

		function startTimer() { 
			timeoutId = window.setTimeout(doInactive, timeoutInMiliseconds);
		}

		function resetTimer() { 
			window.clearTimeout(timeoutId);
			startTimer();
		}

		function doInactive() {
			alert("Proslo je " + timeoutInMiliseconds/1000 + " sekundi !");
		}

		function setupTimers () {
			document.addEventListener("mousemove", resetTimer, false);
			document.addEventListener("mousedown", resetTimer, false);
			document.addEventListener("keypress", resetTimer, false);
			document.addEventListener("keydown", resetTimer, false);
			document.addEventListener("scroll", resetTimer, false);
			document.addEventListener("touchmove", resetTimer, false);
				
			startTimer();
		}

		setupTimers();
	</script>
	</body>
</html>