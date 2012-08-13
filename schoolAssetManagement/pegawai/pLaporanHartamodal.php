<?php
	include('header.php');
?>		
		<!--[if !IE]>start content<![endif]-->					
		<div id="content">
			<div class="inner">
				
				<!--[if !IE]>start section<![endif]-->
				
		
				<div class="section">
					
					<!--[if !IE]>start title wrapper<![endif]-->
					<div class="title_wrapper">
						<span class="title_wrapper_top"></span>
						<div class="title_wrapper_inner">
							<span class="title_wrapper_middle"></span>
							<div class="title_wrapper_content">
								<h2>Senarai Daftar Harta Modal (KEW.PA-4):</h2>
							</div>
						</div>
						<span class="title_wrapper_bottom"></span>
					</div>
					<!--[if !IE]>end title wrapper<![endif]-->
					
					<!--[if !IE]>start section content<![endif]-->
					<div class="section_content">
						<span class="section_content_top"></span>
						
						<div class="section_content_inner">
							<div class="table_tabs_menu">
								<a href="../report.php?type=h&year=<?php echo date('Y');?>" class="print"><span><span><em>CETAK</em><strong></strong></span></span></a>
							</div>
							<!--[if !IE]>start table_wrapper<![endif]-->
							<div class="table_wrapper">
								<div class="table_wrapper_inner">
								
								<?php  

									/* 
									   First get total number of rows in data table. 
									   If you have a WHERE clause in your query, make sure you mirror it here.
									*/
									$qCount= "select COUNT(*) from hartamodal
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
									$qList= "select * from  hartamodal 
												 order by tarikh_daftar desc 
												 LIMIT $start, $limit ";
									$rList = $db->sql_fetch($qList);			

								?>
								<table cellpadding="0" cellspacing="0" width="100%">
									<tbody>
									<tr>
										<th  style="width: 10px;">Bil.</th>
										<th style="width: 200px;">No. Siri Pendaftaran</th>
										<th>Nama Aset</th>
										<th  style="width: 50px;">Tarikh Perolehan</a></th>
										<th  style="width: 130px;">Harga Perolehan Asal (RM)</a></th>
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
										
										$qCat= "select * from kategori where id = '$i[jenis_id]'  ";
									$rCat = $db->sql_list($qCat);
						
										echo '	
											<tr class="'.$colorRow.'">
												<td>'.$num.'</td>
												<td>'.$i['no_siri_daftar'].'</td>
												<td>'.$rCat['kod'].'-'.$rCat['nama'].'</td>
												<td>'.changeDateBeginDay($i['tarikh_terima']).'</td>
												<td>'.$i['harga_perolehan_asal'].'</td>
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
										echo '<li><a href="pHartamodal.php?page='.$prev.$param.'" class="pag_nav"><span><span>Kembali</span></span></a> </li>';
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
												echo '<li><a href="pHartamodal.php?page='.$counter.$param.'">'.$counter.'</a></li>';	
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
													echo '<li><a href="pHartamodal.php?page='.$counter.$param.'">'.$counter.'</a></li>';													
											}
											echo '<li>[...]</li>';
											echo '<li><a href="pHartamodal.php?page='.$lpm1.$param.'">'.$lpm1.'</a></li>';	
											echo '<li><a href="pHartamodal.php?page='.$lastpage.$param.'">'.$lastpage.'</a></li>';		
										}
										//in middle; hide some front and some back
										elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
										{
											echo '<li><a href="pHartamodal.php?page=1'.$param.'">1</a></li>';	
											echo '<li><a href="pHartamodal.php?page=2'.$param.'">2</a></li>';
											echo '<li>[...]</li>';											
											for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
											{
												if ($counter == $page)
													echo '<li><a href="#" class="current_page"><span><span>'.$counter.'</span></span></a></li>';
												else
													echo '<li><a href="pHartamodal.php?page='.$counter.$param.'">'.$counter.'</a></li>';						
											}
											echo '<li>[...]</li>';
											echo '<li><a href="pHartamodal.php?page='.$lpm1.$param.'">'.$lpm1.'</a></li>';	
											echo '<li><a href="pHartamodal.php?page='.$lastpage.$param.'">'.$lastpage.'</a></li>';												
										}
										//close to end; only hide early pages
										else
										{
											echo '<li><a href="pHartamodal.php?page=1'.$param.'">1</a></li>';	
											echo '<li><a href="pHartamodal.php?page=2'.$param.'">2</a></li>';
											echo '<li>[...]</li>';	
											for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
											{
												if ($counter == $page)
													echo '<li><a href="#" class="current_page"><span><span>'.$counter.'</span></span></a></li>';
												else
													echo '<li><a href="pHartamodal.php?page='.$counter.$param.'">'.$counter.'</a></li>';						
											}
										}
									}
									//next button
									if ($page < $counter - 1) 
										echo '<li><a href="pHartamodal.php?page='.$next.$param.'" class="pag_nav"><span><span>Seterusnya</span></span></a> </li>';
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