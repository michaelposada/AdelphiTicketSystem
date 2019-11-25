<!DOCTYPE html>
<html lang="en" class="login-register-bg"> 
    <title>Create Ticket</title>
        <head>
            <link rel="stylesheet" type="text/css" href="../Assests/stylesheet.css">
            <link href="https://fonts.googleapis.com/css?family=Biryani:800" rel="stylesheet">
				<style>
					body {
						background-image: url("main.jpg");
						background-repeat:no-repeat;
						background-position: fixed;
						background-size:cover;
						zoom:120%;
					}	
					
					hr{
						overflow: visible; 
						height: 30px;
						border-style: solid;
						border-color: black;
						border-width: 1px 0 0 0;
						border-radius: 20px;
					}
					hr:before { 
						display: block;
						content: "";
						height: 30px;
						margin-top: -31px;
						border-style: solid;
						border-color: black;
						border-width: 0 0 1px 0;
						border-radius: 20px;
					}
					
					#wrapper {
						margin-left:auto;
						margin-right:auto;
						width:960px;
					}
					
					.column {
					  float: left;
					  width: 50%;
					}

					/* Clear floats after the columns */
					.row:after {
					  content: "";
					  display: table;
					  clear: both;
					}
					
					/* vertical line separating columns */
					.vl {
					  border-left: 2px solid black;
					  height: 650px;
					  position: absolute;
					  left: 50%;
					  margin-left: -3px;
					  top: 50;
					}
					
					/* table borders */
					table, th, td {
						border: 1px solid black;
					}
					
					
					
					/* dropdown css */
					/* Style The Dropdown Button */
					.dropbtn {
					  background-color: #A9A9A9;
					  color: black;
					  padding: 2px;
					  font-size: 16px;
					  border: none;
					  cursor: pointer;
					}

					/* The container <div> - needed to position the dropdown content */
					.dropdown {
					  position: relative;
					  display: inline-block;
					}

					/* Dropdown Content (Hidden by Default) */
					.dropdown-content {
					  display: none;
					  position: absolute;
					  background-color: #f9f9f9;
					  min-width: 160px;
					  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
					  z-index: 1;
					}

					/* Links inside the dropdown */
					.dropdown-content a {
					  color: black;
					  padding: 6px 6px;
					  text-decoration: none;
					  display: block;
					}

					/* Change color of dropdown links on hover */
					.dropdown-content a:hover {background-color: #A9A9A9}

					/* Show the dropdown menu on hover */
					.dropdown:hover .dropdown-content {
					  display: block;
					}

					/* Change the background color of the dropdown button when the dropdown content is shown */
					.dropdown:hover .dropbtn {
					  background-color: #A9A9A9;

					 /* --------------------------- */
					 /* search bar for ticket pages */
					 /* --------------------------- */
				</style>
        </head>
	<script>
        function r2()
        {
	        alert("HEY MICHAEL");
		var tbl = document.getElementById("originalTable");
		tbl.sytle.display = "none";
        }
       </script>
		<body>		
            <div id="view">
				<div id="login">
						<p style = "font-family:georgia,garamond,serif;font-size:16px;font-style:italic;">
							<center>
									<?php
									session_start();
									//Connect to DB
									$dbh = pg_connect(" dbname=postgres");
									if (!$dbh)
									{
										echo "An error occurred.\n";
									        exit;
									}
										$userid = $_SESSION['userid'];
									$result = pg_query($dbh, "SELECT username FROM users WHERE id = " .$userid.  "");
								?>
								<h1 class="title">Welcome <?php $r = pg_fetch_row($result); echo "$r[0].";?></h1>
								<hr>
								<div class="row">
									<div class="column">
										<table style="width:70%">
										<h2 class="title" style = "font-size:20px">Previous Tickets.</h2> 
										<form method="post">
											Tag:
											<select name="searchTag">
											<option value="category">Category</option>
											<option value="description">Description</option>
											<option value="datacreated">Date Created</option>
											<option value="status">Status</option>
											<option value="adminid">Admin ID</option>
											<option value="dataresolved">Date Resolved</option>
											</select>
											<input style="width: 300px;" type="text" name="search" class="ticketsearch" placeholder="Search..." required>
											<input type="submit" value="&#x1F50D" name="submitSearch" onClick="r2()"> <br> <br>
										</form>
										<table id="searchTable">
                                                                                <?php
											if(array_key_exists('submitSearch',$_POST))
											{
												session_start();
												//Connect to DB
												$dbh = pg_connect(" dbname=postgres");
												if (!$dbh)
												{
													echo "An error occurred With Connecting to the Database.\n";
													exit;
												}
												$userid = $_SESSION['userid'];
												$tag = $_POST['searchTag'];
												$search = $_POST['search'];
												//$result = pg_query($dbh, "SELECT * FROM tickets WHERE(userid='1' AND category='link1')");
												$result = pg_query($dbh, "SELECT * FROM tickets WHERE(userid ='".$userid."' AND ".$tag." = '".$search."')");
												$i = pg_num_fields($result);
												if ($result == false)
												{
													echo "An error occurred.\n";
													exit;
												}
												while ($row = pg_fetch_row($result))
												{
													$count = count($row);
													for($x = 0; $x < $count; $x++)
													{
														$columnName = pg_field_name($result, $x);
														?>
														<th><?php echo "$columnName"; ?></th>
														<?php
														if($x==$count-1)
														{
															?></tr><?php
														}
														?>
														<?php
													}
													for($x = 0; $x < $count; $x++)
													{
														?>
														<td><?php echo "$row[$x]"; ?></td>
														<?php
														if($x==$count-1)
														{ 
															?></tr><?php
														}
													}
												}

											}

										?>



										<table id="originalTable">
										<?php
									                session_start();
                									//Connect to DB
                									$dbh = pg_connect(" dbname=postgres");
               										 if (!$dbh)
               										 {
                         									echo "An error occurred.\n";
                        									exit;
                									 }
                									$userid = $_SESSION['userid'];
                									$result = pg_query($dbh, "SELECT * FROM tickets WHERE userid = " .$userid.  "");
                									$i = pg_num_fields($result);
                									if (!$result)
                									{
                        									echo "An error occurred.\n";
                       										exit;
               										}
               										while ($row = pg_fetch_row($result))
                									{
                        									$count = count($row);
												for($x = 0; $x < $count; $x++)
                        									{
													$columnName = pg_field_name($result, $x);
												?>
													<th><?php echo "$columnName"; ?></th>
													<?php
													if($x==$count-1)
													{
														?></tr><?php
													}
													?>
												<?php
                        									}
												for($x = 0; $x < $count; $x++)
												{
													?>
													<td><?php echo "$row[$x]"; ?></td>
													<?php
													if($x==$count-1)
                                                                                                        { 
                                                                                                                ?></tr><?php
                                                                                                        }
                                                                                                    
												}
                									}
										?>
										</table>
									</div>
								
									<div class="vl"></div>
									
									<div class="column"> 
										<h3 class="title" style = "font-size:20px">Create Ticket.</h3> 
										<div align="left" style="padding-left: 100px">
										<form action="addTicket.php" method="post">

											Subject:		 
											<input type="text" name="subject" class="ticketsubject" placeholder="Enter ticket subject" required><br><br>
											Category:		 
											  <select name="category">
												<option value="Error with Login">Error with Login</option>
												<option value="Connection Error">Connection Error</option>
												<option value="Other">Other</option>
											  </select>
											<br> <br>
											Description:
										</div>
											<textarea type="text" name="ticketdescription" placeholder="Enter ticket description" class="form-control" rows="6" cols="75" required> </textarea>
											<br> <br>
											<input type="submit" name="addTicket" formaction="addTicket.php" value="Confirm ticket">
										</form>
									<br> <br> <br>
									
									----------------------------------------------------------------------------------------------------------------
									
										<h3 class="title" style = "font-size:20px">Edit Ticket.</h3> 
										<div align="left" style="padding-left: 100px">
										<form action="addTicket.php" method="post">

											Subject:
											<input type="text" name="subject" class="ticketsubject" placeholder="Enter ticket subject" required><br><br>
											Category:
											  <select name="category">
													<option value="Error with Login">Error with Login</option>
													<option value="Connection Error">Connection Error</option>
													<option value="Other">Other</option>
											  </select>
											<br> <br> 
											Ticket ID:
											<input type="text" name="ticketid" class="ticketsubject" placeholder="Enter Ticket ID" required><br><br>
											Description:	
										</div>	
											<textarea type="text" name="ticketdescription" placeholder="Enter ticket description" class="form-control" rows="6" cols="75"> </textarea>
											<br> <br>                                                               
											<input type="submit" name="editTicket" formaction="addTicket.php" value="Confirm edit">							
										</form>
									</div>
							</center> 
						</p>
					</form>
				</div>	
            </div>
		</body>
</html>
