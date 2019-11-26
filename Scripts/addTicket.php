<?php
		session_start();
		if(array_key_exists('editTicket',$_POST))
		{
			$input = array(100,200,300,400,500);
                        $rand_keys = array_rand($input,1);
                        $adminid = $input[$rand_keys];
			$userid = $_SESSION['userid'];
                        $catergory = $_POST['category'];
                        $subject = $_POST['subject'];
                        $description = $_POST['ticketdescription'];
			$ticketid = $_POST['ticketid'];
                        try
                        {
                                $dbh = new PDO('pgsql:dbname=postgres');
                                echo "Connected to Database";
                        } catch(PDOException $e){
                                print "Error with Database: ".$e->getMessage()."<br/>";
                                die();
                        }
			$boolean1 = False;
			$boolean2 = False;


			if($description == "")
			{
				$boolean2 = True;
			}


			if($boolean2==True)
			{
				echo "Here";
				$st = $dbh->prepare("UPDATE tickets SET category=? WHERE(userid=? AND ticketid=?)");
	                        $st->bindParam(1, $catergory);
	                        $st->bindParam(2, $userid);
				$st->bindParam(3, $ticketid);
				$st->execute();
				if($result)
                                {
                                       $succ = false;
                                       echo "Error";
                                        //header('Location: ../index.html');
                                       //figure out where we want to go
                                }
                                else
                                {
                                        $succ = true;
                                        header('Location: ticketView.php');
                                }

			}
			elseif($boolean2==FALSE)
			{
				$st = $dbh->prepare("UPDATE tickets SET category=?, description=? WHERE(userid=? AND ticketid=?)");
				$st->bindParam(1, $catergory);
				$st->bindParam(2, $description);
				$st->bindParam(3, $userid);
                                $st->bindParam(4, $ticketid);
				$st->execute();
                      	        $result = $st->fetch();
				echo "Right before if";
	                        if($result)
         	                {
                 	               $succ = false;
                 	               echo "Error";
                        	        //header('Location: ../index.html');
                 	               //figure out where we want to go
                        	}
                        	else
                        	{
                        	        $succ = true;
                        	        header('Location: ticketView.php');
                        	}

			}


		}


		if(array_key_exists('addTicket',$_POST))
		{

			$input = array(100,200,300,400,500);
			$rand_keys = array_rand($input,1);
			$adminid = $input[$rand_keys];
			$userid = $_SESSION['userid'];
			$catergory = $_POST['category'];
			$subject = $_POST['subject'];
			$description = $_POST['ticketdescription'];
			echo $subject;

			try
			{
				$dbh = new PDO('pgsql:dbname=postgres');
				echo "Connected to Database";
			} catch(PDOException $e){
				print "Error with Database: ".$e->getMessage()."<br/>";
				die();
			}
			$x = date_create();
			$day = date_format($x,"m/d/Y");
			$day = strval($day);
			$st = $dbh->prepare("
			INSERT INTO tickets(category, adminid, ticketid, description, status, userid, datacreated) VALUES(?,? , DEFAULT, ?, 'Not Fixed', ?, ?)");
			$st->bindParam(1, $catergory);
			$st->bindParam(2, $adminid);
			$st->bindParam(3, $description);
			//$st->bindParam(2, $subject);
			$st->bindParam(4, $userid);
        	        $st->bindParam(5, $day);
			$st->execute();
			$result = $st->fetch();
			//$_SESSION['userid'] = $result[0];
				//$successful = false;
			if($result)
			{
				$succ = false;
				echo "Error";
				//header('Location: ../index.html');
				//figure out where we want to go
			}
			else
			{
				$succ = true;
				header('Location: ticketView.php');
			}
		}
		if(array_key_exists('editTicket2',$_POST))
		{
			$input = array(100,200,300,400,500);
                        $rand_keys = array_rand($input,1);
                        $adminid = $input[$rand_keys];
			$userid = $_SESSION['userid'];
           		$catergory = $_POST['category'];
            		$subject = $_POST['subject'];
            		$description = $_POST['ticketdescription'];
			$ticketid = $_POST['ticketid'];
            		$status = $_POST['status'];
			try
                        {
                                $dbh = new PDO('pgsql:dbname=postgres');
                                echo "Connected to Database";
                        } catch(PDOException $e){
                                print "Error with Database: ".$e->getMessage()."<br/>";
                                die();
                        }
			$boolean1 = False;
			$boolean2 = False;
			
			if($status == "")
			{
				$boolean = True;
			}
			if($description == "")
			{
				$boolean2 = True;
			}
			if($boolean2 && $boolean1)
			{
				echo "Here";
				$st = $dbh->prepare("UPDATE tickets SET category=? WHERE(adminid=? AND ticketid=?)");
	                        $st->bindParam(1, $catergory);
	                        $st->bindParam(2, $userid);
				$st->bindParam(3, $ticketid);
				$st->execute();
				if($result)
                                {
                                       $succ = false;
                                       echo "Error";
                                        //header('Location: ../index.html');
                                       //figure out where we want to go
                                }
                                else
                                {
                                        $succ = true;
                                        header('Location: ticketView.php');
                                }



			}
			elseif(!$boolean2 && !$boolean1)
			{
				if($status == "Fixed")
				{
					$x = date_create();
                        		$day = date_format($x,"m/d/Y");
                        		$day = strval($day);

					$st = $dbh->prepare("UPDATE tickets SET category=?, description=?, status=?, dataresolved=?  WHERE(adminid=? AND ticketid=?)");
					$st->bindParam(1, $catergory);
					$st->bindParam(2, $description);
					$st->bindParam(3, $status);
					$st->bindParam(4, $day);
					$st->bindParam(5, $userid);
	                                $st->bindParam(6, $ticketid);
					$st->execute();
	                      	        $result = $st->fetch();
				}
				else
				{
					$st = $dbh->prepare("UPDATE tickets SET category=?, description=?, status=? WHERE(adminid=? AND ticketid=?)");
                                        $st->bindParam(1, $catergory);
                                        $st->bindParam(2, $description);
                                        $st->bindParam(3, $status);
                                        $st->bindParam(4, $userid);
                                        $st->bindParam(5, $ticketid);
                                        $st->execute();
                                        $result = $st->fetch();
                                }
				echo "Right before if";
	                        if($result)
         	                {
                 	              $succ = false;
                 	               echo "Error";
                        	        //header('Location: ../index.html');
                 	               //figure out where we want to go
                        	}
                        	else
                        	{
                        	        $succ = true;
                        	        header('Location: adminTicketPage.php');
                        	}
			}
		}
?>
