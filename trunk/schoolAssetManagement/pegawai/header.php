<?php 
include('../common.php');
if($_SESSION['islogin'] != 'yes' && $_SESSION['peranan'] != 'pegawai')
		header( 'Location: ../logout.php' ) ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<title>Sistem Pengurusan Aset Sekolah</title>
<link media="screen" rel="stylesheet" type="text/css" href="../css/admin.css"  />
<!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
<!-- aurora-theme is default -->

<link media="screen" rel="stylesheet" type="text/css" href="../css/admin-blue.css"  />
<link type="text/css" href="../css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	


<script type="text/javascript" src="../js/behaviour.js"></script>
<script type="text/javascript" src="../js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.16.custom.min.js"></script>
<script>
	$(function() {
		$('.delete').click(function () { 
			if(confirmation()){
				return true;
			}
			else{
				return false;
			}
		});
	});
	
	function confirmation() {
			var answer = confirm("Anda pasti mahu hapuskan rekod ini?")
			if (answer){
				return true;
			}
			else{
				return false;
			}
	}
</script>
</head>

<body>

	<!--[if !IE]>start wrapper<![endif]-->
	<div id="wrapper">
		
		
		<!--[if !IE]>start header main menu<![endif]-->
		
		<div id="header_main_menu">
		<span id="header_main_menu_bg"></span>
		
		<!--[if !IE]>start header<![endif]-->
		<div id="header">
			<div class="inner">
				<h1 id="logo"><a href="#">Sistem Pengurusan Aset Sekolah<span>Panel Pengurusan</span></a></h1>
				
				<!--[if !IE]>start user details<![endif]-->
				<div id="user_details">
					<ul id="user_details_menu">
						<li class="welcome">Selamat Datang <strong><?php echo $_SESSION['name']; ?></strong></li>
						
						<li>
							<ul id="user_access">
								<li class="first"><a href="pAkaun.php?id=<?php echo $_SESSION['userlogin_id']; ?>">Akaun Saya</a></li>
								<li class="last"><a href="../logout.php">Log Keluar</a></li>
							</ul>
						</li>
						
						
					</ul>
					
					<div id="server_details">
						<dl>
							<dt>Server time :</dt>
							<dd><?php echo $today = date("F j, Y, g:i a"); ?></dd>
						</dl>
						<dl>
							<dt>Login ip :</dt>
							<dd><?php  echo $_SERVER['REMOTE_ADDR']; ?></dd>
						</dl>
					</div>
					
				</div>
				
				<!--[if !IE]>end user details<![endif]-->
			</div>
		</div>
		<!--[if !IE]>end header<![endif]-->
		
		<?php
			$curPageName=curPageName();
			//echo "<br/>The current page name is ".curPageName();
		?>
		
		<!--[if !IE]>start main menu<![endif]-->
		<div id="main_menu">
			<div class="inner">
			<ul>
				<li>
				    <?php
					$pPenerimaan = substr($curPageName, 0, 11); //aPenerimaan
					?>
					<a href="pPenerimaan.php" <?php if($pPenerimaan == 'pPenerimaan') echo 'class="selected_lk"'; ?> >
						<span class="l"><span></span></span><span class="m"><em>Penerimaan Aset</em><span></span></span><span class="r"><span></span></span>
					</a>
					<?php if($pPenerimaan == 'pPenerimaan'){ ?>
					<ul>
						<li>
							<a href="pPenerimaan.php"  <?php if($curPageName=='pPenerimaan.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Senarai Penerimaan Aset</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<li>
							<a href="pPenerimaanDaftar.php" <?php if($curPageName=='pPenerimaanDaftar.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Daftar Penerimaan Aset</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php 
						if($curPageName=='pPenerimaanKemaskini.php') { ?>
						<li>
							<a href="pPenerimaanKemaskini.php" <?php if($curPageName=='pPenerimaanKemaskini.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Kemaskini Penerimaan Aset</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php } ?>
						<?php 
						if($curPageName=='pPenerimaanPapar.php') { ?>
						<li>
							<a href="pPenerimaanPapar.php" <?php if($curPageName=='pPenerimaanPapar.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Papar Penerimaan Aset</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php } ?>
					</ul>
					<?php } ?>
				</li>
				<li>
					<?php
					 $hartamodal = substr($curPageName, 0, 11); //aPegawai
					?>
					<a href="pHartamodal.php" <?php if($hartamodal=='pHartamodal') echo 'class="selected_lk"'; ?> >
						<span class="l"><span></span></span><span class="m"><em>Harta Modal</em><span></span></span><span class="r"><span></span></span>
					</a>
					<?php if($hartamodal=='pHartamodal') {?>
					<ul>
						<li>
							<a href="pHartamodal.php"  <?php if($curPageName=='pHartamodal.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Senarai Harta Modal</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<li>
							<a href="pHartamodalDaftar.php" <?php if($curPageName=='pHartamodalDaftar.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Daftar Harta Modal</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php 
						if($curPageName=='pHartamodalPapar.php') { ?>
						<li>
							<a href="pHartamodalPapar.php" <?php if($curPageName=='pHartamodalPapar.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Papar Harta Modal</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php } ?>
						<?php 
						if($curPageName=='pHartamodalKemaskini.php') { ?>
						<li>
							<a href="pHartamodalKemaskini.php" <?php if($curPageName=='pHartamodalKemaskini.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Kemaskini Harta Modal</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php } ?>
						<?php 
						if($curPageName=='pHartamodalPenempatan.php') { ?>
						<li>
							<a href="pHartamodalPenempatan.php" <?php if($curPageName=='pHartamodalPenempatan.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Daftar Harta Modal (Penempatan)</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php } ?>
						<?php 
						if($curPageName=='pHartamodalPenempatanKemaskini.php') { ?>
						<li>
							<a href="pHartamodalPenempatanKemaskini.php" <?php if($curPageName=='pHartamodalPenempatanKemaskini.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Kemaskini Harta Modal (Penempatan)</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php } ?>
						<?php 
						if($curPageName=='pHartamodalPemeriksaan.php') { ?>
						<li>
							<a href="pHartamodalPemeriksaan.php" <?php if($curPageName=='pHartamodalPemeriksaan.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Daftar Harta Modal (Pemeriksaan)</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php } ?>
						<?php 
						if($curPageName=='pHartamodalPemeriksaanKemaskini.php') { ?>
						<li>
							<a href="pHartamodalPemeriksaanKemaskini.php" <?php if($curPageName=='pHartamodalPemeriksaanKemaskini.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Kemaskini Harta Modal (Pemeriksaan)</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php } ?>
						<?php 
						if($curPageName=='pHartamodalPelupusan.php') { ?>
						<li>
							<a href="pHartamodalPelupusan.php" <?php if($curPageName=='pHartamodalPelupusan.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Daftar Harta Modal (Pelupusan)</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php } ?>
						<?php 
						if($curPageName=='pHartamodalPelupusanKemaskini.php') { ?>
						<li>
							<a href="pHartamodalPelupusanKemaskini.php" <?php if($curPageName=='pHartamodalPelupusanKemaskini.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Kemaskini Harta Modal (Pelupusan)</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php } ?>
						
					</ul>
					<?php } ?>
				</li>
				<li>
					<?php
					$inv = substr($curPageName, 0, 10); //pInventori
					?>
					<a href="pInventori.php" <?php if($inv=='pInventori') echo 'class="selected_lk"'; ?> >
						<span class="l"><span></span></span><span class="m"><em>Inventori</em><span></span></span><span class="r"><span></span></span>
					</a>
					<?php if($inv=='pInventori')  {?>
					<ul>
						<li>
							<a href="pInventori.php"  <?php if($curPageName=='pInventori.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Senarai Inventori</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<li>
							<a href="pInventoriDaftar.php" <?php if($curPageName=='pInventoriDaftar.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Daftar Inventori</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php 
						if($curPageName=='pInventoriPapar.php') { ?>
						<li>
							<a href="pInventoriPapar.php" <?php if($curPageName=='pInventoriPapar.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Papar Inventori</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php } ?>
						<?php 
						if($curPageName=='pInventoriKemaskini.php') { ?>
						<li>
							<a href="pInventoriKemaskini.php" <?php if($curPageName=='pInventoriKemaskini.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Kemaskini Inventori</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php } ?>
						<?php 
						if($curPageName=='pInventoriPenempatan.php') { ?>
						<li>
							<a href="pInventoriPenempatan.php" <?php if($curPageName=='pInventoriPenempatan.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Daftar Inventori (Penempatan)</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php } ?>
						<?php 
						if($curPageName=='pInventoriPenempatanKemaskini.php') { ?>
						<li>
							<a href="pInventoriPenempatanKemaskini.php" <?php if($curPageName=='pInventoriPenempatanKemaskini.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Kemaskini Inventori (Penempatan)</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php } ?>
						<?php 
						if($curPageName=='pInventoriPemeriksaan.php') { ?>
						<li>
							<a href="pInventoriPemeriksaan.php" <?php if($curPageName=='pInventoriPemeriksaan.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Daftar Inventori (Pemeriksaan)</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php } ?>
						<?php 
						if($curPageName=='pInventoriPemeriksaanKemaskini.php') { ?>
						<li>
							<a href="pInventoriPemeriksaanKemaskini.php" <?php if($curPageName=='pInventoriPemeriksaanKemaskini.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Kemaskini Inventori (Pemeriksaan)</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php } ?>
						<?php 
						if($curPageName=='pInventoriPelupusan.php') { ?>
						<li>
							<a href="pInventoriPelupusan.php" <?php if($curPageName=='pInventoriPelupusan.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Daftar Inventori (Pelupusan)</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php } ?>
						<?php 
						if($curPageName=='pInventoriPelupusanKemaskini.php') { ?>
						<li>
							<a href="pInventoriPelupusanKemaskini.php" <?php if($curPageName=='pInventoriPelupusanKemaskini.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Kemaskini Inventori (Pelupusan)</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php } ?>
						
					</ul>
					<?php } ?>
				</li>
				<li>
				    <?php
					$pLaporan = substr($curPageName, 0, 8); //pLaporan
					?>
					<a href="pLaporanHartamodal.php" <?php if($pLaporan == 'pLaporan') echo 'class="selected_lk"'; ?> >
						<span class="l"><span></span></span><span class="m"><em>Laporan</em><span></span></span><span class="r"><span></span></span>
					</a>
					<?php if($pLaporan == 'pLaporan'){ ?>
					<ul>
						<li>
							<a href="pLaporanHartamodal.php"  <?php if($curPageName=='pLaporanHartamodal.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Senarai Harta Modal</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<li>
							<a href="pLaporanInventori.php" <?php if($curPageName=='pLaporanInventori.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Senarai Inventori</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<li>
							<a href="pLaporanTahunanAset.php" <?php if($curPageName=='pLaporanTahunanAset.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Laporan Tahunan Aset</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
					</ul>
					<?php } ?>
				</li>
				
				<li>
				    <?php
					$pLabelAset = substr($curPageName, 0, 10); //pLabelAset
					?>
					<a href="pLabelAsetHartamodal.php" <?php if($pLabelAset == 'pLabelAset') echo 'class="selected_lk"'; ?> >
						<span class="l"><span></span></span><span class="m"><em>Pelabelan Aset</em><span></span></span><span class="r"><span></span></span>
					</a>
					<?php if($pLabelAset == 'pLabelAset'){ ?>
					<ul>
						<li>
							<a href="pLabelAsetHartamodal.php"  <?php if($curPageName=='pLabelAsetHartamodal.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Label Harta Modal</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<li>
							<a href="pLabelAsetInventori.php" <?php if($curPageName=='pLabelAsetInventori.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Label Inventori</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
					</ul>
					<?php } ?>
				</li>
				
				<li style="float:right;"><a href="../logout.php" ><span class="l"><span></span></span><span class="m"><em>Log Keluar</em><span></span></span><span class="r"><span></span></span></a>
				
				</li>
				<li style="float:right;">
					<?php
					$pAkaun = substr($curPageName, 0, 6); //pAkaun
					?>
					<a href="pAkaun.php?id=<?php echo $_SESSION['userlogin_id']; ?>" <?php if($pAkaun == 'pAkaun') echo 'class="selected_lk"'; ?> >
						<span class="l"><span></span></span><span class="m"><em>Akaun Saya</em><span></span></span><span class="r"><span></span></span>
					</a>
					<?php if($pAkaun == 'pAkaun'){ ?>
					<ul>
						<li>
							<a href="pAkaun.php"  <?php if($curPageName=='pAkaun.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Papar/Kemaskini Akaun Saya</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<li>
							<a href="pAkaunTukarPass.php" <?php if($curPageName=='pAkaunTukarPass.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Tukar Kata Laluan</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
					</ul>
					<?php } ?>
				</li>
				
			</ul>
			</div>
			<span class="sub_bg"></span>
		</div>
		<!--[if !IE]>end main menu<![endif]-->
		
		</div>
		<!--[if !IE]>end header main menu<![endif]-->