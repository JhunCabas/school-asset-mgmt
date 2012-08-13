<?php
	include('header.php');
	
	$year = date('Y');
	if(isset($_POST['year'])){
		$year = $_POST['year'];
	}
	
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
								<h2>Laporan Tahunan Harta Modal Dan Inventori Bagi Tahun <?php echo $year;  ?></h2>
							</div>
						</div>
						<span class="title_wrapper_bottom"></span>
					</div>
					<!--[if !IE]>end title wrapper<![endif]-->
					
					<!--[if !IE]>start section content<![endif]-->
					<div class="section_content">
						<span class="section_content_top"></span>
						<div class="section_content_inner">
							<form class="search_form" method="post">
								<!--[if !IE]>start fieldset<![endif]-->
								<fieldset>
								
									<!--[if !IE]>start row<![endif]-->
									<div class="row">
										<label>Report Tahunan:</label>
										<div class="inputs">
											<span class="input_wrapper select_wrapper">
												
												<select name="year" id="year" style="width:100px; ">
													<?php
													
													//This function to get all values uniqes without redundant
													if( !function_exists( 'array_flat' ) )
													{
														function array_flat( $a, $s = array( ), $l = 0 )
														{
															# check if this is an array
															if( !is_array( $a ) )                           return $s;
														   
															# go through the array values
															foreach( $a as $k => $v )
															{
																# check if the contained values are arrays
																if( !is_array( $v ) )
																{
																	# store the value
																	$s[ ]       = $v;
																   
																	# move to the next node
																	continue;
																   
																}
															   
																# increment depth level
																$l++;
															   
																# replace the content of stored values
																$s              = array_flat( $v, $s, $l );
															   
																# decrement depth level
																$l--;
															   
															}
														   
															# get only unique values
															if( $l == 0 ) $s = array_values( array_unique( $s ) );
														   
															# return stored values
															return $s;
														   
														} # end of function array_flat( ...
													   
													} 

													$qList= "SELECT distinct(YEAR(h.tarikh_terima)) AS y1 FROM hartamodal h  order by  y1 desc ";
													$rList = $db->sql_fetch($qList);
													
													$qList2= "SELECT distinct(YEAR(i.tarikh_terima)) AS y2  FROM inventori i order by  y2 desc ";
													$rList2 = $db->sql_fetch($qList2);
													
													//Combine all arrays  and get values uniqe by call function  array_flat
													$result = array_flat(array_merge(array_flat($rList), array_flat($rList2)));
													
													foreach ($result as $i) {
														echo '<option value="'.$i.'" '; if(isset($_POST['year']) && $_POST['year'] == $i) echo 'selected'; echo'>'.$i.'</option>';
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
									
									<!--[if !IE]>start forms<![endif]-->
									<!--
									<div class="forms">
									<h3>KEMENTERIAN : KEMENTERIAN KEWANGAN</h3>
									</div>
									-->
									<!--[if !IE]>end forms<![endif]-->
									
								</fieldset>
								<!--[if !IE]>end fieldset<![endif]-->
							</form>
							<?php
							$year = date('Y');
							if(isset($_POST['year'])){
								$year = $_POST['year'];
							}
							?>
							<div class="table_tabs_menu">
								<a href="../reportTahunan.php?year=<?php echo $year; ?>" class="print"><span><span><em>CETAK</em><strong></strong></span></span></a>
							</div>
							<!--[if !IE]>start table_wrapper<![endif]-->
							<div class="table_wrapper">
								<div class="table_wrapper_inner">
								
								<?php  
									
									
									
									/* 
									   First get total number of rows in data table. 
									   If you have a WHERE clause in your query, make sure you mirror it here.
									*/
									$kementerian = "KEMENTERIAN KEWANGAN";
									//$year = date('Y');
									$qCount= 'select 	count(*) 
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
														GROUP BY i.kementerian) as B ';
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
									$qList= 'select 	A.bahagian as "KEMENTERIAN/JABATAN DIBAWAHNYA", 
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
														GROUP BY i.kementerian) as B 
												 order by A.bahagian 
												 LIMIT '.$start.', '.$limit.' ';
									$rList = $db->sql_fetch($qList);			

								?>
								<table cellpadding="0" cellspacing="0" width="100%">
									<tbody>
									<tr>
										<th  style="width: 10px;">Bil.</th>
										<th  style="width: 200px;">Kementerian/Jabatan dibawahnya</th>
										<th  style="width: 80px;">Bil. KEW.PA-2</th>
										<th  style="width: 80px;">Jumlah Nilai Harta Modal (RM)</a></th>
										<th  style="width: 80px;">Bil. KEW.PA-2</a></th>
										<th  style="width: 80px;">Jumlah Nilai Inventori (RM)</a></th>
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
												<td>'.$i[0].'</td>
												<td>'.$i[1].'</td>
												<td>'.$i[2].'</td>
												<td>'.$i[3].'</td>
												<td>'.$i[4].'</td>
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
										echo '<li><a href="pInventori.php?page='.$prev.$param.'" class="pag_nav"><span><span>Kembali</span></span></a> </li>';
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
												echo '<li><a href="pInventori.php?page='.$counter.$param.'">'.$counter.'</a></li>';	
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
													echo '<li><a href="pInventori.php?page='.$counter.$param.'">'.$counter.'</a></li>';													
											}
											echo '<li>[...]</li>';
											echo '<li><a href="pInventori.php?page='.$lpm1.$param.'">'.$lpm1.'</a></li>';	
											echo '<li><a href="pInventori.php?page='.$lastpage.$param.'">'.$lastpage.'</a></li>';		
										}
										//in middle; hide some front and some back
										elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
										{
											echo '<li><a href="pInventori.php?page=1'.$param.'">1</a></li>';	
											echo '<li><a href="pInventori.php?page=2'.$param.'">2</a></li>';
											echo '<li>[...]</li>';											
											for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
											{
												if ($counter == $page)
													echo '<li><a href="#" class="current_page"><span><span>'.$counter.'</span></span></a></li>';
												else
													echo '<li><a href="pInventori.php?page='.$counter.$param.'">'.$counter.'</a></li>';						
											}
											echo '<li>[...]</li>';
											echo '<li><a href="pInventori.php?page='.$lpm1.$param.'">'.$lpm1.'</a></li>';	
											echo '<li><a href="pInventori.php?page='.$lastpage.$param.'">'.$lastpage.'</a></li>';												
										}
										//close to end; only hide early pages
										else
										{
											echo '<li><a href="pInventori.php?page=1'.$param.'">1</a></li>';	
											echo '<li><a href="pInventori.php?page=2'.$param.'">2</a></li>';
											echo '<li>[...]</li>';	
											for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
											{
												if ($counter == $page)
													echo '<li><a href="#" class="current_page"><span><span>'.$counter.'</span></span></a></li>';
												else
													echo '<li><a href="pInventori.php?page='.$counter.$param.'">'.$counter.'</a></li>';						
											}
										}
									}
									//next button
									if ($page < $counter - 1) 
										echo '<li><a href="pInventori.php?page='.$next.$param.'" class="pag_nav"><span><span>Seterusnya</span></span></a> </li>';
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