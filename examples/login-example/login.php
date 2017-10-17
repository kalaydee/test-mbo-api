<?php
	include '../includes/header.php';

	if(!empty($_POST)) {
		$validateLogin = $mb->ValidateLogin(array(
			'Username' => $_POST['username'],
			'Password' => $_POST['password']
		));
		if(!empty($validateLogin['ValidateLoginResult']['GUID'])) {
			$_SESSION['GUID'] = $validateLogin['ValidateLoginResult']['GUID'];
			$_SESSION['client'] = $validateLogin['ValidateLoginResult']['Client'];
			header("location:welcome.php");
		} else {
			if(!empty($validateLogin['ValidateLoginResult']['Message'])) {
				$message = $validateLogin['ValidateLoginResult']['Message'];
				echo "<script type='text/javascript'>
						alert('$message');
						window.location.href = 'index.php?incorrect-logins';
					</script>";
			} else {
				$message = "Invalid Login";
				echo "<script type='text/javascript'>
						alert('$message');
						window.location.href = 'index.php?invalid-logins';
					</script>";
			}
		}
	} else if(empty($_SESSION['GUID'])) {
?>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form method="POST">
                    <div class='panel panel-default' style="margin-top:40px;">
                        <div class="panel-heading">Sign Up</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="password">
                            </div>
                        </div>
                        <div class='panel-footer clearfix'>
                            <div class='pull-right'>
                                <button type="submit" class="btn btn-primary">Log in</button>
                                <a href="signup.php" class="btn btn-default">Sign up</a>
                            </div>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
</body>
</html>
<?php
	} else {
		header("location:welcome.php");
	}
	// function displayLoginForm() {
	// 	echo "<form method='POST'>
	// 			<div class='panel panel-default' style='margin-top:40px;'>
	// 				<div class='panel-heading'>Sign Up</div>
	// 				<div class='panel-body'>
	// 					<div class='form-group'>
	// 						<input type='text' name='username' class='form-control' placeholder='Username'>
	// 					</div>
	// 					<div class='form-group'>
	// 						<input type='password' name='password' class='form-control' placeholder='password'>
	// 					</div>
	// 				</div>
	// 				<div class='panel-footer clearfix'>
	// 					<div class='pull-right'>
	// 						<button type='submit' class='btn btn-primary'>Log in</button>
	// 						<a href='signup.php' class='btn btn-default'>Sign up</a>
	// 					</div>
	// 				</div>
	// 			</div>
	// 		</form>";
	// }

	// function displayWelcome() {
	// 	echo "<div class='col-md-12' style='margin-top:20px;'>
	// 			<div class='row'>	
	// 				<div class='col-md-6'>
	// 					<div class='pull-left'>
	// 						<label class='control-label'>Welcome ".$_SESSION['client']['FirstName'].' '.$_SESSION['client']['LastName']."</label>
	// 					</div>
	// 				</div>
	// 				<div class='col-md-6'>
	// 					<div class='pull-right'>
	// 						<label class='control-label'><a href='logout.php'>Log out</a></label>
	// 					</div>
	// 				</div>
	// 			</div>
	// 		</div>
	// 		<div class='col-md-12'>	
	// 			<div class='row'>
	// 				<pre>".print_r($_SESSION,1)."</pre>
	// 			</div>
	// 		</div>";
	// }
?>