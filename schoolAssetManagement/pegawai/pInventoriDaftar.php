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

		$.getJSON("select.php",{id: $("select#kategori").val(), subid: $("#subKategoriId").val(), ajax: 'true'}, function(j){
			  var options = '';
			  for (var i = 0; i < j.length; i++) {
				
				options += '<option value="' + j[i].optionValue + '" ' + j[i].optionSelected + '>' + j[i].optionDisplay + '</option>';
			  }
			  $("select#subkategori").html(options);
			  
			    $.getJSON("select.php",{id: $("select#subkategori").val(), subid: $("#jenisId").val(), ajax: 'true'}, function(j){
					  var options = '';
					  for (var i = 0; i < j.length; i++) {
						
						options += '<option value="' + j[i].optionValue + '" ' + j[i].optionSelected + '>' + j[i].optionDisplay + '</option>';
					  }
					  $("select#jenis").html(options);
			    })
		})
			
		$("select#kategori").change(function(){
			$.getJSON("select.php",{id: $(this).val(), subid: $("#subKategoriId").val(), ajax: 'true'}, function(j){
			  var options = '';
			  for (var i = 0; i < j.length; i++) {
				
				options += '<option value="' + j[i].optionValue + '" ' + j[i].optionSelected + '>' + j[i].optionDisplay + '</option>';
			  }
			  $("select#subkategori").html(options);
			})
		})
		
		$.getJSON("select.php",{id: $("select#subkategori").val(), subid: $("#jenisId").val(), ajax: 'true'}, function(j){
			  var options = '';
			  for (var i = 0; i < j.length; i++) {
				
				options += '<option value="' + j[i].optionValue + '" ' + j[i].optionSelected + '>' + j[i].optionDisplay + '</option>';
			  }
			  $("select#jenis").html(options);
		})
			
		$("select#subkategori").change(function(){
			$.getJSON("select.php",{id: $(this).val(), subid: $("#jenisId").val(), ajax: 'true'}, function(j){
			  var options = '';
			  for (var i = 0; i < j.length; i++) {
				
				options += '<option value="' + j[i].optionValue + '" ' + j[i].optionSelected + '>' + j[i].optionDisplay + '</option>';
			  }
			  $("select#jenis").html(options);
			})
		})
	});

</script>
		<!--[if !IE]>start content<![endif]-->
		<div id="content">
			<div class="inner">
				<!--[if !IE]>start section<![endif]-->
				<?php
					$idInventori = "";
					if(isset($_POST['reset'])){
						$_POST = "";
					}
					if(isset($_POST['daftar'])){
						$notvalid = false;
						if(empty($_POST['kaedahperolehan'])){
							$errors[] = 'Sila pilih kaedah perolehan';
							$notvalid = true;
						}
						if(empty($_POST['kategori'])){
							$errors[] = 'Sila pilih kategori';
							$notvalid = true;
						}
						if(empty($_POST['subkategori'])){
							$errors[] = 'Sila pilih sub kategori';
							$notvalid = true;
						}
						if(empty($_POST['jenis'])){
							$errors[] = 'Sila pilih jenis';
							$notvalid = true;
						}
						if (empty($_POST['kuantiti'])){
							$errors[] = 'Sila masukkan  kuantiti';
							$notvalid = true;
						}
						if (empty($_POST['hargaasal'])){
							$errors[] = 'Sila masukkan  harga perolehan asal';
							$notvalid = true;
						}
						if(empty($_POST['tarikhterima'])){
							$errors[] = 'Sila masukkan tarikh diterima';
							$notvalid = true;
						}
						if(empty($_POST['pembekal'])){
							$errors[] = 'Sila pilih pembekal';
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
						
							
							$kementerian = strtoupper(mysql_real_escape_string($_POST['kementerian'])); 
							$bahagian = strtoupper(mysql_real_escape_string($_POST['bahagian'])); 
							$kaedahperolehan = strtoupper(mysql_real_escape_string($_POST['kaedahperolehan'])); 
							$kodnasional = strtoupper(mysql_real_escape_string($_POST['kodnasional'])); 
							$kategori = mysql_real_escape_string($_POST['kategori']); 
							$subkategori = mysql_real_escape_string($_POST['subkategori']); 
							$jenis = mysql_real_escape_string($_POST['jenis']); 
							$kuantiti = strtoupper(mysql_real_escape_string($_POST['kuantiti'])); 
							$unitukur = strtoupper(mysql_real_escape_string($_POST['unitukur'])); 
							$hargaasal = mysql_real_escape_string($_POST['hargaasal']); 
							$tarikhterima = mysql_real_escape_string($_POST['tarikhterima']); 
							$nopesananrasmi = strtoupper(mysql_real_escape_string($_POST['nopesananrasmi'])); 
							$tempohjaminan = strtoupper(mysql_real_escape_string($_POST['tempohjaminan'])); 
							$pembekal = mysql_real_escape_string($_POST['pembekal']); 
							
							$catID = explode("-", $kategori);
							$kategoriID = $catID[0];
							$kategoriKod = $catID[1];
							
							$catSubID = explode("-", $subkategori);
							$kategoriSubID = $catSubID[0];
							$kategoriSubKod = $catSubID[1];
							
							$jnsID = explode("-", $jenis);
							$jenisID = $jnsID[0];
							$jenisKod = $jnsID[1];
							
							$year4digit = date("Y"); 
							$year2digit = date("y"); 
							$number = $db->get_counter_barcode($year4digit);
							$generateIncrement = number_pad($number,4);
							
							//KK = Kod Kementerian
							//BKP10 = Kod Bahagian
							//H/I = H - Harta Modal  I -  Inventori
							//07 = Tahun perolehan aset
							//0001 = Bil atau nombor siri aset
							//001002003 = kod klasifikasi (kategori+sub kategori+jenis)
							//DB|SB|LH|HD = Kaedah Perolehan
							//$nosiripendaftaran = "KK/BKP10/H/07/0001/001002003/HD";
							$nosiripendaftaran = "KK/BKP10/I/$year2digit/$generateIncrement/$kategoriKod$kategoriSubKod$jenisKod/$kaedahperolehan";
							//echo '<br/>'.print_r($_POST);
							
							$tarikhterimaFormat = changeDateBeginYear($tarikhterima);
							$userID=$_SESSION['userlogin_id'];
							
							$sql= "INSERT INTO inventori (kaedah_peroleh, no_siri_daftar, kementerian, bahagian,
								kod_nasional,kategori_id,sub_kategori_id, jenis_id,kuantiti,unit_ukur,
								harga_perolehan_asal,tarikh_terima,no_pesanan,tempoh_jaminan,
								pembekal_id,pengguna_id,tarikh_daftar) VALUES 
								('$kaedahperolehan','$nosiripendaftaran', '$kementerian','$bahagian', 
								'$kodnasional','$kategoriID','$kategoriSubID','$jenisID','$kuantiti','$unitukur',
								'$hargaasal','$tarikhterimaFormat','$nopesananrasmi','$tempohjaminan',
								'$pembekal','$userID',now())";
							$result = $db->sql_query($sql);
							$idInventori = mysql_insert_id(); 
							
							if ($result){	

								//	Display success																			
								echo'
								<div class="section">
									<ul class="system_messages">
										<li class="green"><span class="ico"></span><strong class="system_title">Inventori berjaya disimpan !</strong>
											<br/> Sila klik tab penempatan jika ingin meneruskan pendaftaran penempatan.</li>
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
								<h2>DAFTAR </h2>
								<ul class="section_menu left">
									<li><a href="#" class="selected_lk"><span class="l"><span></span></span><span class="m"><em>Inventori (KEW.PA-3)</em><span></span></span><span class="r"><span></span></span></a></li>
									<?php if(!empty($idInventori)){ ?>
									<li><a href="pInventoriPenempatan.php?id=<?php echo $idInventori; ?>"><span class="l"><span></span></span><span class="m"><em>PENEMPATAN</em><span></span></span><span class="r"><span></span></span></a></li>
									<li><a href="pInventoriPemeriksaan.php?id=<?php echo $idInventori; ?>"><span class="l"><span></span></span><span class="m"><em>PEMERIKSAAN</em><span></span></span><span class="r"><span></span></span></a></li>
									<li><a href="pInventoriPelupusan.php?id=<?php echo $idInventori; ?>"><span class="l"><span></span></span><span class="m"><em>PELUPUSAN/HAPUS KIRA</em><span></span></span><span class="r"><span></span></span></a></li>
									<?php } ?>
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
									<label>KEMENTERIAN/JABATAN:</label>
									<div class="inputs">
										<span class="input_wrapper"  style="width:300px;" ><input name="kementerian" maxlength="50" readonly class="text" value="KEMENTERIAN KEWANGAN" type="text" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>BAHAGIAN:</label>
									<div class="inputs">
										<span class="input_wrapper"  style="width:300px;"><input name="bahagian" maxlength="50" readonly class="text" value="BAHAGIAN PENTADBIRAN" type="text"  /></span>
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
								<h3>Butir-butir Inventori</h3>
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>KAEDAH PEROLEHAN:</label>
									<div class="inputs">
										<span class="input_wrapper select_wrapper">
											<select name="kaedahperolehan" id="kaedahperolehan">
												<option value="" >Sila Pilih</option>
												<option value="DB" <?php if(isset($_POST['kaedahperolehan']) && $_POST['kaedahperolehan']=='DB') echo 'selected';  ?> >Beli</option>
												<option value="LH" <?php if(isset($_POST['kaedahperolehan']) && $_POST['kaedahperolehan']=='LH') echo 'selected';  ?>>Lucut Hak</option>
												<option value="SB" <?php if(isset($_POST['kaedahperolehan']) && $_POST['kaedahperolehan']=='SB') echo 'selected';  ?>>Sewa Beli</option>
												<option value="HD" <?php if(isset($_POST['kaedahperolehan']) && $_POST['kaedahperolehan']=='HD') echo 'selected';  ?>>Hadiah</option>
											</select>
										</span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>KOD NASIONAL:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="kodnasional" maxlength="16" class="text " value="<?php if(isset($_POST['kodnasional'])) echo $_POST['kodnasional'] ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>KATEGORI:</label>
									<div class="inputs">
										<span class="input_wrapper select_wrapper" style=" width: 440px;">
											
											<select name="kategori" id="kategori">
												<?php
												
												$qList= "select * from kategori where parent_id is null OR parent_id = '' ";
												$rList = $db->sql_fetch($qList);
												echo '<option value="" '; if(isset($_POST['kategori'])) echo 'selected'; echo'>Sila Pilih</option>';
												foreach ($rList as $i) {
													echo '<option value="'.$i['id'].'-'.$i['kod'].'" '; if(isset($_POST['kategori']) && $_POST['kategori'] == $i['id']) echo 'selected'; echo'>'.$i['kod'].' - '.$i['nama'].'</option>';
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
										<span class="input_wrapper select_wrapper" style=" width: 440px;">
											
											<select name="subkategori" id="subkategori">
												 <option value=""></option>
											</select>
										</span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>JENIS:</label>
									<div class="inputs">
										<span class="input_wrapper select_wrapper" style=" width: 440px;">
											
											<select name="jenis" id="jenis">
												 <option value=""></option>
											</select>
										</span>
									
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>KUANTITI:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="kuantiti"  maxlength="4" class="text numbersOnly" value="<?php if(isset($_POST['kuantiti'])) echo $_POST['kuantiti'] ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>UNIT PENGUKURAN:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="unitukur" maxlength="30" class="text " value="<?php if(isset($_POST['unitukur'])) echo $_POST['unitukur'] ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->

								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>HARGA PEROLEHAN ASAL (RM):</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="hargaasal" maxlength="6"  class="text numbersOnly" value="<?php if(isset($_POST['hargaasal'])) echo $_POST['hargaasal'] ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>TARIKH DITERIMA:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="tarikhterima" id="datepicker" class="text" value="<?php if(isset($_POST['tarikhterima'])) echo $_POST['tarikhterima'] ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>NO. PESANAN RASMI KERAJAAN:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="nopesananrasmi"  maxlength="30" class="text " value="<?php if(isset($_POST['nopesananrasmi'])) echo $_POST['nopesananrasmi'] ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>TEMPOH JAMINAN:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="tempohjaminan" maxlength="30" class="text " value="<?php if(isset($_POST['tempohjaminan'])) echo $_POST['tempohjaminan'] ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>NAMA PEMBEKAL:</label>
									<div class="inputs">
										<span class="input_wrapper select_wrapper">
											
											<select name="pembekal" id="pembekal" style=" width: 440px;">
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
							
							
							<fieldset>	
								<!--[if !IE]>start forms<![endif]-->
								<div class="forms">								
							
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<div class="inputs">
										<input name="subKategoriId" id="subKategoriId" class="text" value="<?php if(isset($_POST['subkategori'])) echo $_POST['subkategori'] ?>" type="hidden"  />
										<input name="jenisId" id="jenisId" class="text" value="<?php if(isset($_POST['jenis'])) echo $_POST['jenis'] ?>" type="hidden"  />
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