<?php
	include('header.php');
?>		

		<!--[if !IE]>start content<![endif]-->					
		<div id="content">
			<div class="inner">
				
				<!--[if !IE]>start section<![endif]-->
				<?php

				if(!empty($_GET['del_id'])){
					if( empty($_GET['token']) || $_GET['token'] != $_SESSION['tokenpPenerimaanDel'] ){
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
						unset($_SESSION['tokenpPenerimaanDel']);
					}
				}

				$token = md5(uniqid(rand(), true));
				$_SESSION['tokenpPenerimaanDel'] = $token;

				?>
		
				<div class="section">
					
					<!--[if !IE]>start title wrapper<![endif]-->
					<div class="title_wrapper">
						<span class="title_wrapper_top"></span>
						<div class="title_wrapper_inner">
							<span class="title_wrapper_middle"></span>
							<div class="title_wrapper_content">
								<h2>Senarai Penerimaan Aset:</h2>
								<ul class="section_menu right">
									<li><a href="#" onclick="autoPrint(this)" >
										<span class="l"><span></span></span>
											<span class="m">
											<em><img src="../css/layout/print_icon.gif" width="12" height="12"> CETAK</em><span></span>
											</span>
											<span class="r"><span></span></span>
										</a></li>
								</ul>
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
								 
								$pembekal = "";  
								
								if(isset($_GET['pembekal']))
									$pembekal = mysql_real_escape_string($_GET['pembekal']);   
									
								if(isset($_POST['reset'])){
									$_POST = "";
								}
								if(isset($_POST['cari'])){ 
									$pembekal = mysql_real_escape_string($_POST['pembekal']); 
								}
								//use for pagination url parameter
								$param = "&pembekal=$pembekal";
							?>
							<form action="pPenerimaan.php" method="POST" class="search_form">
							
							
							<!--[if !IE]>start fieldset<![endif]-->
							<fieldset>
								<!--[if !IE]>start forms<![endif]-->
								<div class="forms">
								<h3>Carian Penerimaan Aset </h3>
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>Syarikat:</label>
									<div class="inputs">
										<span class="input_wrapper select_wrapper">
											
											<select name="pembekal" id="pembekal" style="width:auto; ">
												<?php
												$qList= "select * from pembekal order by tarikh_daftar desc   ";
												$rList = $db->sql_fetch($qList);
												
												if($pembekal == "")
													$pembekal = $rList[0][0];
													
												foreach ($rList as $i) {
													echo '<option value="'.$i['id'].'" '; if(isset($_POST['pembekal']) && $_POST['pembekal'] == $i['id']) echo 'selected'; echo'>'.$i['nama'].'  ('.$i['no_daftar'].')</option>';
												}
												?>
											</select>
										</span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<div class="inputs">
										<span class="button blue_button search_button"><span><span><em>CARI</em></span></span><input name="cari" type="submit" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								</div>
								<!--[if !IE]>end forms<![endif]-->
								
							</fieldset>
							<!--[if !IE]>end fieldset<![endif]-->
							
							
							</form>
							<div class="table_tabs_menu">
							
								<a href="pPenerimaanDaftar.php" class="update"><span><span><em>Daftar Penerimaan Aset</em><strong></strong></span></span></a>
							</div>
						
							<!--[if !IE]>start table_wrapper<![endif]-->
							<div class="table_wrapper">
								<div class="table_wrapper_inner">
								
								<?php  

									/* 
									   First get total number of rows in data table. 
									   If you have a WHERE clause in your query, make sure you mirror it here.
									*/
									$qCount= "select COUNT(*) from penerimaan where pembekal_id = '$pembekal' 
												 order by tarikh_daftar desc";
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
									$qList= "select * from  penerimaan where pembekal_id = '$pembekal' 
												 order by tarikh_daftar desc 
												 LIMIT $start, $limit ";
									$rList = $db->sql_fetch($qList);			

								?>
								<script>
									function autoPrint(data) 
									{
										var mywindow = window.open('../printPenerimaan.php?id=<?php echo $pembekal; ?>', 'Print Penerimaan', 'scrollbars=yes,width=735');

										mywindow.print();
										return true;
									}
							    </script>
								<table cellpadding="0" cellspacing="0" width="100%">
									<tbody>
									<tr>
										<th  rowspan="2">Bil.</th>
										<th  colspan="2">Nota Hantaran</th>
										<th  rowspan="2">Nama Aset</th>
										<th colspan="3">Kuantiti</a></th>
										<th  rowspan="2">Kerosakan</a></th>
										<th  rowspan="2">Catatan</a></th>
										<th  rowspan="2">Tindakan</th>
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
										$colorRow = "first";
										if($num%2==0)
											$colorRow = "second"; 
										else
											$colorRow = "first";
									
										echo '	
											<tr class="'.$colorRow.'">
												<td>'.$num.'</td>
												<td>'.$i['no_terima'].'</td>
												<td>'.changeDateBeginDay($i['tarikh_terima']).'</td>
												<td>'.$i['nama_aset'].'</td>
												<td>'.$i['qty_pesan'].'</td>
												<td>'.$i['qty_terima'].'</td>
												<td>'.$i['qty_selisih'].'</td>
												<td>'.$i['perihal_rosak'].'</td>
												<td>'.$i['catatan'].'</td>
												<td>
													<div class="actions_menu" style="width:140px;">
														<ul>
															<li><a class="details" href="pPenerimaanPapar.php?id='.$i['id'].'">Papar</a></li>
															<li><a class="edit" href="pPenerimaanKemaskini.php?id='.$i['id'].'">Kemaskini</a></li>
															<li><a class="delete" href="pPenerimaan.php?del_id='.$i['id'].'&token='.$_SESSION['tokenpPenerimaanDel'].'">Hapus</a></li>
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
										echo '<li><a href="pPenerimaan.php?page='.$prev.$param.'" class="pag_nav"><span><span>Kembali</span></span></a> </li>';
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
												echo '<li><a href="pPenerimaan.php?page='.$counter.$param.'">'.$counter.'</a></li>';	
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
													echo '<li><a href="pPenerimaan.php?page='.$counter.$param.'">'.$counter.'</a></li>';													
											}
											echo '<li>[...]</li>';
											echo '<li><a href="pPenerimaan.php?page='.$lpm1.$param.'">'.$lpm1.'</a></li>';	
											echo '<li><a href="pPenerimaan.php?page='.$lastpage.$param.'">'.$lastpage.'</a></li>';		
										}
										//in middle; hide some front and some back
										elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
										{
											echo '<li><a href="pPenerimaan.php?page=1'.$param.'">1</a></li>';	
											echo '<li><a href="pPenerimaan.php?page=2'.$param.'">2</a></li>';
											echo '<li>[...]</li>';											
											for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
											{
												if ($counter == $page)
													echo '<li><a href="#" class="current_page"><span><span>'.$counter.'</span></span></a></li>';
												else
													echo '<li><a href="pPenerimaan.php?page='.$counter.$param.'">'.$counter.'</a></li>';						
											}
											echo '<li>[...]</li>';
											echo '<li><a href="pPenerimaan.php?page='.$lpm1.$param.'">'.$lpm1.'</a></li>';	
											echo '<li><a href="pPenerimaan.php?page='.$lastpage.$param.'">'.$lastpage.'</a></li>';												
										}
										//close to end; only hide early pages
										else
										{
											echo '<li><a href="pPenerimaan.php?page=1'.$param.'">1</a></li>';	
											echo '<li><a href="pPenerimaan.php?page=2'.$param.'">2</a></li>';
											echo '<li>[...]</li>';	
											for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
											{
												if ($counter == $page)
													echo '<li><a href="#" class="current_page"><span><span>'.$counter.'</span></span></a></li>';
												else
													echo '<li><a href="pPenerimaan.php?page='.$counter.$param.'">'.$counter.'</a></li>';						
											}
										}
									}
									//next button
									if ($page < $counter - 1) 
										echo '<li><a href="pPenerimaan.php?page='.$next.$param.'" class="pag_nav"><span><span>Seterusnya</span></span></a> </li>';
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