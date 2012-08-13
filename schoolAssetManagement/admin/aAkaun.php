<?php
	include('header.php');
?>
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
						$password=PASSWORD_PENGGUNA_SEMENTARA;
						$updatePassUser= "UPDATE  pengguna set password=PASSWORD('$password')  WHERE id = '$IdPengguna'";
						$resultPass = $db->sql_query($updatePassUser);
						if ($resultPass){	
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
								<h2>Akaun Saya</h2>
								<ul class="section_menu left">
									<li><a href="aAkaun.php?id=<?php echo $_SESSION['userlogin_id']; ?>"  class="selected_lk"><span class="l"><span></span></span><span class="m"><em>Kemaskini Akaun</em><span></span></span><span class="r"><span></span></span></a></li>
									<li><a href="aAkaunTukarPass.php?id=<?php echo $_SESSION['userlogin_id']; ?>" ><span class="l"><span></span></span><span class="m"><em>Reset Kata Laluan</em><span></span></span><span class="r"><span></span></span></a></li>
								</ul>
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
										<span class="input_wrapper"><input name="nama" class="text" value="<?php echo $rPegawai['nama']; ?>" type="text" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Jawatan:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="jawatan"  class="text" value="<?php echo $rPegawai['jawatan']; ?>" type="text" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>No. Staff:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none;"><input readonly name="nostaff"  class="text" value="<?php echo $rPegawai['no_staff']; ?>" type="text"  /></span>
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
										<input name="IdPengguna"  class="text" value="<?php echo $_SESSION['userlogin_id']; ?>" type="hidden"  />
										<span class="button green_button"><span><span>KEMASKINI</span></span><input name="kemaskini" type="submit" /></span>
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