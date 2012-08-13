<?php
require('mysql_connect.php');
include_once('functions.php');
require('mysql_table_pdf.php');

class PDF extends PDF_MySQL_Table
{
	function Header()
	{
		
		
		$this->SetFont('Arial','',10);
		$this->Cell(0,1,'(KEW.PA-8)',0,1,'R');
		//Title
		$this->SetFont('Arial','',13);

		$this->Cell(0,15,'LAPORAN TAHUNAN HARTA MODAL DAN INVENTORI BAGI TAHUN '.$this->YEAR,0,1,'C');
			
		
		$this->Ln(7);
		//Ensure table header is output
		parent::Header();
	}
	public $YEAR;
}
if(!isset($_GET['year']))
{ echo 'exit';
  exit();
}else{
	//Connect to database
	//mysql_connect('server','login','password');
	//mysql_select_db('db');
	mysql_query("set @N = 0;");

	$kementerian = 'KEMENTERIAN KEWANGAN';
	$year = $_GET['year'];
	$pdf=new PDF();
	$pdf->YEAR = $_GET['year'];
	$pdf->AddPage();
	//First table: put all columns automatically
	$pdf->AddCol('bil',7,'BIL.');
	$pdf->AddCol('KEMENTERIAN/JABATAN DIBAWAHNYA',70,'KEMENTERIAN/JABATAN DIBAWAHNYA');
	$pdf->AddCol('BIL. KEW.PA-2',25,'BIL. KEW.PA-2','C');
	$pdf->AddCol('JUMLAH HARTA MODAL',36,'JUMLAH HARTA MODAL (RM)','C');
	$pdf->AddCol('BIL. KEW.PA-3',25,'BIL. KEW.PA-3','C');
	$pdf->AddCol('JUMLAH INVENTORI',33,'JUMLAH INVENTORI (RM)','C');
	$prop=array('HeaderColor'=>array(255,255,210),
				//'color1'=>array(210,245,255),
				//'color2'=>array(255,255,210),
				'padding'=>1);
	$pdf->Table('select @N:=@N+1 AS bil,
						A.bahagian as "KEMENTERIAN/JABATAN DIBAWAHNYA", 
						A.bil as "BIL. KEW.PA-2" , 
						A.jumlah as "JUMLAH HARTA MODAL" , 
						B.bil as "BIL. KEW.PA-3" ,  
						B.jumlah as "JUMLAH INVENTORI" 
					from 
						(select  h.bahagian , count(h.id) as bil,sum(h.harga_perolehan_asal) as jumlah 
							from hartamodal h 
							where h.kementerian = "'.$kementerian.'" 
							and  year(h.tarikh_terima) = '.$year.' 
							GROUP BY h.kementerian) as  A ,	
						(select count(i.id) as bil,sum(i.harga_perolehan_asal) as jumlah 
							from inventori i 
							where i.kementerian = "'.$kementerian.'"
							and  year(i.tarikh_terima) = '.$year.' 
							GROUP BY i.kementerian) as B   ',$prop);
	//$pdf->AddPage();
	
	//Second table: specify 3 columns
	//$pdf->AddCol('rank',20,'','C');
	//$pdf->AddCol('name',40,'Country');
	//$pdf->AddCol('pop',40,'Pop (2001)','R');
	//$prop=array('HeaderColor'=>array(255,150,100),
	//			'color1'=>array(210,245,255),
	//			'color2'=>array(255,255,210),
	//			'padding'=>2);
	//$pdf->Table('select name, format(pop,0) as pop, rank from country order by rank limit 0,10',$prop);
	$pdf->Output();
}
?>
