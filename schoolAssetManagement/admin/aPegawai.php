<?php
	include('header.php');
?>		
		<!--[if !IE]>start content<![endif]-->					
		<div id="content">
			<div class="inner">
				
				<!--[if !IE]>start section<![endif]-->
				<?php

				if(!empty($_GET['del_id'])){
					if( empty($_GET['token']) || $_GET['token'] != $_SESSION['tokenAPegawaiDel'] ){
						echo"
						<div class='section'>
							<ul class='system_messages'>
								<li class='red'><span class='ico'></span><strong class='system_title'>Data pegawai ini tidak boleh dihapuskan!</strong> </li>
							</ul>
						</div>";
					}
					else {
						// All fine: delete 
						$qDel= "delete from pengguna where id = $_GET[del_id]" ;
						$rDel = $db->sql_query($qDel);
						if($rDel){
							echo"
							<div class='section'>
								<ul class='system_messages'>
									<li class='green'><span class='ico'></span><strong class='system_title'>Data pegawai aset berjaya dihapuskan!</strong> </li>
								</ul>
							</div>";
						}							
						// Unset the token, so that it cannot be used again.
						unset($_SESSION['tokenAPegawaiDel']);
					}
				}

				$token = md5(uniqid(rand(), true));
				$_SESSION['tokenAPegawaiDel'] = $token;

				?>
		
				<div class="section">
					
					<!--[if !IE]>start title wrapper<![endif]-->
					<div class="title_wrapper">
						<span class="title_wrapper_top"></span>
						<div class="title_wrapper_inner">
							<span class="title_wrapper_middle"></span>
							<div class="title_wrapper_content">
								<h2>Senarai Pegawai Aset:</h2>
							</div>
						</div>
						<span class="title_wrapper_bottom"></span>
					</div>
					<!--[if !IE]>end title wrapper<![endif]-->
					
					<!--[if !IE]>start section content<![endif]-->
					<div class="section_content">
						<span class="section_content_top"></span>
						
						<div class="section_content_inner">
							<?php
								$nama = "";
								$nostaff = "";
								$noic = "";
								
								if(isset($_GET['nama']))
									$nama = mysql_real_escape_string($_GET['nama']);  
								if(isset($_GET['nostaff']))	
									$nostaff = mysql_real_escape_string($_GET['nostaff']); 
								if(isset($_GET['noic']))	
									$noic = mysql_real_escape_string($_GET['noic']); 
								
								if(isset($_POST['reset'])){
									$_POST="";
									$nama = "";
								    $nostaff = "";
								    $noic = "";
								}
								if(isset($_POST['cari'])){
									$_GET="";
									$nama = mysql_real_escape_string($_POST['nama']);  
									$nostaff = mysql_real_escape_string($_POST['nostaff']); 
									$noic = mysql_real_escape_string($_POST['noic']); 
								}
								//use for pagination url parameter
								$param = "&nama=$nama&nostaff=$nostaff&noic=$noic";
							?>
							<form action="aPegawai.php" method="POST" class="search_form">
							
							
							<!--[if !IE]>start fieldset<![endif]-->
							<fieldset>
								<!--[if !IE]>start forms<![endif]-->
								<div class="forms">
								<h3>Carian Pegawai Aset</h3>
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Nama Penuh:</label>
									<div class="inputs">
										<span class="input_wrapper"><input class="text" name="nama" value="<?php if($nama != "") echo $nama; ?>" type="text" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>No. Kad Pengenalan:</label>
									<div class="inputs">
										<span class="input_wrapper"><input class="text" name="noic" value="<?php if($noic != "") echo $noic ; ?>" type="text" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>No. Staff:</label>
									<div class="inputs">
										<span class="input_wrapper"><input class="text" name="nostaff" value="<?php if($nostaff != "") echo $nostaff; ?>" type="text" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<div class="inputs">
										<span class="button blue_button search_button"><span><span><em>CARI</em></span></span><input name="cari" type="submit" /></span>
										<span class="button gray_button"><span><span>RESET</span></span><a href="aPegawai.php" ><input name="reset" type="submit" /></a></span> 
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								</div>
								<!--[if !IE]>end forms<![endif]-->
								
							</fieldset>
							<!--[if !IE]>end fieldset<![endif]-->
							
							
							</form>
							
							<div class="table_tabs_menu">
							
							<a href="aPegawaiDaftar.php" class="update"><span><span><em>Daftar Pegawai Aset</em><strong></strong></span></span></a>
							</div>
						
							<!--[if !IE]>start table_wrapper<![endif]-->
							<div class="table_wrapper">
								<div class="table_wrapper_inner">
								
								<?php  

									/* 
									   First get total number of rows in data table. 
									   If you have a WHERE clause in your query, make sure you mirror it here.
									*/
									$qCount= "select COUNT(*) from pengguna where nama like '%$nama%' 
												and no_staff like '%$nostaff%' 
												and no_ic like '%$noic%' and peranan_id != '1' order by tarikh_daftar desc";
									$total_pages = $db->sql_total($qCount);
									
									/* Setup vars for query. */
									$limit = 10; 								//how many items to show per page
									
									$page="";
									if(isset($_GET['page']))
										$page=$_GET['page'];
										
									if($page) 
										$start = ($page - 1) * $limit; 			//first item to display on this page
									else
										$start = 0;								//if no page var is given, set start to 0
									
									/* Get data. */
									$qList= "select * from pengguna where nama like '%$nama%' 
												and no_staff like '%$nostaff%' 
												and no_ic like '%$noic%' and peranan_id != '1' order by tarikh_daftar desc 
												LIMIT $start, $limit ";
									$rList = $db->sql_fetch($qList);			

								?>
								<table cellpadding="0" cellspacing="0" width="100%">
									<tbody>
									<tr>
										<th style="width: 17px;">No.</th>
										<th style="width: 130px;">Nama Penuh</th>
										<th style="width: 130px;">No. Kad Pengenalan</th>
										<th style="width: 80px;">Jawatan</th>
										<th style="width: 80px;">No. Staff</th>
										<th style="width: 80px;">Emel</a></th>
										<th style="width: 140px;">Tindakan</th>
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
												<td>'.$i['nama'].'</td>
												<td>'.$i['no_ic'].'</td>
												<td>'.$i['jawatan'].'</td>
												<td>'.$i['no_staff'].'</td>
												<td>'.$i['emel'].'</td>
												<td>
													<div class="actions_menu" style="width:140px;">
														<ul>
															<li><a class="edit" href="aPegawaiKemaskini.php?id='.$i['id'].'">Kemaskini</a></li>
															<li><a class="delete" href="aPegawai.php?del_id='.$i['id'].'&token='.$_SESSION['tokenAPegawaiDel'].'">Hapus</a></li>
														</ul>
													</div>
												</td>
											</tr>';
										
									}
								?>
								</tbody></table>
								</div>
							</div>
							<!--[if !IE]>end table_wrapper<![endif]-->
							
						</div>
						
						<!--[if !IE]>start pagination<![endif]-->
							<div class="pagination_wrapper">
							<span class="pagination_top"></span>
							<div class="pagination_middle">
							<div class="pagination">
								<?php
								// How many adjacent pages should be shown on each side?
									$adjacents = 3;
								/* Setup page vars for display. */
									if ($page == 0) $page = 1;					//if no page var is given, default to 1.
									$prev = $page - 1;							//previous page is page - 1
									$next = $page + 1;							//next page is page + 1
									$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
									$lpm1 = $lastpage - 1;						//last page minus 1
								/* 
									Now we apply our rules and draw the pagination object. 
									We're actually saving the code to a variable in case we want to draw it more than once.
								*/
								echo '<span class="page_no">Page '.$page.' of '.$lastpage.' </span>';
								echo '<ul class="pag_list">';

									//previous button
									if ($page > 1) 
										echo '<li><a href="aPegawai.php?page='.$prev.$param.'" class="pag_nav"><span><span>Kembali</span></span></a> </li>';
									else
										echo '<li><a href="#" class="pag_nav"><span><span>Kembali</span></span></a> </li>';

									//pages	
									if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
									{	
										for ($counter = 1; $counter <= $lastpage; $counter++)
										{
											if ($counter == $page)
												echo '<li><a href="#" class="current_page"><span><span>'.$counter.'</span></span></a></li>';
											else	
												echo '<li><a href="aPegawai.php?page='.$counter.$param.'">'.$counter.'</a></li>';	
										}
									}
									elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
									{
										//close to beginning; only hide later pages
										if($page < 1 + ($adjacents * 2))		
										{
											for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
											{
												if ($counter == $page)
													echo '<li><a href="#" class="current_page"><span><span>'.$counter.'</span></span></a></li>';
												else	
													echo '<li><a href="aPegawai.php?page='.$counter.$param.'">'.$counter.'</a></li>';													
											}
											echo '<li>[...]</li>';
											echo '<li><a href="aPegawai.php?page='.$lpm1.$param.'">'.$lpm1.'</a></li>';	
											echo '<li><a href="aPegawai.php?page='.$lastpage.$param.'">'.$lastpage.'</a></li>';		
										}
										//in middle; hide some front and some back
										elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
										{
											echo '<li><a href="aPegawai.php?page=1'.$param.'">1</a></li>';	
											echo '<li><a href="aPegawai.php?page=2'.$param.'">2</a></li>';
											echo '<li>[...]</li>';											
											for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
											{
												if ($counter == $page)
													echo '<li><a href="#" class="current_page"><span><span>'.$counter.'</span></span></a></li>';
												else
													echo '<li><a href="aPegawai.php?page='.$counter.$param.'">'.$counter.'</a></li>';						
											}
											echo '<li>[...]</li>';
											echo '<li><a href="aPegawai.php?page='.$lpm1.$param.'">'.$lpm1.'</a></li>';	
											echo '<li><a href="aPegawai.php?page='.$lastpage.$param.'">'.$lastpage.'</a></li>';												
										}
										//close to end; only hide early pages
										else
										{
											echo '<li><a href="aPegawai.php?page=1'.$param.'">1</a></li>';	
											echo '<li><a href="aPegawai.php?page=2'.$param.'">2</a></li>';
											echo '<li>[...]</li>';	
											for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
											{
												if ($counter == $page)
													echo '<li><a href="#" class="current_page"><span><span>'.$counter.'</span></span></a></li>';
												else
													echo '<li><a href="aPegawai.php?page='.$counter.$param.'">'.$counter.'</a></li>';						
											}
										}
									}
									//next button
									if ($page < $counter - 1) 
										echo '<li><a href="aPegawai.php?page='.$next.$param.'" class="pag_nav"><span><span>Seterusnya</span></span></a> </li>';
									else
										echo '<li><a href="#" class="pag_nav"><span><span>Seterusnya</span></span></a> </li>';
									?>
								</ul>
							</div>
							</div>
							<span class="pagination_bottom"></span>
							</div>
						<!--[if !IE]>end pagination<![endif]-->
						
						
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