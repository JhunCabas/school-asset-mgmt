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
					if(isset($_POST['kemaskini'])){
						$IdPengguna = mysql_real_escape_string($_POST['IdPengguna']);
						$notvalid = false;
						if(empty($_POST['oldpassword'])){
							$errors[] = 'Sila masukkan kata laluan digunakan';
							$notvalid = true;
						}
						if(empty($_POST['newpassword'])){
							$errors[] = 'Sila masukkan kata laluan baru';
							$notvalid = true;
						}else{
							if($_POST['newpassword'] != $_POST['newpasswordR']){
							$errors[] = 'Kata laluan baru dengan ulangan kata laluan baru tidak sama';
							$notvalid = true;
							}
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
							$oldpassword = mysql_real_escape_string($_POST['oldpassword']);
						    $sql = "SELECT count(*) from pengguna where id = '$IdPengguna' and password=PASSWORD('$oldpassword') ";
							$check= $db->sql_total($sql);	
							
							if($check == 0){
								echo"
										<div class='section'>
											<ul class='system_messages'>
												<li class='yellow'><span class='ico'></span><strong class='system_title'>Kata laluan digunakan salah !</strong> </li>
											</ul>
										</div>";
							}else{

								$newpassword = mysql_real_escape_string($_POST['newpassword']);
								//$password=PASSWORD_PENGGUNA_SEMENTARA;
								$updatePassUser= "UPDATE  pengguna set password=PASSWORD('$newpassword')  WHERE id = '$IdPengguna'";
								$resultPass = $db->sql_query($updatePassUser);
								if ($resultPass){	
									//	Display success																			
									echo'
									<div class="section">
										<ul class="system_messages">
											<li class="green"><span class="ico"></span><strong class="system_title">Kata laluan anda sudah diresetkan!</strong></li>
										</ul>
									</div>
										';
								}
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
									<li><a href="aAkaun.php?id=<?php echo $_SESSION['userlogin_id']; ?>"  ><span class="l"><span></span></span><span class="m"><em>Kemaskini Akaun</em><span></span></span><span class="r"><span></span></span></a></li>
									<li><a href="aAkaunTukarPass.php?id=<?php echo $_SESSION['userlogin_id']; ?>"  class="selected_lk" ><span class="l"><span></span></span><span class="m"><em>Reset Kata Laluan</em><span></span></span><span class="r"><span></span></span></a></li>
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
									<label>Kata Laluan Digunakan:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="oldpassword" class="text" value="<?php   if(isset($_POST['oldpassword'])) echo $_POST['oldpassword']; ?>" type="text" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Kata Laluan Baru:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="newpassword"  class="text" value="<?php  if(isset($_POST['newpassword'])) echo $_POST['newpassword']; ?>" type="text" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Ulangan Kata Laluan Baru:</label>
									<div class="inputs">
										<span class="input_wrapper" ><input  name="newpasswordR"  class="text" value="<?php  if(isset($_POST['newpasswordR'])) echo $_POST['newpasswordR']; ?>" type="text"  /></span>
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