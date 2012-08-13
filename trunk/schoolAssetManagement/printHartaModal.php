<?php  
	include('common.php'); 
	$id = "";
	if(!isset($_GET['id'])){
	?>
	<script>
		window.close();
	</script>
	<?php
	}else{
		$id =$_GET['id'];
	}
	
	$rHmodal= "select * from  hartamodal	where id = '$id' ";
	$rHmodal = $db->sql_list($rHmodal);
?>

<html>
<head></head>
<style type="text/css" media="print, handheld">
</style>
<body >
	<br/>
	<table width="700" border="0" cellspacing="0" cellpadding="0" style="font-size:12px;">
		<tr>
			<td colspan="8" align="right" style="font-weight:bold;">KEW-PA-2</td>
		</tr>
		<tr>
			<td colspan="4" >&nbsp;</td>
			<td colspan="4" align="right">(No. Siri Pendaftaran : <?php echo $rHmodal['no_siri_daftar']; ?>)</td>
		</tr>
		<tr>
			<td colspan="8"></td>
		</tr>
		<tr>
			<td colspan="8" align="center" style="font-weight:bold;">DAFTAR MODAL</td>
		
		</tr>
		<tr>
			<td colspan="8" ></td>
		</tr>
		<tr>
			<td colspan="2" width="20%">Kementerian/Jabatan : </td>
			<td colspan="6" ><?php echo $rHmodal['kementerian']; ?></td>
		</tr>
		<tr>
			<td colspan="2" >Bahagian : </td>
			<td colspan="6" ><?php echo $rHmodal['bahagian']; ?></td>
		</tr>
		<tr>
			<td colspan="8"></td>
		</tr>
		<tr>
			<td colspan="8" align="center" style="font-weight:bold;">BAHAGIAN A</td>
		
		</tr>
		<tr>
			<td colspan="8"></td>
		</tr>
	</table>
	<table width="700" border="1" cellspacing="0" cellpadding="0" style="font-size:12px;">
		<tr>
			<td colspan="2" >Kod Nasional: </td>
			<td colspan="6" ><?php echo $rHmodal['kod_nasional']; ?></td>
		</tr>
		<tr>
			<td colspan="2" >Kategori </td>
			<?php
				$kategoriID = 	$rHmodal['kategori_id'];						
				$qList= "select * from kategori where parent_id is null OR parent_id = '' and id='$kategoriID' ";
				$rList = $db->sql_list($qList);
				$kategori = $rList['kod'].' - '.$rList['nama'];
			?>
			<td colspan="6" ><?php echo $kategori; ?></td>
		</tr>
		<tr>
			<td colspan="2" >Sub Kategori </td>
			<?php
				$subkategoriID = 	$rHmodal['sub_kategori_id'];						
				$qList= "select * from kategori where  id='$subkategoriID' ";
				$rList = $db->sql_list($qList);
				$subkategori = $rList['kod'].' - '.$rList['nama'];
			?>
			<td colspan="6" ><?php echo $subkategori; ?></td>
		</tr>
		<tr>
			<td colspan="2" >Jenis/Jenama/Model </td>
			<?php
				$jenisID = 	$rHmodal['jenis_id'];						
				$qList= "select * from kategori where  id='$jenisID' ";
				$rList = $db->sql_list($qList);
				$jenis = $rList['kod'].' - '.$rList['nama'];
			?>
			<td colspan="6" ><?php echo $jenis; ?></td>
		</tr>
		<tr>
			<td colspan="2" >Buatan </td>
			<td colspan="2" ><?php echo $rHmodal['buatan']; ?></td>
			<td colspan="2" >Harga Perolehan Asal </td>
			<td colspan="2" >RM<?php echo $rHmodal['harga_perolehan_asal']; ?></td>
		</tr>
		<tr>
			<td colspan="2" >Jenis dan No. Enjin </td>
			<td colspan="2" ><?php echo $rHmodal['jenis_no_enjin']; ?></td>
			<td colspan="2" >Tarikh Diterima </td>
			<td colspan="2" ><?php echo changeDateBeginDay($rHmodal['tarikh_terima']); ?></td>
		</tr>
		<tr>
			<td colspan="2" >No. Casis/Siri Pembuat </td>
			<td colspan="2" ><?php echo $rHmodal['no_casis']; ?></td>
			<td colspan="2" width="100">No. Pesanan Rasmi Kerajaan</td>
			<td colspan="2" ><?php echo $rHmodal['no_pesanan']; ?></td>
		</tr>
		<tr>
			<td colspan="2" width="120">No. Pendaftaran (Bagi Kenderaan) </td>
			<td colspan="2" ><?php echo $rHmodal['no_pendaftaran']; ?></td>
			<td colspan="2" >Tempoh Jaminan</td>
			<td colspan="2" ><?php echo $rHmodal['tempoh_jaminan']; ?></td>
		</tr>
		<tr>
			<td colspan="4" rowspan ="6" valign="top">KOMPONEN/AKSESORI
				<br/><?php echo $rHmodal['komponen']; ?> </td>
			<td colspan="2">Nama Pembekal </td>
			<?php
				$pembekalID =  $rHmodal['pembekal_id'];
				$qList= "select * from pembekal  where id ='$pembekalID'  ";
				$rList = $db->sql_list($qList);
			?>
			<td colspan="2"><?php echo $rList['nama'].' ('.$rList['no_daftar'].')'; ?></td>
		</tr>
		<tr>
			<td colspan="2" rowspan="2" valign="top">Alamat</td>
			<td colspan="2" rowspan="2" valign="top"> 
				<?php echo $rList['alamat']; ?>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
			<td colspan="2">Nama Pegawai </td>
			<?php
				$penggunaID =  $rHmodal['pengguna_id'];
				$qList= "select * from pengguna  where id ='$penggunaID'  ";
				$rList = $db->sql_list($qList);
			?>
			<td colspan="2"><?php echo $rList['nama']; ?></td>
		</tr>
		<tr>
			<td colspan="2">Jawatan </td>
			<td colspan="2"><?php echo $rList['jawatan']; ?></td>
		</tr>
		<tr>
			<td colspan="2">Tarikh </td>
			<td colspan="2"><?php echo changeDateBeginDay($rHmodal['tarikh_daftar']); ?></td>
		</tr>
		
	</table>
	<br/>
	<table width="700" border="1" cellspacing="0" cellpadding="0" style="font-size:12px;">
		<tr>
			<td colspan="3" align="center" bgcolor="lightgray" style="font-weight:bold;">PENEMPATAN</td>
		</tr>
		<?php  

			/* Get data. */
			$qList= "select p.id, p.lokasi, p.tarikh, u.nama from  penempatan p , hartamodal h, pengguna u where
					p.pengguna_id=u.id
					and p.harta_modal_id=h.id
					and harta_modal_id = '$id'  
						 order by p.tarikh_daftar desc  ";
			$rList = $db->sql_fetch($qList);			

		?>
		<tr align="center">
			<td>Lokasi</td>
			<td>Tarikh</td>
			<td>Nama Pegawai</td>
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
						<td>'.$i['1'].'</td>
						<td>'.changeDateBeginDay($i['2']).'</td>
						<td>'.strtoupper($i['3']).'</td>
					</tr>';
				
			}
		?>
	</table>
	<br/>
	<table width="700" border="1" cellspacing="0" cellpadding="0" style="font-size:12px;">
		<tr>
			<td colspan="3" align="center" bgcolor="lightgray" style="font-weight:bold;">PEMERIKSAAN</td>
		</tr>
		<tr align="center">
			<td>Tarikh</td>
			<td>Status</td>
			<td>Nama Pegawai</td>
		</tr>
		<?php  

			/* Get data. */
			$qList= "select p.id, p.status_aset, p.tarikh, u.nama from  pemeriksaan p , hartamodal h, pengguna u where
					p.pengguna_id=u.id
					and p.harta_modal_id=h.id
					and harta_modal_id = '$id'  
						 order by p.tarikh_daftar desc  ";
			$rList = $db->sql_fetch($qList);			

		?>
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
						<td>'.changeDateBeginDay($i['2']).'</td>
						<td>'.$i['1'].'</td>
						<td>'.$i['3'].'</td>
					</tr>';
				
			}
			?>
	</table>
	<br/>
	<table width="700" border="1" cellspacing="0" cellpadding="0" style="font-size:12px;">
		<tr>
			<td colspan="4" align="center" bgcolor="lightgray" style="font-weight:bold;">PELUPUSAN/HAPUS KIRA</td>
		</tr>
		<tr align="center">
			<td>Rujukan Lulusan</td>
			<td>Tarikh</td>
			<td>Kaedah Pelupusan</td>
			<td>Nama Pegawai</td>
		</tr>
		<?php  

			/* Get data. */
			$qList= "select p.id, p.rujukan, p.tarikh, p.kaedah,u.nama from  pelupusan p , hartamodal h, pengguna u where
					p.pengguna_id=u.id
					and p.harta_modal_id=h.id
					and harta_modal_id = '$id'  
						 order by p.tarikh_daftar desc  ";
			$rList = $db->sql_fetch($qList);			

		?>
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
						<td>'.$i['1'].'</td>
						<td>'.changeDateBeginDay($i['2']).'</td>
						<td>'.$i['3'].'</td>
						<td>'.$i['4'].'</td>
					</tr>';
				
			}
		?>
	</table>
	<br/>
	<br/>
	<br/>
</body>
</html>