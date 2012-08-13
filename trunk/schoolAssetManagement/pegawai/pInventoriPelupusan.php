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
			
				
				<?php

				if(!empty($_GET['del_id'])){
					if( empty($_GET['token']) || $_GET['token'] != $_SESSION['tokenInventoriPelupusanDel'] ){
						echo"
						<div class='section'>
							<ul class='system_messages'>
								<li class='red'><span class='ico'></span><strong class='system_title'>Data pelupusan tidak boleh dihapuskan!</strong> </li>
							</ul>
						</div>";
					}
					else {
						// All fine: delete 
						$qDel= "delete from pelupusan where id = $_GET[del_id]" ;
						$rDel = $db->sql_query($qDel);
						if($rDel){
							echo"
							<div class='section'>
								<ul class='system_messages'>
									<li class='green'><span class='ico'></span><strong class='system_title'>Data pelupusan  berjaya dihapuskan!</strong> </li>
								</ul>
							</div>";
						}							
						// Unset the token, so that it cannot be used again.
						unset($_SESSION['tokenInventoriPelupusanDel']);
					}
				}

				$token = md5(uniqid(rand(), true));
				$_SESSION['tokenInventoriPelupusanDel'] = $token;

				?>
				<!--[if !IE]>start section<![endif]-->
				<?php
					if(isset($_POST['reset'])){
						$_POST = "";
					}
					if(isset($_POST['daftar'])){
						$IdInventori= mysql_real_escape_string($_POST['IdInventori']);
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
						
							
							$rujukan = strtoupper(mysql_real_escape_string($_POST['rujukan'])); 
							$tarikh = mysql_real_escape_string($_POST['tarikh']); 
							$kaedah = strtoupper(mysql_real_escape_string($_POST['kaedah'])); 
							$kuantiti = strtoupper(mysql_real_escape_string($_POST['kuantiti'])); 
							$lokasi = strtoupper(mysql_real_escape_string($_POST['lokasi'])); 
							$nosiridaftar = strtoupper(mysql_real_escape_string($_POST['nosiridaftar'])); 
							
							
							$tarikhFormat = changeDateBeginYear($tarikh);

							$userID=$_SESSION['userlogin_id'];
							
							$createUser= "INSERT INTO pelupusan (rujukan, tarikh,kaedah,kuantiti,lokasi,inventori_id, pengguna_id, tarikh_daftar) VALUES 
								('$rujukan','$tarikhFormat','$kaedah','$kuantiti','$lokasi','$IdInventori','$userID',now())";
							$result = $db->sql_query($createUser);
							if ($result){	

								//	Display success																			
								echo'
								<div class="section">
									<ul class="system_messages">
										<li class="green"><span class="ico"></span><strong class="system_title">Pelupusan untuk no siri pendaftaran '.$nosiridaftar.' berjaya didaftarkan !</strong></li>
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
						$sql= "select * from  Inventori	where id = '$id' ";
						$rInv = $db->sql_list($sql);
						
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
										<span class="input_wrapper" style="width:300px;"><input name="rujukan"  class="text " value="<?php if(isset($_POST['rujukan'])) echo $_POST['rujukan'] ?>" type="text"  /></span>
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
									<label>KAEDAH PELUPUSAN:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="kaedah"  class="text" value="<?php if(isset($_POST['kaedah'])) echo $_POST['kaedah'] ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>KUANTITI:</label>
									<div class="inputs">
										<span class="input_wrapper"><input name="kuantiti" maxlength="5" class="text numbersOnly" value="<?php if(isset($_POST['kuantiti'])) echo $_POST['kaedah'] ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>LOKASI:</label>
									<div class="inputs">
										<span class="input_wrapper" style="width:300px;"><input name="lokasi"  class="text" value="<?php if(isset($_POST['lokasi'])) echo $_POST['kaedah'] ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>NAMA PEGAWAI:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none;"><input name="pegawai" readonly class="text" value="<?php echo strtoupper($_SESSION['name']);  ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<div class="inputs">
										<input name="IdInventori"  class="text" value="<?php  echo $rInv['id']; ?>" type="hidden"  />
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
										$qList= "select p.id, p.rujukan, p.tarikh, p.kaedah,p.kuantiti,p.lokasi,u.nama from  pelupusan p , Inventori h, pengguna u where
												p.pengguna_id=u.id
												and p.inventori_id=h.id
												and p.inventori_id = '$id'  
													 order by p.tarikh_daftar desc  ";
										$rList = $db->sql_fetch($qList);			

									?>
									<table cellpadding="0" cellspacing="0" width="100%">
										<tbody>
										<tr>
											<th style="width: 10px;">Bil.</th>
											<th >Rujukan</th>
											<th style="width: 50px;">Tarikh</th>
											<th >Kaedah</th>
											<th >Kuantiti</th>
											<th >Lokasi</th>
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
													<td>'.$i['4'].'</td>
													<td>'.$i['5'].'</td>
													<td>'.$i['6'].'</td>
													<td>
														<div class="actions_menu" >
															<ul>
																<li><a class="edit" href="pInventoriPelupusanKemaskini.php?id='.$id.'&subid='.$i['0'].'">Kemaskini</a></li>
																<li><a class="delete" href="pInventoriPelupusan.php?id='.$id.'&del_id='.$i['0'].'&token='.$_SESSION['tokenInventoriPelupusanDel'].'">Hapus</a></li>
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