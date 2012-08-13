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
	});
	
</script>
		<!--[if !IE]>start content<![endif]-->
		<div id="content">
			<div class="inner">
				
				<!--[if !IE]>start section<![endif]-->
				<?php
					if(isset($_POST['reset'])){
						$_POST['kategori'] 		= "";
						$_POST['subkategori'] 		= "";
						$_POST['kod'] 		= "";
					}
					if(isset($_POST['daftar'])){
						$notvalid = false;
						if(empty($_POST['kategori'])){
							$errors[] = 'Sila pilih kategori';
							$notvalid = true;
						}
						if(empty($_POST['subkategori'])){
							$errors[] = 'Sila masukkann sub kategori';
							$notvalid = true;
						}
						if(empty($_POST['kod'])){
							$errors[] = 'Sila masukkan kod';
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
							$kategori = strtoupper(mysql_real_escape_string($_POST['kategori'])); 
							$subkategori = strtoupper(mysql_real_escape_string($_POST['subkategori'])); 
							$kod = strtoupper(mysql_real_escape_string($_POST['kod'])); 

							$Qsubcat = "SELECT count(*) from kategori where nama = '$subkategori' and parent_id='$kategori' and level = '1'";
							$Tsubcat = $db->sql_total($Qsubcat);	
							
							$Qkod = "SELECT count(*) from kategori where kod = '$kod' and parent_id='$kategori' and level = '1' ";
							$Tkod = $db->sql_total($Qkod);	
							
							if($Tsubcat <> 0){
								echo"
									<div class='section'>
										<ul class='system_messages'>
											<li class='yellow'><span class='ico'></span><strong class='system_title'>Sub kategori ini sudah digunakan !</strong> </li>
										</ul>
									</div>";
							}
							if($Tkod <> 0){
								echo"
									<div class='section'>
										<ul class='system_messages'>
											<li class='yellow'><span class='ico'></span><strong class='system_title'>Kod ini sudah digunakan !</strong> </li>
										</ul>
									</div>";
							}
							if($Tsubcat==0 && $Tkod==0 ){
								$createSubKategori= "INSERT INTO kategori(nama,kod,parent_id, level, tarikh_daftar) VALUES 
								('$subkategori','$kod','$kategori','1' ,NOW())";
								$result = $db->sql_query($createSubKategori);
								
								if ($result){
								//	Display success																			
									echo'
									<div class="section">
										<ul class="system_messages">
											<li class="green"><span class="ico"></span><strong class="system_title" >Sub Kategori berjaya disimpan !</strong></li>
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
								<h2>Pendaftaran Sub Kategori</h2>
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
						<form action="" method="POST"  class="search_form general_form">
							<!--[if !IE]>start fieldset<![endif]-->
							<fieldset>
								<!--[if !IE]>start forms<![endif]-->
								<div class="forms">
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>KATEGORI:</label>
									<div class="inputs">
										<span class="input_wrapper select_wrapper" style ="width:440px; ">
											
											<select name="kategori" id="kategori">
												<?php
												
												$qList= "select * from kategori where parent_id is null OR parent_id = '' ";
												$rList = $db->sql_fetch($qList);
												echo '<option value="" '; if(isset($_POST['kategori'])) echo 'selected'; echo'>Sila Pilih</option>';
												foreach ($rList as $i) {
													echo '<option value="'.$i['id'].'" '; if(isset($_POST['kategori']) && $_POST['kategori'] == $i['id']) echo 'selected'; echo'>'.$i['nama'].'</option>';
												}
												?>
											</select>
										</span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->

								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>SUB KATEGORI:</label>
									<div class="inputs">
										<span class="input_wrapper" style ="width:430px; "><input class="text alphaonly" name="subkategori" type="text" value="<?php if(isset($_POST['subkategori'])) echo $_POST['subkategori'] ?>" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>KOD:</label>
									<div class="inputs">
										<span class="input_wrapper"><input maxlength="3" class="text numbersOnly" name="kod" type="text" value="<?php if(isset($_POST['kod'])) echo $_POST['kod'] ?>" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<div class="inputs">
										<span class="button green_button"><span><span>DAFTAR</span></span><input name="daftar" type="submit" /></span>
										<span class="button gray_button"><span><span>RESET</span></span><input name="reset" type="submit" /></span> 
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