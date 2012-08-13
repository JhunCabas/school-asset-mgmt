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
						$_POST	= "";
					}
					if(isset($_POST['daftar'])){
						$notvalid=false;
						if(empty($_POST['kategori'])){
							$errors[] = 'Sila masukkan kategori';
							$notvalid=true;
						}
						if(empty($_POST['kod'])){
							$errors[] = 'Sila masukkan kod';
							$notvalid=true;
						}
						if($notvalid==true){
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
							$kod = strtoupper(mysql_real_escape_string($_POST['kod'])); 
							
							$Qcat = "SELECT count(*) from kategori where nama = '$kategori' and parent_id is null";
							$Tcat = $db->sql_total($Qcat);	
							
							$Qkod = "SELECT count(*) from kategori where kod = '$kod' and parent_id is null and level = '0' ";
							$Tkod = $db->sql_total($Qkod);	
							
							
							if($Tcat <> 0){
								echo"
									<div class='section'>
										<ul class='system_messages'>
											<li class='yellow'><span class='ico'></span><strong class='system_title'>Kategori ini sudah digunakan !</strong> </li>
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
							if($Tcat==0 && $Tkod ==0){
								$createKategori= "INSERT INTO kategori(nama,kod,level, tarikh_daftar) VALUES 
								('$kategori','$kod','0', NOW())";
								$result = $db->sql_query($createKategori);
								
								if ($result){
								//	Display success																			
									echo'
									<div class="section">
										<ul class="system_messages">
											<li class="green"><span class="ico"></span><strong class="system_title" >Kategori berjaya disimpan !</strong></li>
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
								<h2>PENDAFTARAN KATEGORI</h2>
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
									<label>KATEGORI:</label>
									<div class="inputs">
										<span class="input_wrapper"  style="width: 430px;" ><input class="text alphaonly" name="kategori" type="text" value="<?php if(isset($_POST['kategori'])) echo $_POST['kategori'] ?>" /></span>
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