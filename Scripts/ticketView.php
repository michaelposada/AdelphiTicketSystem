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

				</style>
        </head>
		<body>		
            <div id="view">
				<div id="login">
					<form action="../Scripts/register.php" method="post">
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
										<h2 class="title" style = "font-size:20px">Previous tickets.</h2> 
										<table>
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
													<td><?php echo "$row[$x]"; ?></td>
												<?php
                        									}
                									}
										?>
										</table>
									</div>
								
									<div class="vl"></div>
								
									<div class="column"> 
										<h3 class="title" style = "font-size:20px">Create a new ticket.</h3> 
										<div align="left" style="padding-left: 100px">
											Subject:		 
											<input type="text" name="subject" class="ticketsubject" placeholder="Enter ticket subject" required><br><br>
											Category:		 
											<div class="dropdown">
											  <button class="dropbtn">Default &#8628;</button>
											  <div class="dropdown-content">
												<a href="#">Link 1</a>
												<a href="#">Link 2</a>
												<a href="#">Link 3</a>
											  </div>
											</div>
											<br> <br> 
											<div>
												Description:
												<textarea type="text" name="ticketdescription" placeholder="Enter ticket description" class="form-control" rows="5" cols="80" required>
												</textarea>
											</div>
											<br><br><br>
										</div>									
										<input type="submit" value="Confirm ticket">
									</div>
								</div>
							</center> 
						</p>
					</form>
				</div>	
            </div>
		</body>
</html>

