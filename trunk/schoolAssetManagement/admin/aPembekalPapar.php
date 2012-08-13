<?php
	include('header.php');
?>
		<!--[if !IE]>start content<![endif]-->
		<div id="content">
			<div class="inner">
				
				<!--[if !IE]>start section<![endif]-->
				<?php
					$id = mysql_real_escape_string($_GET['id']); 
					/* Get data. */
					$qPembekal= "select * from pembekal where id = '$id'  ";
					$rPembekal = $db->sql_list($qPembekal);
				
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
								<h2>Papar Pembekal</h2>
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

						<form action="" method="POST"  class="search_form general_form">
							<!--[if !IE]>start fieldset<![endif]-->
							<fieldset>
								<!--[if !IE]>start forms<![endif]-->
								<div class="forms">
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Nama Syarikat:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none;"><input class="text" readonly name="namasyarikat" type="text" value="<?php echo $rPembekal['nama']; ?>" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>No. Pendaftaran Syarikat:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none;"><input class="text" readonly name="nodaftar" type="text" value="<?php echo $rPembekal['no_daftar']; ?>" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>No. Pendaftaran </label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none;"><input class="text" readonly name="nodaftarkewangan" type="text" value="<?php echo $rPembekal['no_daftar_kementerian']; ?>" /></span>
									</div>
									<label>Kementerian Kewangan:</label>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Jenis Pembekal:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none;"><input class="text" readonly name="jenis" type="text" value="<?php echo $rPembekal['jenis']; ?>"/></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Alamat:</label>
									<div class="inputs">
										<span class="input_wrapper textarea_wrapper" style=" height: 60px; width:300px;" style="border:none;">
											<textarea readonly rows="" cols="" class="text" name="alamat" style="overflow:hidden;" ><?php echo $rPembekal['alamat']; ?></textarea>
										</span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>No. Telefon:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none;"><input class="text" readonly name="notel" type="text" value="<?php echo $rPembekal['tel_no']; ?>" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>No. FAX:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none;"><input class="text" readonly name="nofax" type="text" value="<?php echo $rPembekal['fax_no']; ?>" /></span>
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