<?php
	if(isset($_POST['user']) and !preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['user']))
	{
		$username = $_POST['user'];
		$flag1 = true;
	}
	else
	{
		echo "Username not set or has invalid characters! <br>";
		$flag1 = false;
	}

	//Check USER ID
	if(isset($_POST['pass']) and !preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['pass']))
	{
		$password = hash('sha256', $_POST['pass']);
		$flag2 = true;
	}
	else
	{
		echo "Password not set or has invalid character! <br>";
		$flag2 = false;
	}

	if($flag1 && $flag2)
	{
		// Connect to DB
		session_start();
		try
		{
			$dbh = new PDO('pgsql:dbname=postgres');
		} catch(PDOException $e){
			print "Error with Database: ".$e->getMessage()."<br/>";
			die();
		}
		$st = $dbh->prepare("
		SELECT id FROM users WHERE username = ? AND password = ? LIMIT 1");
		$st->bindParam(1, $username);
		$st->bindParam(2, $password);
		$st->execute();
		$result = $st->fetch();
		$_SESSION['userid'] = $result[0];
		$successful = false;
		if($result[0] === null)
		{
			//header('Location: ../index.html');
			//figure out where we want to go
			$st = $dbh->prepare("
                	SELECT adminid FROM adminm WHERE username = ? AND password = ? LIMIT 1");
                	$st->bindParam(1, $username);
                	$st->bindParam(2, $password);
                	$st->execute();
                	$result = $st->fetch();
                	$_SESSION['userid'] = $result[0];
                	$successful = false;
                	if($result[0] == null)
                	{
                	        echo "Error";
                	        //header('Location: ../index.html');
                	        //figure out where we want to go
                	}
			else	{
				echo "Worked";
				header('Location: adminTicketPage.php');
			}
		}
		else
		{
			header('Location: ticketView.php');
		}
	}
?>
