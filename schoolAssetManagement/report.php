<?php
require('mysql_connect.php');
include_once('functions.php');
require('mysql_table_pdf.php');

class PDF extends PDF_MySQL_Table
{
	function Header()
	{
		
		if($this->TYPE == 'I'){
			$this->SetFont('Arial','',10);
			$this->Cell(0,3,'(KEW.PA-5)',0,1,'R');
			//Title
			$this->SetFont('Arial','',18);
			$this->Cell(0,6,'SENARAI DAFTAR INVENTORI',0,1,'C');
		
		}else{
			$this->SetFont('Arial','',10);
			$this->Cell(0,3,'(KEW.PA-4)',0,1,'R');
			//Title
			$this->SetFont('Arial','',18);

			$this->Cell(0,6,'SENARAI DAFTAR HARTA MODAL',0,1,'C');
			
		}
		$this->Ln(10);
		//Ensure table header is output
		parent::Header();
	}
	public $TYPE;
}
if(!isset($_GET['type']) &&
	!isset($_GET['year']))
{ echo 'exit';
  exit();
}else{
	//Connect to database
	//mysql_connect('server','login','password');
	//mysql_select_db('db');
	mysql_query("set @N = 0;");
	
	$table="HARTAMODAL";
	if($_GET['type']== 'I'){
		$table="INVENTORI";
	}
	
	$year = $_GET['year'];
	$pdf=new PDF();
	$pdf->TYPE = $_GET['type'];
	$pdf->AddPage();
	//First table: put all columns automatically
	$pdf->AddCol('bil',7,'BIL.');
	$pdf->AddCol('No. Siri Pendaftaran',45,'NO. SIRI PENDAFTARAN','C');
	$pdf->AddCol('Nama Aset',70,'NAMA ASET');
	$pdf->AddCol('Tarikh Perolehan',30,'TARIKH PEROLEHAN','C');
	$pdf->AddCol('Harga Perolehan Asal (RM)',45,'HARGA PEROLEHAN ASAL (RM)','R');
	$prop=array('HeaderColor'=>array(255,255,210),
				//'color1'=>array(210,245,255),
				//'color2'=>array(255,255,210),
				'padding'=>1);
	$pdf->Table('select @N:=@N+1 AS bil, a.no_siri_daftar as "No. Siri Pendaftaran", CONCAT(b.kod,"-",b.nama) as "Nama Aset",
					a.tarikh_terima as "Tarikh Perolehan",a.harga_perolehan_asal as "Harga Perolehan Asal (RM)"
				 from '.$table.' a, kategori b 
				where a.jenis_id = b.id 
				and b.level=2 
				AND YEAR(a.tarikh_terima)= "'.$year.'"  ',$prop);
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
