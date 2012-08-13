
				<?php
						error_reporting(E_STRICT);
						session_start();

						$_SESSION=array();
						
						setcookie('PHPSESID','',time()-300,'/','',0);
						session_destroy();
						?>
						<script language="javascript">
						   
							window.location="index.php";
						</script>
						<?

				?>