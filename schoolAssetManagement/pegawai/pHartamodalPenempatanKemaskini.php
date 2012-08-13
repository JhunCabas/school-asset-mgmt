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
						$IdHartamodal= mysql_real_escape_string($_POST['IdHartamodal']);
						$SubIdHartamodal= mysql_real_escape_string($_POST['SubIdHartamodal']);
						$notvalid = false;
						if(empty($_POST['lokasi'])){
							$errors[] = 'Sila masukkan lokasi';
							$notvalid = true;
						}
						if(empty($_POST['tarikh'])){
							$errors[] = 'Sila masukkan tarikh';
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
						
							
							$lokasi = strtoupper(mysql_real_escape_string($_POST['lokasi'])); 
							$tarikh = mysql_real_escape_string($_POST['tarikh']); 
							$nosiridaftar = strtoupper(mysql_real_escape_string($_POST['nosiridaftar'])); 
							
							
							$tarikhFormat = changeDateBeginYear($tarikh);

							$userID=$_SESSION['userlogin_id'];
							
							$sql= "UPDATE penempatan set lokasi='$lokasi', tarikh='$tarikhFormat', pengguna_id='$userID'
								where id='$SubIdHartamodal'";
							$result = $db->sql_query($sql);
							if ($result){	

								//	Display success																			
								echo'
								<div class="section">
									<ul class="system_messages">
										<li class="green"><span class="ico"></span><strong class="system_title">Penempatan untuk no siri pendaftaran '.$nosiridaftar.' berjaya dikemaskinikan !</strong></li>
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
									<li><a href="pHartamodalKemaskini.php?id=<?php echo $id; ?>" ><span class="l"><span></span></span><span class="m"><em>HARTA MODAL (KEW.PA-2)</em><span></span></span><span class="r"><span></span></span></a></li>
									<li><a href="pHartamodalPenempatan.php?id=<?php echo $id; ?>" class="selected_lk"><span class="l"><span></span></span><span class="m"><em>PENEMPATAN</em><span></span></span><span class="r"><span></span></span></a></li>
									<li><a href="pHartamodalPemeriksaan.php?id=<?php echo $id; ?>"><span class="l"><span></span></span><span class="m"><em>PEMERIKSAAN</em><span></span></span><span class="r"><span></span></span></a></li>
									<li><a href="pHartamodalPelupusan.php?id=<?php echo $id; ?>" ><span class="l"><span></span></span><span class="m"><em>PELUPUSAN/HAPUS KIRA</em><span></span></span><span class="r"><span></span></span></a></li>
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
						$qHmodal= "select * from  Hartamodal	where id = '$id' ";
						$rHmodal = $db->sql_list($qHmodal);
						
						$qHmodalSub= "select * from  penempatan	where id = '$subid' ";
						$rHmodalSub = $db->sql_list($qHmodalSub);
						
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
										<span class="input_wrapper" style="border:none; width:300px;"><input name="nosiridaftar"  readonly class="text" value="<?php echo $rHmodal['no_siri_daftar']; ?>" type="text" /></span>
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
									<label>LOKASI:</label>
									<div class="inputs">
										<span class="input_wrapper" style="width:300px;"><input name="lokasi"  class="text " value="<?php  echo $rHmodalSub['lokasi']; ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>TARIKH:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="tarikh" id="datepicker" class="text" value="<?php  echo changeDateBeginDay($rHmodalSub['tarikh']); ?>" type="text"  /></span>
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
										<input name="IdHartamodal"  class="text" value="<?php  echo $rHmodal['id']; ?>" type="hidden"  />
										<input name="SubIdHartamodal"  class="text" value="<?php  echo $rHmodalSub['id']; ?>" type="hidden"  />
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