<?php
	include('header.php');
?>
<script>
	$(function() {
		$('.numbersOnly').keyup(function () { 
			this.value = this.value.replace(/[^0-9\.]/g,'');
		});
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
					
					if(isset($_POST['kemaskini'])){
						$IdPembekal = mysql_real_escape_string($_POST['IdPembekal']);
						$notvalid=false;
						if(empty($_POST['namasyarikat'])){
							$errors[] = 'Sila masukkan nama syarikat';
							$notvalid=true;
						}
						if(empty($_POST['nodaftar'])){
							$errors[] = 'Sila masukkan no. pendaftaran syarikat';
							$notvalid=true;
						}
						if(empty($_POST['nodaftarkewangan'])){
							$errors[] = 'Sila masukkan no. pendaftaran kementerian kewangan: ';
							$notvalid=true;
						}
						if(empty($_POST['jenis'])){
							$errors[] = 'Sila masukkan jenis pembekal: ';
							$notvalid=true;
						}
						if(empty($_POST['alamat'])){
							$errors[] = 'Sila masukkan alamat';
							$notvalid=true;
						}
						if(empty($_POST['notel'])){
							$errors[] = 'Sila masukkan no. telefon ';
							$notvalid=true;
						}
						if(empty($_POST['nofax'])){
							$errors[] = 'Sila masukkan no. FAX: ';
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
							
							$namasyarikat = mysql_real_escape_string($_POST['namasyarikat']); 
							$nodaftar = mysql_real_escape_string($_POST['nodaftar']); 
							$nodaftarkewangan = mysql_real_escape_string($_POST['nodaftarkewangan']); 
							$jenis = mysql_real_escape_string($_POST['jenis']); 
							$alamat = mysql_real_escape_string($_POST['alamat']); 
							$notel = mysql_real_escape_string($_POST['notel']); 
							$nofax = mysql_real_escape_string($_POST['nofax']); 
							

							$updatePembekal= "UPDATE  pembekal set nama='$namasyarikat', no_daftar='$nodaftar', no_daftar_kementerian='$nodaftarkewangan',
								jenis='$jenis',alamat='$alamat',tel_no='$notel',fax_no='$nofax' where id='$IdPembekal' ";
							$result = $db->sql_query($updatePembekal);
							
							if ($result){	

								//	Display success																			
								echo'
								<div class="section">
									<ul class="system_messages">
										<li class="green"><span class="ico"></span><strong class="system_title">Pembekal berjaya dikemaskinikan !</strong></li>
									</ul>
								</div>
									';
							
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
								<h2>Kemaskini Pembekal</h2>
							</div>
						</div>
						<span class="title_wrapper_bottom"></span>
					</div>
					<!--[if !IE]>end title wrapper<![endif]-->
					
					<!--[if !IE]>start section content<![endif]-->
					<div class="section_content">
						<span class="section_content_top"></span>
						
						<div class="section_content_inner">
						
						<!--[if !IE]>start section<![endif]-->
						<?php
							$id="";
							if(isset($_GET['id'])){
								$id = mysql_real_escape_string($_GET['id']); 
							}
							/* Get data. */
							$qPembekal= "select * from pembekal where id = '$id'  ";
							$rPembekal = $db->sql_list($qPembekal);
							
						?>
						<!--[if !IE]>start forms<![endif]-->
						<form action="" method="POST"  class="search_form general_form">
							<!--[if !IE]>start fieldset<![endif]-->
							<fieldset>
								<!--[if !IE]>start forms<![endif]-->
								<div class="forms">
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Nama Syarikat:</label>
									<div class="inputs">
										<span class="input_wrapper"><input class="text" name="namasyarikat" type="text" value="<?php echo $rPembekal['nama']; ?>" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>No. Pendaftaran Syarikat:</label>
									<div class="inputs">
										<span class="input_wrapper"><input class="text alphanumeric" maxlength="20" name="nodaftar" type="text" value="<?php echo $rPembekal['no_daftar']; ?>" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>No. Pendaftaran </label>
									<div class="inputs">
										<span class="input_wrapper"><input class="text alphanumeric" maxlength="20"  name="nodaftarkewangan" type="text" value="<?php echo $rPembekal['no_daftar_kementerian']; ?>" /></span>
									</div>
									<label>Kementerian Kewangan:</label>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Jenis Pembekal:</label>
									<div class="inputs">
										<span class="input_wrapper"><input class="text alphanumeric" name="jenis" type="text" value="<?php echo $rPembekal['jenis']; ?>" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Alamat:</label>
									<div class="inputs">
										<span class="input_wrapper textarea_wrapper" style=" height: 60px; width:300px;">
											<textarea rows="" cols="" class="text" name="alamat" style="overflow:hidden;" ><?php echo $rPembekal['alamat']; ?></textarea>
										</span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>No. Telefon:</label>
									<div class="inputs">
										<span class="input_wrapper"><input class="text numbersOnly" maxlength="11" name="notel" type="text" value="<?php echo $rPembekal['tel_no']; ?>" /></span>
										<span class="system infotip">Nombor sahaja, cth: 0386796075</span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>No. FAX:</label>
									<div class="inputs">
										<span class="input_wrapper"><input class="text numbersOnly" maxlength="11" name="nofax" type="text" value="<?php echo $rPembekal['fax_no']; ?>" /></span>
										<span class="system infotip">Nombor sahaja, cth: 0386796066</span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<div class="inputs">
										<input name="IdPembekal"  class="text" value="<?php  echo $rPembekal['id']; ?>" type="hidden"  />
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