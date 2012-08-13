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
						$OriKategori = mysql_real_escape_string($_POST['OriKategori']);
						$OriKod = mysql_real_escape_string($_POST['OriKod']);
						$OriLevel = mysql_real_escape_string($_POST['OriLevel']);
						
						$notvalid = false;
						if(empty($_POST['subkategori'])){
							$errors[] = 'Sila masukkan sub kategori';
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
							$subkategori = strtoupper(mysql_real_escape_string($_POST['subkategori'])); 
							$kod = strtoupper(mysql_real_escape_string($_POST['kod'])); 
							
							$Tcat=0;
							if($OriKategori != $subkategori ){
								$Qcat = "SELECT count(*) from kategori where nama = '$subkategori' and parent_id='$IdParentKategori'";
								$Tcat = $db->sql_total($Qcat);
							}
							
							$Tkod = 0;
							if($OriKod != $kod){
								$Qkod = "SELECT count(*) from kategori where kod = '$kod' and parent_id='$IdParentKategori' and level = '1' ";
								$Tkod = $db->sql_total($Qkod);	
							
							}
								
							if($Tcat <> 0){
								echo"
									<div class='section'>
										<ul class='system_messages'>
											<li class='yellow'><span class='ico'></span><strong class='system_title'>Sub Kategori '$subkategori' sudah digunakan !</strong> </li>
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
								$updateCat= "UPDATE  kategori set nama='$subkategori', kod='$kod'  WHERE id = '$IdKategori'";
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
								<h2>Kemaskini Sub Kategori</h2>
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
											$qList= "select * from kategori where id  = '$parentID' ";
											$rList = $db->sql_list($qList);
										?>
										<span class="input_wrapper" style="border:none; width: 430px;" ><input readonly class="text" name="kategori" type="text" value="<?php echo $rList['nama']; ?>" /></span>
									</div>
								</div>
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>SUB KATEGORI:</label>
									<div class="inputs">
										<span class="input_wrapper" style=" width: 430px;"><input class="text alphaonly" name="subkategori" type="text" value="<?php echo $rCat['nama']; ?>" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>KOD:</label>
									<div class="inputs">
										<span class="input_wrapper"><input maxlength="3" class="text numbersOnly" name="kod" type="text" value="<?php echo $rCat['kod']; ?>" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<div class="inputs">
										<input name="IdKategori"  class="text" value="<?php  echo $rCat['id']; ?>" type="hidden"  />
										<input name="OriKategori"  class="text" value="<?php  echo $rCat['nama']; ?>" type="hidden"  />
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