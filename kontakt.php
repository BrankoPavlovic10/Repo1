<!doctype html>
<html>
<head>
	 <meta charset="UTF-8">
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <title>Peticija</title>
	 <link rel="stylesheet" href="projekat1.css">
</head>
	<body>
		<div class="header">
			<div class="column">
				<div id="logo-i-social">
					<div id="logo-holder">
						<img alt="Loading logo" src="./social/img/tree.svg">
					</div>
					
					<div id="social-holder">
					<?php
						session_start();
						if( isset($_SESSION['mejl'] ) ){
							echo'<span style="color:green;font-size:30px; ">Uspesno ste ulogovani kao '.$_SESSION['zvanje'].' !</span>';
						}
								 ?>
						<a href="#">
							<img alt="Facebook"	src="./social/img/facebook.svg">
						</a>
						<a href="#">
							<img alt="Twitter" src="./social/img/twitter.svg">
						</a>
						<a href="#">
							<img alt="Instagram" src="./social/img/instagram.svg">
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
				
				<div class="content" id="kontakt">
					<div class="petition">
                        <h1>Kontakt</h1>

                             <form class="kontakt-forma" method="POST" action="MAILTO: sacuvajmo_stabla@gmail.com">
											Kontakt osoba: Marko Milenković <br>
											Kontakt telefon:<br>
											063/345-42-56 i 011/455/76-34 <br><br>
											Takođe nas možete kontaktirati i popunjavanjem predstojećeg formulara. <br><br>
									<div class="pozicija">
										<div class="position">
										
											<label for="input-ime">Ime i prezime:</label><br>
											<input type="text" placeholder="Ime i prezime" name="ime" id="input-ime" required><br>
											
											<label for="input-email">E-mail adresa:</label><br>
											<input type="email" placeholder="E-mail adresa" name="email" id="input-email" required><br><br>
											
											<label for="i-tel">Broj telefona:</label><br><br>
											<input type="phone" placeholder="Broj telefona" name="telefon" id="i-tel" required>
											
										</div>
										<div class="message">
										
											<label for="input-poruka">Poruka:</label><br>
											<textarea rows="6" placeholder="Napišite poruku..." name="poruka" id="input-input poruka" required></textarea><br>
											
											<button type="submit">Pošalji</button>
											<button type="reset">Poništi</button>
										</div>
									</div>
                            </form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>