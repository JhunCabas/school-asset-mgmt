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
					if(isset($_POST['kemaskini'])){
						$IdKategori = mysql_real_escape_string($_POST['IdKategori']);
						$IdParentKategori = mysql_real_escape_string($_POST['IdParentKategori']);
						$OriJenis = mysql_real_escape_string($_POST['OriJenis']);
						$OriKod = mysql_real_escape_string($_POST['OriKod']);
						$OriLevel = mysql_real_escape_string($_POST['OriLevel']);
						
						$notvalid = false;
						if(empty($_POST['jenis'])){
							$errors[] = 'Sila masukkan jenis';
							$notvalid = true;
						}
						if(empty($_POST['kod'])){
							$errors[] = 'Sila pilih kod';
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
							$jenis = strtoupper(mysql_real_escape_string($_POST['jenis'])); 
							$kod = strtoupper(mysql_real_escape_string($_POST['kod'])); 
							
							$Tcat=0;
							if($OriJenis != $jenis ){
								$Qcat = "SELECT count(*) from kategori where nama = '$jenis' and parent_id='$IdParentKategori' and level = '2'";
								$Tcat = $db->sql_total($Qcat);
							}
							
							$Tkod = 0;
							if($OriKod != $kod){
								$Qkod = "SELECT count(*) from kategori where kod = '$kod' and parent_id='$IdParentKategori' and level = '2' ";
								$Tkod = $db->sql_total($Qkod);	
							
							}
								
							if($Tcat <> 0){
								echo"
									<div class='section'>
										<ul class='system_messages'>
											<li class='yellow'><span class='ico'></span><strong class='system_title'>Jenis '$jenis' sudah digunakan !</strong> </li>
										</ul>
									</div>";
							}
							if($Tkod <> 0){
								echo"
									<div class='section'>
										<ul class='system_messages'>
											<li class='yellow'><span class='ico'></span><strong class='system_title'>Kod '$kod' sudah digunakan !</strong> </li>
										</ul>
									</div>";
							}
							if($Tcat==0 && $Tkod ==0){
								$updateCat= "UPDATE  kategori set nama='$jenis', kod='$kod'  WHERE id = '$IdKategori'";
								$result = $db->sql_query($updateCat);
								
								if ($result){	
								
									//	Display success																			
									echo'
									<div class="section">
										<ul class="system_messages">
											<li class="green"><span class="ico"></span><strong class="system_title">Sub Kategori berjaya dikemaskinikan !</strong></li>
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
								<h2>KEMASKINI JENIS</h2>
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
						<?php
						$id= "";
						if(isset($_GET['id']))
							$id = mysql_real_escape_string($_GET['id']); 
						/* Get data. */
						$qCat= "select * from kategori where id = '$id'  ";
						$rCat = $db->sql_list($qCat);
						?>
						
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
										<?php
											$parentID = $rCat['parent_id'];
											$qList= "select a.* from kategori a , kategori b where a.id = b.parent_id and b.id  = '$parentID' ";
											$rList = $db->sql_list($qList);
											
										?>
										<span class="input_wrapper" style="border:none; width: 430px;" ><input readonly class="text" name="kategori" type="text" value="<?php echo $rList['nama']; ?>" /></span>
									</div>
								</div>
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>SUBKATEGORI:</label>
									<div class="inputs">
										<span class="input_wrapper select_wrapper" style ="width:440px; ">
											
											<select name="subkategori" id="subkategori">
												<?php
												$parentID = $rCat['parent_id'];
												$rListS= "select a.* from kategori a , kategori b where a.id = b.parent_id and b.id  = '$parentID' ";
												$rListS = $db->sql_list($rListS);
												
												$parentID2 = $rListS['id'];
												
												$qListD= "select * from kategori where  parent_id  = '$parentID2' ";
												$rListD = $db->sql_fetch($qListD);
												echo '<option value="" '; if($parentID=="") echo 'selected'; echo'>Sila Pilih</option>';
												foreach ($rListD as $i) {
													echo '<option value="'.$i['id'].'" '; if($parentID== $i['id']) echo 'selected'; echo'>'.$i['nama'].'</option>';
												}
												?>
											</select>
										</span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>JENIS:</label>
									<div class="inputs">
										<span class="input_wrapper"  style="width: 430px;" ><input class="text alphaonly" name="jenis" type="text" value="<?php echo $rCat['nama']; ?>" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>KOD:</label>
									<div class="inputs">
										<span class="input_wrapper"><input maxlength="3" class="text numbersOnly" name="kod" type="text" value="<?php echo $rCat['kod']; ?>"/></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<div class="inputs">
										<input name="IdKategori"  class="text" value="<?php  echo $rCat['id']; ?>" type="hidden"  />
										<input name="OriJenis"  class="text" value="<?php  echo $rCat['nama']; ?>" type="hidden"  />
										<input name="OriKod"  class="text" value="<?php  echo $rCat['kod']; ?>" type="hidden"  />
										<input name="IdParentKategori"  class="text" value="<?php  echo $rCat['parent_id']; ?>" type="hidden"  />
										<input name="OriLevel"  class="text" value="<?php  echo $rCat['level']; ?>" type="hidden"  />
										
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