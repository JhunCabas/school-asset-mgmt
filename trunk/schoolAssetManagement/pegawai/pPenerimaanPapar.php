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
				
				<!--[if !IE]>end section<![endif]-->
				
				<!--[if !IE]>start section<![endif]-->
				<div class="section">
					
					<!--[if !IE]>start title wrapper<![endif]-->
					<div class="title_wrapper">
						<span class="title_wrapper_top"></span>
						<div class="title_wrapper_inner">
							<span class="title_wrapper_middle"></span>
							<div class="title_wrapper_content">
								<h2>Papar Penerimaan Aset (KEW.PA-1)</h2>
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
						$id="";
						if(isset($_GET['id'])){
							$id = mysql_real_escape_string($_GET['id']); 
						}
						$qtrima= "select * from  penerimaan where id = '$id' ";
						$rTrima = $db->sql_list($qtrima);
						
						?>
						<!--[if !IE]>start forms<![endif]-->
						<form action="" method="POST" class="search_form general_form">
							
							<!--[if !IE]>start fieldset<![endif]-->
							<fieldset>
								<!--[if !IE]>start forms<![endif]-->
								<div class="forms">
								<?php
								$idpembekal = $rTrima['pembekal_id'];
								$qPem= "select * from pembekal where id='$idpembekal'  ";
								$rPem = $db->sql_list($qPem);
								?>
								<h3>Maklumat Pembekal</h3>
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Nama Syarikat:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none;"><input readonly name="namasyarikat"  class="text" value="<?php  echo $rPem['nama']; ?>" type="text" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Alamat:</label>
									<div class="inputs">
										<span class="input_wrapper textarea_wrapper" style=" height: 60px; width:300px;" style="border:none;">
											<textarea readonly rows="" cols="" class="text" name="alamat" style="overflow:hidden;" ><?php echo $rPem['alamat']; ?></textarea>
										</span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>No. Telefon:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none;"><input readonly  class="text" value="<?php echo $rPem['tel_no']; ?>" type="text"  /></span>
										</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>No. FAX:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none;"><input readonly  class="text" value="<?php echo $rPem['fax_no']; ?>" type="text"  /></span>
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
										<span class="input_wrapper" style="border:none;"><input name="noterima"  class="text" value="<?php  echo $rTrima['no_terima']; ?>" type="text" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Tarikh Diterima:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none;"><input name="tarikhterima" id="datepicker" class="text" value="<?php echo changeDateBeginDay($rTrima['tarikh_terima']); ?>" type="text"  /></span>
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
										<span class="input_wrapper" style="border:none;"><input name="namaaset"  class="text" value="<?php echo $rTrima['nama_aset']; ?>" type="text"  /></span>
										
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
										<span class="input_wrapper" style="border:none;"><input name="qtypesan"  class="text numbersOnly" value="<?php echo $rTrima['qty_pesan']; ?>" type="text" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Diterima:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none;"><input name="qtyterima"  class="text numbersOnly" value="<?php echo $rTrima['qty_terima'];?>" type="text"  /></span>
										</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Perselisihan:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none;"><input name="qtyselisih"  class="text numbersOnly" value="<?php echo $rTrima['qty_selisih']; ?>" type="text"  /></span>
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
										<span class="input_wrapper" style="border:none;"><input name="perihalrosal"  class="text" value="<?php echo $rTrima['perihal_rosak']; ?>" type="text"  /></span>
										
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
										<span class="input_wrapper" style="border:none;"><input name="catatan"  class="text" value="<?php echo $rTrima['catatan'];?>" type="text"  /></span>
										
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