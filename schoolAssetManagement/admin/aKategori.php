<?php
	include('header.php');
?>
		<!--[if !IE]>start content<![endif]-->
		<div id="content">
			<div class="inner">
				
				<!--[if !IE]>start section<![endif]-->
				<?php

				if(!empty($_GET['del_id'])){
					if( empty($_GET['token']) || $_GET['token'] != $_SESSION['tokenaKategoriDel'] ){
						echo"
						<div class='section'>
							<ul class='system_messages'>
								<li class='red'><span class='ico'></span><strong class='system_title'>Rekod kategori ini tidak boleh dihapuskan!</strong> </li>
							</ul>
						</div>";
					}
					else {
						// All fine: delete 
						$qDel= "delete from kategori where id = $_GET[del_id]" ;
						$rDel = $db->sql_query($qDel);
						
						
						
						$qList= "select * from kategori where parent_id = $_GET[del_id]";
						$rList = $db->sql_fetch($qList);
						foreach ($rList as $i) {
							$qDel2= "delete from kategori where parent_id = $i[id]" ;
							$rDel2 = $db->sql_query($qDel2);
						}	

						$qDel3= "delete from kategori where parent_id = $_GET[del_id]" ;
						$rDel3 = $db->sql_query($qDel3);						
						
						if($rDel){
							echo"
							<div class='section'>
								<ul class='system_messages'>
									<li class='green'><span class='ico'></span><strong class='system_title'>Kategori berjaya dihapuskan!</strong><br> #Jika kategori ini mempunyai sub seperti sub kategori ataupun jenis, semua sub kategori dan jenis sudah dihapuskan. </li>
								</ul>
							</div>";
						}							
						// Unset the token, so that it cannot be used again.
						unset($_SESSION['tokenaKategoriDel']);
					}
				}

				$token = md5(uniqid(rand(), true));
				$_SESSION['tokenaKategoriDel'] = $token;

				?>
				
				<!--[if !IE]>start section<![endif]-->
				<div class="section">
					
					<!--[if !IE]>start title wrapper<![endif]-->
					<div class="title_wrapper">
						<span class="title_wrapper_top"></span>
						<div class="title_wrapper_inner">
							<span class="title_wrapper_middle"></span>
							<div class="title_wrapper_content">
								<h2>Senarai Kategori:</h2>
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
								
								$kategori = "";  
								$level = "";  
								
								if(isset($_GET['kategori']))
									$kategori = mysql_real_escape_string($_GET['kategori']);  
								if(isset($_GET['level']))	
									$level = mysql_real_escape_string($_GET['level']); 
							
								if(isset($_POST['reset'])){
									$_POST= "";
									$kategori = "";
								    $level = "";
								}
								if(isset($_POST['cari'])){
									$kategori = mysql_real_escape_string($_POST['kategori']);  
									$level = mysql_real_escape_string($_POST['level']); 
								}
								//use for pagination url parameter
								$param = "&kategori=$kategori&level=$level";
							?>
							
							<form action="" method="POST" class="search_form">
							
							
							<!--[if !IE]>start fieldset<![endif]-->
							<fieldset>
								<!--[if !IE]>start forms<![endif]-->
								<div class="forms">
								<h3>CARIAN KATEGORI</h3>
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>NAMA :</label>
									<div class="inputs">
										<span class="input_wrapper" style=" width: 430px; " ><input class="text" value="<?php if($kategori != "") echo $kategori; ?>"  name="kategori" type="text" /></span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<label>LEVEL KATEGORI:</label>
									<div class="inputs">
										<span class="input_wrapper select_wrapper">
											<select name="level">
												<option value="" <?php if($level == "") echo 'selected'; ?> >Sila Pilih</option>
												<option value="0" <?php if($level == "0") echo 'selected'; ?> >Kategori</option>
												<option value="1"<?php if($level == "1") echo 'selected'; ?> >Sub Kategori</option>
												<option value="2"<?php if($level == "2") echo 'selected'; ?> >Jenis</option>
											</select>
										</span>
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								
								
								<!--[if !IE]>start row<![endif]-->
								<div class="row">
									<div class="inputs">
										<span class="button blue_button search_button"><span><span><em>CARI</em></span></span><input name="cari" type="submit" /></span>
										<span class="button gray_button"><span><span>RESET</span></span><a href="aKategori.php" ><input name="reset" type="submit" /></a></span> 
									</div>
								</div>
								<!--[if !IE]>end row<![endif]-->
								
								</div>
								<!--[if !IE]>end forms<![endif]-->
								
							</fieldset>
							<!--[if !IE]>end fieldset<![endif]-->
							
							<br/>
							</form>
							
							<div class="table_tabs_menu">
							<a href="aKategoriJenisDaftar.php" class="update"><span><span><em>Daftar Jenis</em><strong></strong></span></span></a>
							<a href="aKategoriSubDaftar.php" class="update"><span><span><em>Daftar Sub Kategori</em><strong></strong></span></span></a>
							<a href="aKategoriDaftar.php" class="update"><span><span><em>Daftar Kategori</em><strong></strong></span></span></a>
							
							</div>
						
							<!--[if !IE]>start table_wrapper<![endif]-->
							<div class="table_wrapper">
								<div class="table_wrapper_inner">
								
								<?php  

									/* 
									   First get total number of rows in data table. 
									   If you have a WHERE clause in your query, make sure you mirror it here.
									*/
									$namaQuery ="nama like '%$kategori%%'";
									
									$namaQueryLevel= "";
									if($level != "")
										$namaQueryLevel = "and level = '$level'";
										
									$qCount= "select COUNT(*) from kategori where $namaQuery 
												  $namaQueryLevel order by parent_id ";
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
									$qList= "select * from kategori where $namaQuery 
												$namaQueryLevel  order by parent_id
												LIMIT $start, $limit ";
									$rList = $db->sql_fetch($qList);			

								?>
								<table cellpadding="0" cellspacing="0" width="100%">
									<tbody>
									<tr>
										<th style="width: 17px;">No.</th>
										<th style="width: 200px;">Nama</th>
										<th style="width: 30px;">Kod</th>
										<th style="width: 120px;">Level Kategori</th>
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
											
										if($i['parent_id'] != ""){
											echo '	
											<tr class="'.$colorRow.'">
												<td>'.$num.'</td>
												<td>'.$i['nama'].'</td>
												<td>'.$i['kod'].'</td>';
												if($i['level'] == 1){
													echo '<td>KATEGORI > SUB KATEGORI</td>';
												}else if($i['level'] == 2){
													echo '<td>KATEGORI > SUB KATEGORI > JENIS</td>';
												}
											echo'<td>
													<div class="actions_menu" style="width:140px;">
														<ul>';
															if($i['level'] == 1){
																echo '<li><a class="edit" href="aKategoriSubKemaskini.php?id='.$i['id'].'">Kemaskini</a></li>
																	  <li><a class="delete" href="aKategori.php?del_id='.$i['id'].'&token='.$_SESSION['tokenaKategoriDel'].'">Hapus</a></li>';
															}else if($i['level'] == 2){
																echo '<li><a class="edit" href="aKategoriJenisKemaskini.php?id='.$i['id'].'">Kemaskini</a></li>
																	  <li><a class="delete" href="aKategori.php?del_id='.$i['id'].'&token='.$_SESSION['tokenaKategoriDel'].'">Hapus</a></li>';
															}
											echo '		</ul>
													</div>
												</td>
											</tr>';
										}else{
											echo '	
												<tr class="'.$colorRow.'">
													<td>'.$num.'</td>
													<td>'.$i['nama'].'</td>
													<td>'.$i['kod'].'</td>
													<td>KATEGORI</td>
													<td>
														<div class="actions_menu" style="width:140px;">
															<ul>
																<li><a class="edit" href="aKategoriKemaskini.php?id='.$i['id'].'">Kemaskini</a></li>
																<li><a class="delete" href="aKategori.php?del_id='.$i['id'].'&token='.$_SESSION['tokenaKategoriDel'].'">Hapus</a></li>
															</ul>
														</div>
													</td>
												</tr>';
										}
										
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
										echo '<li><a href="aKategori.php?page='.$prev.$param.'" class="pag_nav"><span><span>Kembali</span></span></a> </li>';
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
												echo '<li><a href="aKategori.php?page='.$counter.$param.'">'.$counter.'</a></li>';	
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
													echo '<li><a href="aKategori.php?page='.$counter.$param.'">'.$counter.'</a></li>';													
											}
											echo '<li>[...]</li>';
											echo '<li><a href="aKategori.php?page='.$lpm1.$param.'">'.$lpm1.'</a></li>';	
											echo '<li><a href="aKategori.php?page='.$lastpage.$param.'">'.$lastpage.'</a></li>';		
										}
										//in middle; hide some front and some back
										elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
										{
											echo '<li><a href="aKategori.php?page=1'.$param.'">1</a></li>';	
											echo '<li><a href="aKategori.php?page=2'.$param.'">2</a></li>';
											echo '<li>[...]</li>';											
											for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
											{
												if ($counter == $page)
													echo '<li><a href="#" class="current_page"><span><span>'.$counter.'</span></span></a></li>';
												else
													echo '<li><a href="aKategori.php?page='.$counter.$param.'">'.$counter.'</a></li>';						
											}
											echo '<li>[...]</li>';
											echo '<li><a href="aKategori.php?page='.$lpm1.$param.'">'.$lpm1.'</a></li>';	
											echo '<li><a href="aKategori.php?page='.$lastpage.$param.'">'.$lastpage.'</a></li>';												
										}
										//close to end; only hide early pages
										else
										{
											echo '<li><a href="aKategori.php?page=1'.$param.'">1</a></li>';	
											echo '<li><a href="aKategori.php?page=2'.$param.'">2</a></li>';
											echo '<li>[...]</li>';	
											for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
											{
												if ($counter == $page)
													echo '<li><a href="#" class="current_page"><span><span>'.$counter.'</span></span></a></li>';
												else
													echo '<li><a href="aKategori.php?page='.$counter.$param.'">'.$counter.'</a></li>';						
											}
										}
									}
									//next button
									if ($page < $counter - 1) 
										echo '<li><a href="aKategori.php?page='.$next.$param.'" class="pag_nav"><span><span>Seterusnya</span></span></a> </li>';
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