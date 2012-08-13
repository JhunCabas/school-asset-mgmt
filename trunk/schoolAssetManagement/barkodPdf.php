<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
	function Code39($xpos, $ypos, $code, $baseline=0.5, $height=5){

		$wide = $baseline;
		$narrow = $baseline / 3 ; 
		$gap = $narrow;

		$barChar['0'] = 'nnnwwnwnn';
		$barChar['1'] = 'wnnwnnnnw';
		$barChar['2'] = 'nnwwnnnnw';
		$barChar['3'] = 'wnwwnnnnn';
		$barChar['4'] = 'nnnwwnnnw';
		$barChar['5'] = 'wnnwwnnnn';
		$barChar['6'] = 'nnwwwnnnn';
		$barChar['7'] = 'nnnwnnwnw';
		$barChar['8'] = 'wnnwnnwnn';
		$barChar['9'] = 'nnwwnnwnn';
		$barChar['A'] = 'wnnnnwnnw';
		$barChar['B'] = 'nnwnnwnnw';
		$barChar['C'] = 'wnwnnwnnn';
		$barChar['D'] = 'nnnnwwnnw';
		$barChar['E'] = 'wnnnwwnnn';
		$barChar['F'] = 'nnwnwwnnn';
		$barChar['G'] = 'nnnnnwwnw';
		$barChar['H'] = 'wnnnnwwnn';
		$barChar['I'] = 'nnwnnwwnn';
		$barChar['J'] = 'nnnnwwwnn';
		$barChar['K'] = 'wnnnnnnww';
		$barChar['L'] = 'nnwnnnnww';
		$barChar['M'] = 'wnwnnnnwn';
		$barChar['N'] = 'nnnnwnnww';
		$barChar['O'] = 'wnnnwnnwn'; 
		$barChar['P'] = 'nnwnwnnwn';
		$barChar['Q'] = 'nnnnnnwww';
		$barChar['R'] = 'wnnnnnwwn';
		$barChar['S'] = 'nnwnnnwwn';
		$barChar['T'] = 'nnnnwnwwn';
		$barChar['U'] = 'wwnnnnnnw';
		$barChar['V'] = 'nwwnnnnnw';
		$barChar['W'] = 'wwwnnnnnn';
		$barChar['X'] = 'nwnnwnnnw';
		$barChar['Y'] = 'wwnnwnnnn';
		$barChar['Z'] = 'nwwnwnnnn';
		$barChar['-'] = 'nwnnnnwnw';
		$barChar['.'] = 'wwnnnnwnn';
		$barChar[' '] = 'nwwnnnwnn';
		$barChar['*'] = 'nwnnwnwnn';
		$barChar['$'] = 'nwnwnwnnn';
		$barChar['/'] = 'nwnwnnnwn';
		$barChar['+'] = 'nwnnnwnwn';
		$barChar['%'] = 'nnnwnwnwn';

		$this->SetFont('Arial','',10);
		$this->Text($xpos+14, $ypos + $height + 4, $code);
		$this->SetFillColor(0);

		$code = '*'.strtoupper($code).'*';
		for($i=0; $i<strlen($code); $i++){
			$char = $code[$i];
			if(!isset($barChar[$char])){
				$this->Error('Invalid character in barcode: '.$char);
			}
			$seq = $barChar[$char];
			for($bar=0; $bar<9; $bar++){
				if($seq[$bar] == 'n'){
					$lineWidth = $narrow;
				}else{
					$lineWidth = $wide;
				}
				if($bar % 2 == 0){
					$this->Rect($xpos, $ypos, $lineWidth, $height, 'F');
				}
				$xpos += $lineWidth;
			}
			$xpos += $gap;
		}
	}
	function RoundedRect($x, $y, $w, $h, $r, $style = '')
		{
			$k = $this->k;
			$hp = $this->h;
			if($style=='F')
				$op='f';
			elseif($style=='FD' || $style=='DF')
				$op='B';
			else
				$op='S';
			$MyArc = 4/3 * (sqrt(2) - 1);
			$this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
			$xc = $x+$w-$r ;
			$yc = $y+$r;
			$this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));

			$this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
			$xc = $x+$w-$r ;
			$yc = $y+$h-$r;
			$this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
			$this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
			$xc = $x+$r ;
			$yc = $y+$h-$r;
			$this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
			$this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
			$xc = $x+$r ;
			$yc = $y+$r;
			$this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
			$this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
			$this->_out($op);
		}

		function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
		{
			$h = $this->h;
			$this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
				$x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
		}
		
	// Page header
	function Header()
	{
		$this->SetLineWidth(0.5);
		$this->SetFillColor(255,255,255);
		$this->RoundedRect(42, 39, 102, 55, 3.5, 'DF');

		// Logo
		//$this->Image('sample.png',43,50,100);
		$this->Code39(50,52,$this->barcode,0.5,5);
		
		// Logo
		$this->Image('img/barkod/mof-1-s.png',45,40,10);
		
		// Logo
		$this->Image('img/barkod/mof-2-s.png',130,40,10);
		
		// Arial bold 15
		$this->SetFont('Arial','B',13);
		// Move to the right
		$this->Cell(80);
		// Title
		$this->Cell(1,65,'KEMENTERIAN',0,0,'C');
		// Line break
		//$this->Ln(20);
		
		
		$this->Cell(1,75,'KEWANGAN MALAYSIA',0,0,'C');
		
		$this->SetFont('Arial','',10);
		$this->Cell(1,120,$this->jenis,0,0,'C');
		//$this->Cell(1,130,'NO SIRI: X0029OO029KY',0,0,'C');
		//$this->Cell(1,140,'TARIKH PEROLEHAN : '.$this->tarikh,0,0,'C');
		
		$this->Cell(1,130,'TARIKH PEROLEHAN : '.$this->tarikh,0,0,'C');
		
		$this->SetFont('Arial','B',16);
		$this->Cell(1,160,'HAK KERAJAAN MALAYSIA',0,0,'C');
	}

	// Page footer
	function Footer()
	{
		// Position at 1.5 cm from bottom
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Page number
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
	
	public $barcode;
	public $jenis;
	public $tarikh;
	
}
if(!isset($_GET['bc'])
	&& !isset($_GET['jenis'])
	&& !isset($_GET['tarikh']) )
{ echo 'exit';
  exit();
}else{
	$barcode=$_GET['bc'];
	$jenis=$_GET['jenis'];
	$tarikh=$_GET['tarikh'];

	// Instanciation of inherited class
	$pdf = new PDF();
	$pdf->barcode=$barcode;
	$pdf->jenis=$jenis;
	$pdf->tarikh=$tarikh;
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->Output();
}

?>
