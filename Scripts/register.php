<?php
	if(isset($_POST['user']) and !preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['user'])){
		$username = $_POST['user'];
		$flag1 = true;
	} else {
		echo "username not set or has invalid characters! <br>";
		$flag1 = false;
	}
	//Check User ID
	if(isset($_POST['confirmpass']) and !preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['confirmpass'])){
		$password = hash('sha256', $_POST['confirmpass']);
		$flag2 = true;
	} else {
		echo "password not set or has invalid characters! <br>";
		$flag2 = false;
	}

	$admin = $_POST['email'];
	echo $admin;
	if($admin === "")
	{
		$flag3 = false;
	} else {
		$flag3 = true;
	}

	if($flag1 && $flag2 && !$flag3)
	{
		if(strlen($username)<=100 && strlen($password)>=8 && strlen($password)<=100)
		{
			//Connect to DB
			session_start();
			try {
				$dbh = new PDO('pgsql:dbname=postgres');				
				} catch (PDOException $e) {
				echo "Error: ".$e->getMessage()."<br/>";
				die();
			}
			$st = $dbh->prepare("INSERT INTO
			users (id, username,password) VALUES(DEFAULT,?,?)");
			$st->bindParam(1, $username);
			$st->bindParam(2, $password);
			$successful = $st->execute();
			$result = $st->fetch();
			if($successful){
				//Get me Id
                        	$st = $dbh->prepare("SELECT id FROM
                        	users WHERE username = ? ");
                	        $st->bindParam(1, $username);
        	                $succtt = $st->execute();
	                        $result = $st->fetch();
	                        $userid = $result[0];

                        	$succ = $st->execute();
                        	$result = $st->fetch();
		                echo "Account Registered!";
				header('Location: ../View/login.html');
			}
			 else
			{
				echo "That User Account already exists please try again! Please go back to the register page.";
			}
		}
		else
		{
			echo "INVALID LENGTH";
		}
	}
	if($flag1 && $flag2 && $flag3)
	{
		if(strlen($username)<=100 && strlen($password)>=8 && strlen($password)<=100)
                {
                        //Connect to DB
                        session_start();
                        try {
                                $dbh = new PDO('pgsql:dbname=postgres');                                
                                } catch (PDOException $e) {
                                echo "Error: ".$e->getMessage()."<br/>";
                                die();
                        }
                        $st = $dbh->prepare("INSERT INTO
                        adminm(adminid, username,password) VALUES(nextval('admin_id'),?,?)");
                        $st->bindParam(1, $username);
                        $st->bindParam(2, $password);
                        $successful = $st->execute();
                        $result = $st->fetch();
                        if($successful){
                                //Get me Id
                                $st = $dbh->prepare("SELECT id FROM
                                users WHERE username = ? ");
                                $st->bindParam(1, $username);
                                $succtt = $st->execute();
                                $result = $st->fetch();
                                $userid = $result[0];

                                $succ = $st->execute();
                                $result = $st->fetch();
                                echo "Account Registered!";
                                header('Location: ../View/login.html');
                        }
                         else
                        {
                                echo "Account already exists please try again! Please go back to the register page.";
                        }
                }
                else
                {
                        echo "INVALID LENGTH";
                }
	}
?>
