<?php 
include('common.php');
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



<script type="text/javascript" src="../js/behaviour.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
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
						<li class="welcome">Selamat Datang <strong>Administrator </strong></li>
						
						<li>
							<ul id="user_access">
								<li class="first"><a href="#">Akaun Saya</a></li>
								<li class="last"><a href="#">Log Keluar</a></li>
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
			function curPageName() {
			 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
			}
			$curPageName=curPageName();
			//echo "<br/>The current page name is ".curPageName();
		?>
		
		<!--[if !IE]>start main menu<![endif]-->
		<div id="main_menu">
			<div class="inner">
			<ul>
				<li>
				    <?php
					$pegawai = substr($curPageName, 0, 8); //aPegawai
					?>
					<a href="aPegawai.php" <?php if($pegawai == 'aPegawai') echo 'class="selected_lk"'; ?> >
						<span class="l"><span></span></span><span class="m"><em>Pegawai Aset</em><span></span></span><span class="r"><span></span></span>
					</a>
					<?php if($pegawai == 'aPegawai'){ ?>
					<ul>
						<li>
							<a href="aPegawai.php"  <?php if($curPageName=='aPegawai.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Senarai Pegawai Aset</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<li>
							<a href="aPegawaiDaftar.php" <?php if($curPageName=='aPegawaiDaftar.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Daftar Pegawai Aset</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php 
						if($curPageName=='aPegawaiKemaskini.php') { ?>
						<li>
							<a href="aPegawaiDaftar.php" <?php if($curPageName=='aPegawaiKemaskini.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Kemaskini Pegawai Aset</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php } ?>
					</ul>
					<?php } ?>
				</li>
				<li>
					<?php
					$pembekal = substr($curPageName, 0, 9); //aPegawai
					?>
					<a href="aPembekal.php" <?php if($pembekal=='aPembekal') echo 'class="selected_lk"'; ?> >
						<span class="l"><span></span></span><span class="m"><em>Pembekal</em><span></span></span><span class="r"><span></span></span>
					</a>
					<?php if($pembekal=='aPembekal') {?>
					<ul>
						<li>
							<a href="aPembekal.php"  <?php if($curPageName=='aPembekal.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Senarai Pembekal</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<li>
							<a href="aPembekalDaftar.php" <?php if($curPageName=='aPembekalDaftar.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Daftar Pembekal</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php 
						if($curPageName=='aPembekalPapar.php') { ?>
						<li>
							<a href="aPembekalPapar.php" <?php if($curPageName=='aPembekalPapar.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Papar Pembekal</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php } ?>
						<?php 
						if($curPageName=='aPembekalKemaskini.php') { ?>
						<li>
							<a href="aPembekalKemaskini.php" <?php if($curPageName=='aPembekalKemaskini.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Kemaskini Pembekal</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php } ?>
					</ul>
					<?php } ?>
				</li>
				<li>
					<?php
					$cat = substr($curPageName, 0, 9); //aKategori
					?>
					<a href="aKategori.php" <?php if($cat=='aKategori') echo 'class="selected_lk"'; ?> >
						<span class="l"><span></span></span><span class="m"><em>Kategori Aset</em><span></span></span><span class="r"><span></span></span>
					</a>
					<?php if($cat=='aKategori')  {?>
					<ul>
						<li>
							<a href="aKategori.php"  <?php if($curPageName=='aKategori.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Senarai Kategori</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<li>
							<a href="aKategoriDaftar.php" <?php if($curPageName=='aKategoriDaftar.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Daftar Kategori</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<li>
							<a href="aKategoriSubDaftar.php" <?php if($curPageName=='aKategoriSubDaftar.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Daftar Sub Kategori</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php 
						if($curPageName=='aKategoriKemaskini.php') { ?>
						<li>
							<a href="aKategoriKemaskini.php" <?php if($curPageName=='aKategoriKemaskini.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Kemaskini Kategori</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php } ?>
						<?php 
						if($curPageName=='aKategoriSubKemaskini.php') { ?>
						<li>
							<a href="aKategoriSubKemaskini.php" <?php if($curPageName=='aKategoriSubKemaskini.php') echo 'class="selected_lk"'; ?>>
								<span class="l"><span></span></span><span class="m"><em>Kemaskini Sub Kategori</em><span></span></span><span class="r"><span></span></span>
							</a>
						</li>
						<?php } ?>
					</ul>
					<?php } ?>
				</li>
				
				<li style="float:right;"><a href="logout.php" ><span class="l"><span></span></span><span class="m"><em>Log Keluar</em><span></span></span><span class="r"><span></span></span></a>
					<!--ul>
						<li><a href="#" ><span class="l"><span></span></span><span class="m"><em>Kategori Baru</em><span></span></span><span class="r"><span></span></span></a></li>
						<li><a href="#"><span class="l"><span></span></span><span class="m"><em>Senarai Kategori</em><span></span></span><span class="r"><span></span></span></a></li>
					</ul-->
				</li>
				<li style="float:right;"><a href="#" ><span class="l"><span></span></span><span class="m"><em>Akaun Saya</em><span></span></span><span class="r"><span></span></span></a>
					<!--ul>
						<li><a href="#" ><span class="l"><span></span></span><span class="m"><em>Kategori Baru</em><span></span></span><span class="r"><span></span></span></a></li>
						<li><a href="#"><span class="l"><span></span></span><span class="m"><em>Senarai Kategori</em><span></span></span><span class="r"><span></span></span></a></li>
					</ul-->
				</li>
				
			</ul>
			</div>
			<span class="sub_bg"></span>
		</div>
		<!--[if !IE]>end main menu<![endif]-->
		
		</div>
		<!--[if !IE]>end header main menu<![endif]-->