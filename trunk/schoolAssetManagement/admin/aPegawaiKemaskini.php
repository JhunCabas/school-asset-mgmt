<?php
	include('header.php');
?>
<script>
	$(function() {
		
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
					$emel = "";
					$noic = "";
					$IdPengguna ="";
					if(isset($_POST['resetkatalaluan'])){
						$IdPengguna = mysql_real_escape_string($_POST['IdPengguna']);
						$emel = mysql_real_escape_string($_POST['emel']); 
						$nama = strtoupper(mysql_real_escape_string($_POST['nama'])); 
						$noic = mysql_real_escape_string($_POST['noic']);
						$password=PASSWORD_PENGGUNA_SEMENTARA;
						$updatePassUser= "UPDATE  pengguna set password=PASSWORD('$password')  WHERE id = '$IdPengguna '";
						$resultPass = $db->sql_query($updatePassUser);
						if ($resultPass){	
							
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

								$mail->Subject    = "Reset Kata Laluan Pegawai Aset";

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
									<li class="green"><span class="ico"></span><strong class="system_title">Kata laluan pegawai sudah diresetkan!</strong></li>
								</ul>
							</div>
								';
						}
					}
					if(isset($_POST['kemaskini'])){
						$emel = mysql_real_escape_string($_POST['emel']); 
						$noic = mysql_real_escape_string($_POST['noic']);
						$IdPengguna = mysql_real_escape_string($_POST['IdPengguna']);
						$notvalid = false;
						if(empty($_POST['nama'])){
							$errors[] = 'Sila masukkan nama penuh';
							$notvalid = true;
						}
						if(empty($_POST['jawatan'])){
							$errors[] = 'Sila masukkan jawatan';
							$notvalid = true;
						}
						
						if($notvalid == true){
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
							
							$updateUser= "UPDATE  pengguna set nama='$nama' , jawatan = '$jawatan' WHERE id = '$IdPengguna'";
							$result = $db->sql_query($updateUser);
							
							if ($result){	
							
								//	Display success																			
								echo'
								<div class="section">
									<ul class="system_messages">
										<li class="green"><span class="ico"></span><strong class="system_title">Pegawai aset berjaya dikemaskinikan !</strong></li>
									</ul>
								</div>
									';
							}
							
							
						}
					
					}
					$id = mysql_real_escape_string($_GET['id']); 
					/* Get data. */
					$qPengguna= "select * from pengguna where id = '$id'  ";
					$rPegawai = $db->sql_list($qPengguna);
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
								<h2>Kemaskini Pegawai Aset</h2>
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
										<span class="input_wrapper"><input name="nama" maxlength="35" class="text alphaonly" value="<?php echo $rPegawai['nama']; ?>" type="text" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Jawatan:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="jawatan"  maxlength="25" class="text alphanumeric" value="<?php echo $rPegawai['jawatan']; ?>" type="text" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>No. Staff:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none;"><input readonly name="nostaff"  class="text alphanumeric" value="<?php echo $rPegawai['no_staff']; ?>" type="text"  /></span>
										</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Emel:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none;"><input readonly name="emel"  class="text" value="<?php echo $rPegawai['emel']; ?>" type="text"  /></span>
										
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>No. Kad Pengenalan:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none;"><input readonly name="noic" class="text" value="<?php echo $rPegawai['no_ic']; ?>" type="text"  /></span>
										
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<div class="inputs">
										<input name="IdPengguna"  class="text" value="<?php  echo $rPegawai['id']; ?>" type="hidden"  />
										<span class="button green_button"><span><span>KEMASKINI</span></span><input name="kemaskini" type="submit" /></span>
										<span class="button gray_button"><span><span>RESET KATA LALUAN</span></span><input name="resetkatalaluan" type="submit" /></span> 
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