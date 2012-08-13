<?php
	$id="";
	$id="subid";
	if(isset($_GET['id']) && isset($_GET['subid']) ){
		$id = mysql_real_escape_string($_GET['id']); 
		$subid = mysql_real_escape_string($_GET['subid']); 
	}else{
		?>
		<script>
			history.go(-1);
		</script>
		<?php
	}
?>
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

	});

</script>
		<!--[if !IE]>start content<![endif]-->
		<div id="content">
			<div class="inner">
				<!--[if !IE]>start section<![endif]-->
				<?php
					if(isset($_POST['kemaskini'])){
						$IdInventori= mysql_real_escape_string($_POST['IdInventori']);
						$SubIdInventori= mysql_real_escape_string($_POST['SubIdInventori']);
						$notvalid = false;
						if(empty($_POST['rujukan'])){
							$errors[] = 'Sila masukkan rujukan kelulusan';
							$notvalid = true;
						}
						if(empty($_POST['tarikh'])){
							$errors[] = 'Sila masukkan tarikh';
							$notvalid = true;
						}
						if(empty($_POST['kaedah'])){
							$errors[] = 'Sila masukkan kaedah';
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
						
							
							$rujukan = strtoupper(mysql_real_escape_string($_POST['rujukan'])); 
							$tarikh = mysql_real_escape_string($_POST['tarikh']); 
							$kaedah = strtoupper(mysql_real_escape_string($_POST['kaedah'])); 
							$kuantiti = strtoupper(mysql_real_escape_string($_POST['kuantiti'])); 
							$lokasi = strtoupper(mysql_real_escape_string($_POST['lokasi'])); 
							$nosiridaftar = strtoupper(mysql_real_escape_string($_POST['nosiridaftar'])); 
							
							
							$tarikhFormat = changeDateBeginYear($tarikh);

							$userID=$_SESSION['userlogin_id'];
							
							$sql= "UPDATE pelupusan set rujukan='$rujukan', tarikh='$tarikhFormat',kaedah='$kaedah',
								kuantiti='$kuantiti',lokasi='$lokasi',pengguna_id='$userID'
								where id='$SubIdInventori'";
							$result = $db->sql_query($sql);
							if ($result){	

								//	Display success																			
								echo'
								<div class="section">
									<ul class="system_messages">
										<li class="green"><span class="ico"></span><strong class="system_title">Pelupusan untuk no siri pendaftaran '.$nosiridaftar.' berjaya dikemaskinikan !</strong></li>
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
								<h2>KEMASKINI</h2>
								<ul class="section_menu left">
									<li><a href="pInventoriKemaskini.php?id=<?php echo $id; ?>" ><span class="l"><span></span></span><span class="m"><em>INVENTORI (KEW.PA-3)</em><span></span></span><span class="r"><span></span></span></a></li>
									<li><a href="pInventoriPenempatan.php?id=<?php echo $id; ?>" ><span class="l"><span></span></span><span class="m"><em>PENEMPATAN</em><span></span></span><span class="r"><span></span></span></a></li>
									<li><a href="pInventoriPemeriksaan.php?id=<?php echo $id; ?>"><span class="l"><span></span></span><span class="m"><em>PEMERIKSAAN</em><span></span></span><span class="r"><span></span></span></a></li>
									<li><a href="pInventoriPelupusan.php?id=<?php echo $id; ?>" class="selected_lk"><span class="l"><span></span></span><span class="m"><em>PELUPUSAN/HAPUS KIRA</em><span></span></span><span class="r"><span></span></span></a></li>
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
						
						<?php
						$qInv= "select * from  Inventori	where id = '$id' ";
						$rInv = $db->sql_list($qInv);
						
						$qInvSub= "select * from  pelupusan	where id = '$subid' ";
						$rInvSub = $db->sql_list($qInvSub);
						
						?>
						<!--[if !IE]>start forms<![endif]-->
						<form action="" method="POST" class="search_form general_form">
							
							<!--[if !IE]>start fieldset<![endif]-->
							<fieldset>
								<!--[if !IE]>start forms<![endif]-->
								<div class="forms">
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>NO. SIRI PENDAFTARAN:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none; width:300px;"><input name="nosiridaftar"  readonly class="text" value="<?php echo $rInv['no_siri_daftar']; ?>" type="text" /></span>
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
								<h3>Butir-butir Pelupusan</h3>
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>RUJUKAN KELULUSAN:</label>
									<div class="inputs">
										<span class="input_wrapper" style="width:300px;"><input name="rujukan"  class="text " value="<?php  echo $rInvSub['rujukan']; ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>TARIKH:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="tarikh" id="datepicker" class="text" value="<?php  echo changeDateBeginDay($rInvSub['tarikh']); ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>KAEDAH PELUPUSAN:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="kaedah"  class="text" value="<?php  echo $rInvSub['kaedah']; ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>KUANTITI:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="kuantiti" maxlength="5" class="text numbersOnly" value="<?php  echo $rInvSub['kuantiti']; ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>LOKASI:</label>
									<div class="inputs">
										<span class="input_wrapper" style="width:300px;"><input name="lokasi"  class="text" value="<?php  echo $rInvSub['lokasi']; ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>NAMA PEGAWAI:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none;"><input name="pegawai" readonly class="text" value="<?php echo strtoupper($_SESSION['name']); ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<div class="inputs">
										<input name="IdInventori"  class="text" value="<?php  echo $rInv['id']; ?>" type="hidden"  />
										<input name="SubIdInventori"  class="text" value="<?php  echo $rInvSub['id']; ?>" type="hidden"  />
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