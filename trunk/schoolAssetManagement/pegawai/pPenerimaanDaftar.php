<?php
	include('header.php');
?>
<script>
	$(function() {
		$("#datepicker").datepicker({
            dateFormat: 'dd/mm/yy'
		});	
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
					if(isset($_POST['reset'])){
						$_POST = "";
					}
					if(isset($_POST['daftar'])){
						$notvalid = false;
						if(empty($_POST['pembekal'])){
							$errors[] = 'Sila pilih pembekal';
							$notvalid = true;
						}
						if(empty($_POST['noterima'])){
							$errors[] = 'Sila masukkan no. hantaran';
							$notvalid = true;
						}
						if(empty($_POST['tarikhterima'])){
							$errors[] = 'Sila masukkan tarikh diterima';
							$notvalid = true;
						}
						if (empty($_POST['namaaset'])){
							$errors[] = 'Sila masukkan nama aset';
							$notvalid = true;
						}
						if(empty($_POST['qtypesan'])){
							$errors[] = 'Sila masukkan kuantiti dipesan';
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
							$pembekal = mysql_real_escape_string($_POST['pembekal']); 
							$noterima = mysql_real_escape_string($_POST['noterima']); 
							$tarikhterima = mysql_real_escape_string($_POST['tarikhterima']); 
							$namaaset = mysql_real_escape_string($_POST['namaaset']); 
							$qtypesan = mysql_real_escape_string($_POST['qtypesan']); 
							$qtyterima = mysql_real_escape_string($_POST['qtyterima']); 
							$qtyselisih = mysql_real_escape_string($_POST['qtyselisih']); 
							$perihalrosal = mysql_real_escape_string($_POST['perihalrosal']); 
							$catatan = mysql_real_escape_string($_POST['catatan']); 
							
							$tarikhterimaFormat = changeDateBeginYear($tarikhterima);
							$userID=$_SESSION['userlogin_id'];
							$createUser= "INSERT INTO penerimaan(no_terima, tarikh_terima, nama_aset, qty_pesan, qty_terima,qty_selisih,perihal_rosak, catatan,pengguna_id,pembekal_id,tarikh_daftar) VALUES 
							('$noterima','$tarikhterimaFormat', '$namaaset','$qtypesan', '$qtyterima','$qtyselisih','$perihalrosal','$catatan','$userID','$pembekal',now())";
							$result = $db->sql_query($createUser);
							
							if ($result){	

								//	Display success																			
								echo'
								<div class="section">
									<ul class="system_messages">
										<li class="green"><span class="ico"></span><strong class="system_title">Penerimaan aset berjaya disimpan !</strong></li>
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
								<h2>Daftar Penerimaan Aset (KEW.PA-1)</h2>
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
									<label>Nama Pembekal:</label>
									<div class="inputs">
										<span class="input_wrapper select_wrapper">
											
											<select name="pembekal" id="pembekal" style="width:auto; ">
												<?php
												$qList= "select * from pembekal  ";
												$rList = $db->sql_fetch($qList);
												echo '<option value="" '; if(isset($_POST['pembekal'])) echo 'selected'; echo'>Sila Pilih</option>';
												foreach ($rList as $i) {
													echo '<option value="'.$i['id'].'" '; if(isset($_POST['pembekal']) && $_POST['pembekal'] == $i['id']) echo 'selected'; echo'>'.$i['nama'].'  ('.$i['no_daftar'].')</option>';
												}
												?>
											</select>
										</span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								</div>
								<!--[if !IE]>end forms<![endif]-->
								
							</fieldset>
							<!--[if !IE]>end fieldset<![endif]-->	
							
							<!--[if !IE]>start fieldset<![endif]-->
							<fieldset>
								<!--[if !IE]>start forms<![endif]-->
								<div class="forms">
								<h3>Nota Hantaran</h3>
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>No. Hantaran:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="noterima" maxlength="20"  class="text alphanumeric" value="<?php if(isset($_POST['noterima'])) echo $_POST['noterima'] ?>" type="text" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Tarikh Diterima:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="tarikhterima" id="datepicker" class="text" value="<?php if(isset($_POST['tarikhterima'])) echo $_POST['tarikhterima'] ?>" type="text"  /></span>
										</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								</div>
								<!--[if !IE]>end forms<![endif]-->
								
							</fieldset>
							<!--[if !IE]>end fieldset<![endif]-->
							
							<!--[if !IE]>start fieldset<![endif]-->
							<fieldset>	
								<!--[if !IE]>start forms<![endif]-->
								<div class="forms">							
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Nama Aset:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="namaaset" maxlength="30" class="text alphanumeric" value="<?php if(isset($_POST['namaaset'])) echo $_POST['namaaset'] ?>" type="text"  /></span>
										
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								</div>
								<!--[if !IE]>end forms<![endif]-->
							</fieldset>
							<!--[if !IE]>end fieldset<![endif]-->
							
							<!--[if !IE]>start fieldset<![endif]-->
							<fieldset>
								<!--[if !IE]>start forms<![endif]-->
								<div class="forms">
								<h3>Kuantiti</h3>
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Dipesan:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="qtypesan"  maxlength="4" class="text numbersOnly" value="<?php if(isset($_POST['qtypesan'])) echo $_POST['qtypesan'] ?>" type="text" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Diterima:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="qtyterima"  maxlength="4" class="text numbersOnly" value="<?php if(isset($_POST['qtyterima'])) echo $_POST['qtyterima'] ?>" type="text"  /></span>
										</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Perselisihan:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="qtyselisih"  maxlength="4" class="text numbersOnly" value="<?php if(isset($_POST['qtyselisih'])) echo $_POST['qtyselisih'] ?>" type="text"  /></span>
										</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								</div>
								<!--[if !IE]>end forms<![endif]-->
								
							</fieldset>
							<!--[if !IE]>end fieldset<![endif]-->
							
							<!--[if !IE]>start fieldset<![endif]-->
							<fieldset>	
								<!--[if !IE]>start forms<![endif]-->
								<div class="forms">							
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Perihal Kerosakan:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="perihalrosal"  maxlength="30" class="text alphanumeric" value="<?php if(isset($_POST['perihalrosal'])) echo $_POST['perihalrosal'] ?>" type="text"  /></span>
										
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								</div>
								<!--[if !IE]>end forms<![endif]-->
							</fieldset>
							<!--[if !IE]>end fieldset<![endif]-->
							
							<!--[if !IE]>start fieldset<![endif]-->
							<fieldset>	
								<!--[if !IE]>start forms<![endif]-->
								<div class="forms">							
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Catatan:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="catatan"  maxlength="30" class="text alphanumeric" value="<?php if(isset($_POST['catatan'])) echo $_POST['catatan'] ?>" type="text"  /></span>
										
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								</div>
								<!--[if !IE]>end forms<![endif]-->
							</fieldset>
							<!--[if !IE]>end fieldset<![endif]-->
							
							<fieldset>	
								<!--[if !IE]>start forms<![endif]-->
								<div class="forms">								
							
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