<?php
	include('header.php');
	$id = "";
	if(!isset($_GET['id'])){
	?>
	<script>
		window.history.back();
	</script>
	<?php
	}else{
		$id =$_GET['id'];
	}
?>
<?php
	$id="";
	if(isset($_GET['id'])){
	$id = mysql_real_escape_string($_GET['id']); 
	}
	$sql= "select * from  inventori	where id = '$id' ";
	$rInv = $db->sql_list($sql);

?>
<script>
	function autoPrint(data) 
    {
        var mywindow = window.open('../printInventori.php?id=<?php echo $rInv['id']; ?>', 'Print Aset', 'scrollbars=yes,width=735');

        mywindow.print();
        return true;
    }
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
				
				<!--[if !IE]>end section<![endif]-->
				
				<!--[if !IE]>start section<![endif]-->
				<div class="section">
					
					<!--[if !IE]>start title wrapper<![endif]-->
					<div class="title_wrapper">
						<span class="title_wrapper_top"></span>
						<div class="title_wrapper_inner">
							<span class="title_wrapper_middle"></span>
							<div class="title_wrapper_content">
								<h2>PAPAR INVENTORI (KEW.PA-3)</h2>
								<ul class="section_menu right">
									<li><a href="#" onclick="autoPrint(this)" >
										<span class="l"><span></span></span>
											<span class="m">
											<em><img src="../css/layout/print_icon.gif" width="12" height="12"> CETAK</em><span></span>
											</span>
											<span class="r"><span></span></span>
										</a></li>
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
									<label>NO. SIRI PENDAFTARAN:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none; width:300px;"><input name="nosiridaftaran"  readonly class="text" value="<?php echo $rInv['no_siri_daftar']; ?>" type="text" /></span>
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
									<label>KEMENTERIAN/JABATAN:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none; width:300px;"><input name="kementerian"  readonly class="text" value="<?php echo $rInv['kementerian']; ?>" type="text" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>BAHAGIAN:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none; width:300px;"><input name="bahagian"  readonly class="text" value="<?php echo $rInv['bahagian']; ?>" type="text"  /></span>
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
								<h3>Butir-butir Harta Modal</h3>
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>KAEDAH PEROLEHAN:</label>
									<div class="inputs">
										<span class="input_wrapper select_wrapper">
											<select name="kaedahperolehan" id="kaedahperolehan" disabled="disabled">
												<option value="" >Sila Pilih</option>
												<option value="DB" <?php if($rInv['kaedah_peroleh']=='DB') echo 'selected';  ?> >Beli</option>
												<option value="LH" <?php if($rInv['kaedah_peroleh']=='LH') echo 'selected';  ?>>Lucut Hak</option>
												<option value="SB" <?php if($rInv['kaedah_peroleh']=='SB') echo 'selected';  ?>>Sewa Beli</option>
												<option value="HD" <?php if($rInv['kaedah_peroleh']=='HD') echo 'selected';  ?>>Hadiah</option>
											</select>
										</span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>KOD NASIONAL:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none"><input readonly name="kodnasional"  class="text " value="<?php echo $rInv['kod_nasional']; ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>KATEGORI:</label>
									<div class="inputs">
										<span class="input_wrapper select_wrapper" style=" width: 440px;">
											
											<select name="kategori" id="kategori" disabled="disabled">
												<?php
												
												$qList= "select * from kategori where parent_id is null OR parent_id = '' ";
												$rList = $db->sql_fetch($qList);
												echo '<option value="" '; if($rInv['kategori_id']=="") echo 'selected'; echo'>Sila Pilih</option>';
												foreach ($rList as $i) {
													echo '<option value="'.$i['id'].'-'.$i['kod'].'" '; if($rInv['kategori_id']== $i['id']) echo 'selected'; echo'>'.$i['kod'].' - '.$i['nama'].'</option>';
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
											
											<select name="subkategori" id="subkategori" disabled="disabled">
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
											
											<select name="jenis" id="jenis" disabled="disabled">
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
										<span class="input_wrapper" style="border:none"><input readonly name="buatan"  class="text " value="<?php echo $rInv['kuantiti']; ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>UNIT PENGUKURAN:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none"><input readonly name="jenisnoenjin"  class="text " value="<?php echo $rInv['unit_ukur']; ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>HARGA PEROLEHAN ASAL (RM):</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none"><input readonly name="hargaasal"  class="text numbersOnly" value="<?php echo $rInv['harga_perolehan_asal']; ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>TARIKH DITERIMA:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none"><input name="tarikhterima" readonly class="text" value="<?php echo changeDateBeginDay($rInv['tarikh_terima']); ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>NO. PESANAN RASMI KERAJAAN:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none"><input readonly name="nopesananrasmi"  class="text " value="<?php echo $rInv['no_pesanan']; ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>TEMPOH JAMINAN:</label>
									<div class="inputs">
										<span class="input_wrapper" style="border:none"><input readonly name="tempohjaminan"  class="text " value="<?php echo $rInv['tempoh_jaminan']; ?>" type="text"  /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>NAMA PEMBEKAL:</label>
									<div class="inputs">
										<span class="input_wrapper select_wrapper">
											
											<select name="pembekal" id="pembekal" style=" width: 440px;" disabled="disabled">
												<?php
												$qList= "select * from pembekal  ";
												$rList = $db->sql_fetch($qList);
												echo '<option value="" '; if( $rInv['pembekal_id']=="") echo 'selected'; echo'>Sila Pilih</option>';
												foreach ($rList as $i) {
													echo '<option value="'.$i['id'].'" '; if($rInv['pembekal_id']==$i['id']) echo 'selected'; echo'>'.$i['nama'].'  ('.$i['no_daftar'].')</option>';
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
						<input name="subKategoriId" id="subKategoriId" class="text" value="<?php echo $rInv['sub_kategori_id']; ?>" type="hidden"  />
										<input name="jenisId" id="jenisId" class="text" value="<?php echo $rInv['jenis_id']; ?>" type="hidden"  />
										
						</form>
						<!--[if !IE]>end forms<![endif]-->
						<br />
						<!-- start table list-->
						<!--[if !IE]>start table_wrapper<![endif]-->
						<div class="table_wrapper">
							<div class="table_wrapper_inner">
							
								<?php  

									/* Get data. */
									$qList= "select p.id, p.kuantiti, p.lokasi, p.tarikh, u.nama from  penempatan p , Inventori h, pengguna u where
												p.pengguna_id=u.id
												and p.inventori_id=h.id
												and p.inventori_id = '$id'  
													 order by p.tarikh_daftar desc  ";
										$rList = $db->sql_fetch($qList);			

								?>
								<table cellpadding="0" cellspacing="0" width="100%">
									<tbody>
									<tr>
											<th colspan="5"  style="color:#ffffff; text-align: center; background-color:#3C3F42;" >PENEMPATAN</th>
										</tr>
									<tr>
										<th style="width: 10px;">Bil.</th>
										<th >Kuantiti</th>
										<th >Lokasi</th>
										<th style="width: 50px;">Tarikh</th>
										<th style="width: 200px;">Nama Pegawai</a></th>
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
												<td>'.$i['2'].'</td>
												<td>'.changeDateBeginDay($i['3']).'</td>
												<td>'.strtoupper($i['4']).'</td>
											</tr>';
										
									}
									?>
									</tbody>
								</table>
								<?php  

										/* Get data. */
										$qList= "select p.id, p.status_aset, p.tarikh, u.nama from  pemeriksaan p , Inventori h, pengguna u where
												p.pengguna_id=u.id
												and p.inventori_id=h.id
												and p.inventori_id = '$id'  
													 order by p.tarikh_daftar desc  ";
										$rList = $db->sql_fetch($qList);			

								?>
								<table cellpadding="0" cellspacing="0" width="100%">
									<tbody>
									<tr>
										<th colspan="4" style="color:#ffffff; text-align: center; background-color:#3C3F42;">PEMERIKSAAN</th>
									</tr>
									<tr>
										<th style="width: 10px;">Bil.</th>
										<th >Status Aset</th>
										<th style="width: 50px;">Tarikh</th>
										<th style="width: 200px;">Nama Pegawai</a></th>
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
											</tr>';
										
									}
									?>
									</tbody>
								</table>
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
											<th colspan="7" style="color:#ffffff; text-align: center; background-color:#3C3F42;">PELUPUSAN</th>
										</tr>
										<tr>
											<th style="width: 10px;">Bil.</th>
											<th >Rujukan</th>
											<th style="width: 50px;">Tarikh</th>
											<th >Kaedah</th>
											<th >Kuantiti</th>
											<th >Lokasi</th>
											<th style="width: 200px;">Nama Pegawai</a></th>
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
												</tr>';
											
										}
										?>
									</tbody>
								</table>
							</div>
							</div>
						<!--[if !IE]>end table_wrapper<![endif]-->
						
						</div>
						
						
						
						
						
						<!-- end table list-->
						
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