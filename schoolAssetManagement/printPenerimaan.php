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

	$qPem= "select * from pembekal where id ='$id' ";
	$rPem = $db->sql_list($qPem);
								
								
	$qList= "select * from  penerimaan where pembekal_id = '$id' 
				 order by tarikh_daftar desc ";
	$rList = $db->sql_fetch($qList);	
?>

<html>
<head></head>
<style type="text/css" media="print, handheld">
</style>
<body >
	<br/>
	<table width="700" border="0" cellspacing="0" cellpadding="0" style="font-size:12px;">
		<tr>
			<td colspan="8" align="right" style="font-weight:bold;">KEW-PA-1</td>
		</tr>
		<tr>
			<td colspan="8"></td>
		</tr>
		<tr>
			<td colspan="8" align="center" style="font-weight:bold;">BORANG LAPORAN PENERIMAAN ASET ALIH KERAJAAN</td>
		
		</tr>
		<tr>
			<td colspan="8" ></td>
		</tr>
	</table>
	<br />
	<table width="700" border="0" cellspacing="0" cellpadding="0" style="font-size:12px;">
		<tr>
			<td colspan="3" width="150" align="left" style="padding-left:10px; font-weight:bold;">Nama Pembekal</td>
			<td  align="left" width="5" style="font-weight:bold;">:</td>
			<td colspan="4" width="645" align="left" style="padding-left:10px;font-weight:normal;"><?php  echo $rPem['nama']; ?></td>
		</tr>
		<tr>
			<td colspan="8"></td>
		</tr>
		<tr>
			<td colspan="3" align="left" style="padding-left:10px; font-weight:bold;">Alamat Pembekal</td>
			<td  align="left" style="font-weight:bold;">:</td>
			<td colspan="4" align="left" style="padding-left:10px;font-weight:normal;"><?php echo $rPem['alamat']; ?></td>
		</tr>
		<tr>
			<td colspan="8" ></td>
		</tr>
		<tr>
			<td colspan="3" align="left" style="padding-left:10px; font-weight:bold;">No. Telefon</td>
			<td  align="left" style="font-weight:bold;">:</td>
			<td colspan="4" align="left" style="padding-left:10px;font-weight:normal;"><?php echo $rPem['tel_no']; ?></td>
		</tr>
		<tr>
			<td colspan="8" ></td>
		</tr>
		<tr>
			<td colspan="3" align="left" style="padding-left:10px; font-weight:bold;">No. Faks</td>
			<td  align="left" style="font-weight:bold;">:</td>
			<td colspan="4" align="left" style="padding-left:10px;font-weight:normal;"><?php echo $rPem['fax_no']; ?></td>
		</tr>
		<tr>
			<td colspan="8" ><br/></td>
		</tr>
	</table>
	<table width="700" border="1" cellspacing="0" cellpadding="0" style="font-size:12px;">
		<tbody>
		<tr>
			<th  rowspan="2">Bil.</th>
			<th  colspan="2">Nota Hantaran</th>
			<th  rowspan="2">Nama Aset</th>
			<th colspan="3">Kuantiti</a></th>
			<th  rowspan="2">Kerosakan</a></th>
			<th  rowspan="2">Catatan</a></th>
		</tr>
		<tr>
			<th >No.</th>
			<th >Tarikh</th>
			<th >Pesan</th>
			<th >Terima</th>
			<th >Selisih</th>
		</tr>
	<?php
		$num =0;
		foreach ($rList as $i) {
			$num++;
			if($i['no_terima'] == "") $no_terima = "&nbsp;"; else $no_terima = $i['no_terima'];
			if($i['tarikh_terima'] == "") $tarikh_terima = "&nbsp;"; else $tarikh_terima = changeDateBeginDay($i['tarikh_terima']);
			if($i['nama_aset'] == "") $nama_aset = "&nbsp;"; else $nama_aset = $i['nama_aset'];
			if($i['qty_pesan'] == "") $qty_pesan = "&nbsp;"; else $qty_pesan = $i['qty_pesan'];
			if($i['qty_terima'] == "") $qty_terima = "&nbsp;"; else $qty_terima = $i['qty_terima'];
			if($i['qty_selisih'] == "") $qty_selisih = "&nbsp;"; else $qty_selisih = $i['qty_selisih'];
			if($i['perihal_rosak'] == "") $perihal_rosak = "&nbsp;"; else $perihal_rosak = $i['perihal_rosak'];
			if($i['catatan'] == "") $catatan = "&nbsp;"; else $catatan = $i['catatan'];
			
			
			$colorRow = "first";
			if($num%2==0)
				$colorRow = "second"; 
			else
				$colorRow = "first";
		
			echo '	
				<tr class="'.$colorRow.'">
					<td style="padding-left:5px;" >'.$num.'</td>
					<td style="padding-left:5px;" >'.$no_terima.'</td>
					<td style="padding-left:5px;" >'.$tarikh_terima.'</td>
					<td style="padding-left:5px;" >'.$nama_aset.'</td>
					<td style="padding-left:5px;" >'.$qty_pesan.'</td>
					<td style="padding-left:5px;" >'.$qty_terima.'</td>
					<td style="padding-left:5px;" >'.$qty_selisih.'</td>
					<td style="padding-left:5px;" >'.$perihal_rosak.'</td>
					<td style="padding-left:5px;" >'.$catatan.'</td>
				</tr>';
			
		}
	?>
		</tbody>
	</table>
	<br/>
	<br/>
	<br/>
</body>
</html>