<?php
	include('header.php');
?>
<script>
	$(function() {
		$('.numbersOnly').keyup(function () { 
			this.value = this.value.replace(/[^0-9\.]/g,'');
		});
		
		$('.alphaonly').bind('keyup blur',function(){ 
			$(this).val( $(this).val().replace(/[^a-zA-Z ]/g,'') ); }
		);
		
		$('.alphanumeric').bind('keyup blur',function(){ 
			$(this).val( $(this).val().replace(/[^a-zA-Z 0-9\.]/g,'') ); }
		);

	});
	
</script>
		<!--[if !IE]>start content<![endif]-->
		<div id="content">
			<div class="inner">
				<!--[if !IE]>start section<![endif]-->
				<?php
					if(isset($_POST['reset'])){
						$_POST 	= "";
					}
					$notValid =false;
					if(isset($_POST['daftar'])){
						if(empty($_POST['nama'])){
							$errors[] = 'Sila masukkan nama penuh';
							$notValid =true;
						}
						if(empty($_POST['jawatan'])){
							$errors[] = 'Sila masukkan jawatan';
							$notValid =true;
						}
						if(empty($_POST['nostaff'])){
							$errors[] = 'Sila masukkan no. staff';
							$notValid =true;
						}
						if (valid_email($_POST['emel'])==FALSE){
							$errors[] = 'Sila masukkan emel yang sah';
							$notValid =true;
						}
						if(empty($_POST['noic'])){
							$errors[] = 'Sila masukkan no. kad pengenalan';
							$notValid =true;
						}else{
							$len = strlen($_POST['noic']);
							if($len < 12 || $len > 12){
								$errors[] = 'no. kad pengenalan mesti 12 huruf';
								$notValid =true;
							}
								
						}
						
						if($notValid == true){
							echo"
								<div class='section'>
									<ul class='system_messages'>
									<li class='yellow'><span class='ico'></span>
										<strong class='system_title'>Amaran!</strong>";
							while (list($key,$value) = each($errors))
							{
									echo "<br/><span class='system_title'>".$value."</span>";
							}
							echo "	</li>
									</ul>
								</div>";
						}else{
							
							$nama = strtoupper(mysql_real_escape_string($_POST['nama'])); 
							$jawatan = strtoupper(mysql_real_escape_string($_POST['jawatan'])); 
							$nostaff = strtoupper(mysql_real_escape_string($_POST['nostaff'])); 
							$emel = mysql_real_escape_string($_POST['emel']); 
							$noic = mysql_real_escape_string($_POST['noic']); 
							
							$Qnoic = "SELECT count(*) from pengguna where no_ic = '$noic'";
							$Tnoic= $db->sql_total($Qnoic);	
							
							$Qnostaff = "SELECT count(*) from pengguna where no_staff = '$nostaff'";
							$Tnostaff = $db->sql_total($Qnostaff);
							
							$Qemel = "SELECT count(*) from pengguna where emel = '$emel'";
							$Temel = $db->sql_total($Qemel);	
							
								
							
							if($Tnoic <> 0){
								echo"
										<div class='section'>
											<ul class='system_messages'>
												<li class='yellow'><span class='ico'></span><strong class='system_title'>No. kad pengenalan sudah digunakan !</strong> </li>
											</ul>
										</div>";
							}
							
							if($Tnostaff <> 0){
								echo"
										<div class='section'>
											<ul class='system_messages'>
												<li class='yellow'><span class='ico'></span><strong class='system_title'>No. staff sudah digunakan !</strong> </li>
											</ul>
										</div>";
							}
							if($Temel <> 0){
								echo"
										<div class='section'>
											<ul class='system_messages'>
												<li class='yellow'><span class='ico'></span><strong class='system_title'>Emel sudah digunakan !</strong> </li>
											</ul>
										</div>";
							}
							
							if($Temel==0 && $Tnoic==0 && $Tnostaff==0){
								$password=PASSWORD_PENGGUNA_SEMENTARA;
								$createUser= "INSERT INTO pengguna(no_ic, password, nama, jawatan, no_staff,emel,tarikh_daftar, peranan_id) VALUES 
								('$noic',PASSWORD('$password'), '$nama','$jawatan', '$nostaff','$emel',NOW(),'2')";
								$result = $db->sql_query($createUser);
								
								if ($result){	
									
									include ('../phpmailer/class.phpmailer.php');
									include ('../phpmailer/class.smtp.php');
									include ('../phpmailer/phpmailer.lang-en.php');

									date_default_timezone_set('Asia/Singapore');
									$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
									$mail->IsSMTP(); // telling the class to use SMTP
									try{
										$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
										$mail->SMTPAuth   = true;                  // enable SMTP authentication
										$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
										$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
										$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
										$mail->Username   = "kppptnb@gmail.com";  // GMAIL username
										$mail->Password   = "asdfg123";            // GMAIL password
										
										//$mail->Host       = "mail.powergoat2u.com.my";      // sets GMAIL as the SMTP server
										//$mail->Port       = 25;                   // set the SMTP port for the GMAIL server
										//$mail->Username   = "powergoa";  // GMAIL username
										//$mail->Password   = "8RU5EmGs";            // GMAIL password
						  
										$mail->SetFrom(INFOEMAIL, NAMEEMAIL);
										$mail->AddAddress("$emel", "$nama");

										$mail->Subject    = "Pendaftaran Pegawai Aset";

										$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
										$mail->Body ="
														<html>
														<body>
														<table width=500 cellpadding=3>
															<tr>
																<td>
																	Kepada ".$nama.",
																</td>
															</tr>
															<tr>
																<td>
																	<br>
																	<a style='font-size:13px; font-weight:bold;' href='".ROOTURL."/spas/index.php'>Log Masuk<a>
																</td>
															</tr>
															<tr>
																<td>
																	<br>
																	Sila klik link diatas untuk membolehkan anda log masuk.
																</td>
															</tr>
															<tr>
																<td>
																	<br>
																	No. Kad Pengenalan:  ".$noic."
																</td>
															</tr>
															<tr>
																<td>
																	<br>
																	Kata Laluan:  ".$password."
																</td>
															</tr>
															<tr>
																<td>
																	<br>
																	Sila Log Masuk untuk menukar password anda dengan secepat mungkin. 
																</td>
															</tr>
														<table>
														</body>
														</html>";
										//$mail->AddAttachment("images/phpmailer.gif");             // attachment
										$mail->Send();
									} catch (phpmailerException $e) {
										echo"
										<div class='section'>
											<ul class='system_messages'>
												<li class='red'><span class='ico'></span><strong class='system_title'>Auto Email Error : ".$e->errorMessage()." </strong> </li>
											</ul>
										</div>";
									  //echo $e->errorMessage(); //Pretty error messages from PHPMailer
									} catch (Exception $e) {
										echo"
										<div class='section'>
											<ul class='system_messages'>
												<li class='red'><span class='ico'></span><strong class='system_title'>Auto Email Error : ".$e->errorMessage()." </strong> </li>
											</ul>
										</div>";
									}
									
									//	Display success																			
									echo'
									<div class="section">
										<ul class="system_messages">
											<li class="green"><span class="ico"></span><strong class="system_title">Pegawai aset berjaya disimpan !</strong></li>
										</ul>
									</div>
										';
								}
							}
							
						}
					
					}
				
				?>
				<!--[if !IE]>end section<![endif]-->
				
				<!--[if !IE]>start section<![endif]-->
				<div class="section">
					
					<!--[if !IE]>start title wrapper<![endif]-->
					<div class="title_wrapper">
						<span class="title_wrapper_top"></span>
						<div class="title_wrapper_inner">
							<span class="title_wrapper_middle"></span>
							<div class="title_wrapper_content">
								<h2>Daftar Pegawai Aset</h2>
							</div>
						</div>
						<span class="title_wrapper_bottom"></span>
					</div>
					<!--[if !IE]>end title wrapper<![endif]-->
					
					<!--[if !IE]>start section content<![endif]-->
					<div class="section_content">
						<span class="section_content_top"></span>
						
						<div class="section_content_inner">
						
						
						<!--[if !IE]>start forms<![endif]-->

						<form action="" method="POST" class="search_form general_form">
							<!--[if !IE]>start fieldset<![endif]-->
							<fieldset>
								<!--[if !IE]>start forms<![endif]-->
								<div class="forms">
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Nama Penuh:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="nama" maxlength="35"  class="text alphaonly" value="<?php if(isset($_POST['nama'])) echo $_POST['nama'] ?>" type="text" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Jawatan:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="jawatan" maxlength="25"  class="text alphanumeric" value="<?php if(isset($_POST['jawatan']))  echo $_POST['jawatan'] ?>" type="text" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>No. Staff:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="nostaff" maxlength="10" class="text alphanumeric" value="<?php if(isset($_POST['nostaff']))  echo $_POST['nostaff'] ?>" type="text"  /></span>
										</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Emel:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="emel"  class="text" value="<?php if(isset($_POST['emel']))  echo $_POST['emel'] ?>" type="text"  /></span>
										
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>No. Kad Pengenalan:</label>
									<div class="inputs" >
										<span class="input_wrapper"><input name="noic" maxlength="12" class="text numbersOnly" value="<?php if(isset($_POST['noic']))  echo $_POST['noic'] ?>" type="text"  /></span>
										<span class="system infotip">Tanpa sengkang, cth: 680505026971</span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<div class="inputs">
										<span class="button green_button"><span><span>DAFTAR</span></span><input name="daftar" type="submit" /></span>
										<span class="button gray_button"><span><span>RESET</span></span><a href="aPegawaiDaftar.php" ><input name="reset" type="submit" /></a></span> 
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								
								
								</div>
								<!--[if !IE]>end forms<![endif]-->
								
								</fieldset>
							<!--[if !IE]>end fieldset<![endif]-->
						</form>
						
						<!--[if !IE]>end forms<![endif]-->
						
						</div>
						
						<span class="section_content_bottom"></span>
					</div>
					<!--[if !IE]>end section content<![endif]-->
				</div>
				<!--[if !IE]>end section<![endif]-->
				
				
				
				
				
				
					
				
			</div>
		</div>
		<!--[if !IE]>end content<![endif]-->

<?php
	include('footer.php');
?>