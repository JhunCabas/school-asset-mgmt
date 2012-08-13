<?php 
include('common.php');
$notValid =false;
$failed=false;
if(isset($_POST['login'])){
	
	if(empty($_POST['username'])){
		$notValid =true;
		$errors[] = 'Sila masukkan no. kad pengenalan';
	}
	if(empty($_POST['password'])){
		$notValid =true;
		$errors[] = 'Sila masukkan kata laluan';
	}
	if($notValid==false){
		$username = mysql_real_escape_string($_POST['username']); 
		$password = mysql_real_escape_string($_POST['password']);
		
		$qCount= "select COUNT(*) from pengguna p, peranan g where p.peranan_id = g.id and no_ic = '$username' and password=PASSWORD('$password')";
		$islog = $db->sql_total($qCount);
									
		$Qlogin = "SELECT p.*, g.nama as namaperanan from pengguna p, peranan g where p.peranan_id = g.id and no_ic = '$username' and password=PASSWORD('$password')";
		$result = $db->sql_list($Qlogin);

		if($islog <> 0){
					$_SESSION['islogin'] = "yes";
					$_SESSION['username'] = $result['no_ic'];
					$_SESSION['userlogin_id'] = $result['id'];
					$_SESSION['email']   = $result['emel'];
					$_SESSION['name']   = $result['nama'];
					$_SESSION['peranan']   = $result['namaperanan'];
					if($_SESSION['peranan']=='admin')
						header( 'Location: admin/aPegawai.php' ) ;
					else
						header( 'Location: pegawai/pPenerimaan.php' ) ;
					
		}else{
			$failed=true;
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<title>Sistem Pengurusan Aset Sekolah</title>
<link media="screen" rel="stylesheet" type="text/css" href="css/login.css"  />
<!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/login-ie.css" /><![endif]-->
<!-- aurora-theme is default -->

<link media="screen" rel="stylesheet" type="text/css" href="css/login-blue.css"  />
</head>

<body>
	<!--[if !IE]>start wrapper<![endif]-->
	<div id="wrapper">
	<div id="wrapper2">
	<div id="wrapper3">
	<div id="wrapper4">
	<span id="login_wrapper_bg"></span>
	
	<div id="stripes">

		
		<!--[if !IE]>start login wrapper<![endif]-->
		<div id="login_wrapper">

			<?php
				if($notValid==true){
					echo"
						<div class='error'>
							<div class='error_inner'>";
					while (list($key,$value) = each($errors))
					{
							echo "<span>".$value."<br/></span>";
					}
					echo "	</div>
						</div>";
				}
				if($failed==true){
					echo"
						<div class='error'>
							<div class='error_inner'>";
							echo "<span>No. Kad Pengenalan / katalaluan salah</span>";
					echo "	</div>
						</div>";
				}
			?>
			
			<!--[if !IE]>start login<![endif]-->
			<form action="" method="POST">
				<fieldset>
					
					<h1>Sila Log Masuk</h1>
					<div class="formular">
						<span class="formular_top"></span>
						
						<div class="formular_inner">
						
						<label>
							<strong>No. Kad Pengenalan :</strong>

							<span class="input_wrapper">
								<input name="username" type="text" value="<?php if(isset($_POST['username'])) echo $_POST['username'];  ?>" />
							</span>
						</label>
						<label>
							<strong>Kata Laluan :</strong>
							<span class="input_wrapper">
								<input name="password" type="password" />

							</span>
						</label>
						<!--label class="inline">
							<input class="checkbox" name="" type="checkbox" value="" />
							remember me on this computer
						</label-->
						
						
						<ul class="form_menu">
							<li><span class="button"><span><span><em>SUBMIT</em></span></span><input type="submit" name="login"/></span></li>
							<!--i><span class="button"><span><span><a href="admin/aPegawai.php">BACK TO SITE</a></span></span></span></li-->
						</ul>
						
						</div>
						
						<span class="formular_bottom"></span>
						
					</div>
				</fieldset>
			</form>
			<!--[if !IE]>end login<![endif]-->
			
			<!--[if !IE]>start reflect<![endif]-->
			<span class="reflect"></span>
			<span class="lock"></span>
			<!--[if !IE]>end reflect<![endif]-->
			
			
		</div>

		<!--[if !IE]>end login wrapper<![endif]-->
	    </div>
		</div>
     	</div>
		</div>	
	</div>
	<!--[if !IE]>end wrapper<![endif]-->
</body>
</html>
