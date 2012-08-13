<?php
	$id="";
	if(isset($_GET['id'])){
		$id = mysql_real_escape_string($_GET['id']); 
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

				if(!empty($_GET['del_id'])){
					if( empty($_GET['token']) || $_GET['token'] != $_SESSION['tokenHartamodalPemeriksaanDel'] ){
						echo"
						<div class='section'>
							<ul class='system_messages'>
								<li class='red'><span class='ico'></span><strong class='system_title'>Data pemeriksaan tidak boleh dihapuskan!</strong> </li>
							</ul>
						</div>";
					}
					else {
						// All fine: delete 
						$qDel= "delete from pemeriksaan where id = $_GET[del_id]" ;
						$rDel = $db->sql_query($qDel);
						if($rDel){
							echo"
							<div class='section'>
								<ul class='system_messages'>
									<li class='green'><span class='ico'></span><strong class='system_title'>Data pemeriksaan berjaya dihapuskan!</strong> </li>
								</ul>
							</div>";
						}							
						// Unset the token, so that it cannot be used again.
						unset($_SESSION['tokenHartamodalPemeriksaanDel']);
					}
				}

				$token = md5(uniqid(rand(), true));
				$_SESSION['tokenHartamodalPemeriksaanDel'] = $token;

				?>
				<?php
					if(isset($_POST['reset'])){
						$_POST = "";
					}
					if(isset($_POST['daftar'])){
						$IdHartamodal= mysql_real_escape_string($_POST['IdHartamodal']);
						$notvalid = false;
						if(empty($_POST['statusaset'])){
							$errors[] = 'Sila masukkan status aset';
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
						
							
							$statusaset = strtoupper(mysql_real_escape_string($_POST['statusaset'])); 
							$tarikh = mysql_real_escape_string($_POST['tarikh']); 
							$nosiridaftar = strtoupper(mysql_real_escape_string($_POST['nosiridaftar'])); 
							
							
							$tarikhFormat = changeDateBeginYear($tarikh);

							$userID=$_SESSION['userlogin_id'];
							
							$createUser= "INSERT INTO pemeriksaan (status_aset, tarikh,harta_modal_id, pengguna_id, tarikh_daftar) VALUES 
								('$statusaset','$tarikhFormat','$IdHartamodal','$userID',now())";
							$result = $db->sql_query($createUser);
							if ($result){	

								//	Display success																			
								echo'
								<div class="section">
									<ul class="system_messages">
										<li class="green"><span class="ico"></span><strong class="system_title">Pemeriksaan untuk no siri pendaftaran '.$nosiridaftar.' berjaya didaftarkan !</strong>
										<br/> Sila klik tab pelupusan jika ingin meneruskan pendaftaran pelupusan.</li>
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
								<h2>DAFTAR</h2>
								<ul class="section_menu left">
									<li><a href="pHartamodalKemaskini.php?id=<?php echo $id; ?>" ><span class="l"><span></span></span><span class="m"><em>HARTA MODAL (KEW.PA-2)</em><span></span></span><span class="r"><span></span></span></a></li>
									<li><a href="pHartamodalPenempatan.php?id=<?php echo $id; ?>" ><span class="l"><span></span></span><span class="m"><em>PENEMPATAN</em><span></span></span><span class="r"><span></span></span></a></li>
									<li><a href="pHartamodalPemeriksaan.php?id=<?php echo $id; ?>" class="selected_lk"><span class="l"><span></span></span><span class="m"><em>PEMERIKSAAN</em><span></span></span><span class="r"><span></span></span></a></li>
									<li><a href="pHartamodalPelupusan.php?id=<?php echo $id; ?>"><span class="l"><span></span></span><span class="m"><em>PELUPUSAN/HAPUS KIRA</em><span></span></span><span class="r"><span></span></span></a></li>
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
								<h3>Butir-butir Pemeriksaan</h3>
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>STATUS ASET:</label>
									<div class="inputs">
										<span class="input_wrapper" style="width:300px;"><input name="statusaset"  class="text " value="<?php if(isset($_POST['statusaset'])) echo $_POST['statusaset'] ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>TARIKH:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="tarikh" id="datepicker" class="text" value="<?php if(isset($_POST['tarikh'])) echo $_POST['tarikh'] ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>NAMA PEMERIKSA:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none;"><input name="pegawai" readonly class="text" value="<?php echo strtoupper($_SESSION['name']);  ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<div class="inputs">
										<input name="IdHartamodal"  class="text" value="<?php  echo $rHmodal['id']; ?>" type="hidden"  />
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
						
						<!--[if !IE]>start table_wrapper<![endif]-->
							<div class="table_wrapper">
								<div class="table_wrapper_inner">
								
									<?php  

										/* Get data. */
										$qList= "select p.id, p.status_aset, p.tarikh, u.nama from  pemeriksaan p , Hartamodal h, pengguna u where
												p.pengguna_id=u.id
												and p.harta_modal_id=h.id
												and p.harta_modal_id = '$id'  
													 order by p.tarikh_daftar desc  ";
										$rList = $db->sql_fetch($qList);			

									?>
									<table cellpadding="0" cellspacing="0" width="100%">
										<tbody>
										<tr>
											<th style="width: 10px;">Bil.</th>
											<th >Status Aset</th>
											<th style="width: 50px;">Tarikh</th>
											<th style="width: 200px;">Nama Pegawai</a></th>
											<th style="width: 140px;">Tindakan</th>
										</tr>
										<?php
										$num =0;
										foreach ($rList as $i) {
											$num++;
											$colorRow = "first";
											if($num%2==0)
												$colorRow = "second"; 
											else
												$colorRow = "first";
							
											echo '	
												<tr class="'.$colorRow.'">
													<td>'.$num.'</td>
													<td>'.$i['1'].'</td>
													<td>'.changeDateBeginDay($i['2']).'</td>
													<td>'.$i['3'].'</td>
													<td>
														<div class="actions_menu" >
															<ul>
																<li><a class="edit" href="pHartamodalPemeriksaanKemaskini.php?id='.$id.'&subid='.$i['0'].'">Kemaskini</a></li>
																<li><a class="delete" href="pHartamodalPemeriksaan.php?id='.$id.'&del_id='.$i['0'].'&token='.$_SESSION['tokenHartamodalPemeriksaanDel'].'">Hapus</a></li>
															</ul>
														</div>
													</td>
												</tr>';
											
										}
										?>
										</tbody>
									</table>
								</div>
								</div>
							<!--[if !IE]>end table_wrapper<![endif]-->
							
							</div>
						
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