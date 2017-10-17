<?php
	session_start();
	require '../../src/MB_API.php';
	
	$mb = new MB_API(array(
		"SourceName"=>'ScaleUpMarketingAsia', 
		"Password"=>'1a4prK7PqFKXzYWOIekDKtRlOrs=', 
		"SiteIDs"=>array('-99')
	));

	if(!empty($_POST['data']['Client'])) {
		$options = array(
			'Clients'=>array(
				'Client'=>$_POST['data']['Client']
			)
		);
		$signupData = $mb->AddOrUpdateClients($options);
		if($signupData['AddOrUpdateClientsResult']['Clients']['Client']['Action'] == 'Added') {
			$validateLogin = $mb->ValidateLogin(array(
				'Username' => $_POST['data']['Client']['Username'],
			'	Password' => $_POST['data']['Client']['Password']
			));
			if(!empty($validateLogin['ValidateLoginResult']['GUID'])) {
				$_SESSION['GUID'] = $validateLogin['ValidateLoginResult']['GUID'];
				$_SESSION['client'] = $validateLogin['ValidateLoginResult']['Client'];
			}
			header('location:index.php');
		}
	}
	
	$requiredFields = $mb->GetRequiredClientFields();
	if(!empty($requiredFields['GetRequiredClientFieldsResult']['RequiredClientFields']['string'])) {
		$requiredFields = $mb->makeNumericArray($requiredFields['GetRequiredClientFieldsResult']['RequiredClientFields']['string']);
	} else {
		$requiredFields = false;
	}
	
	$requiredFieldsInputs = '';
	if(!empty($requiredFields)) {
		foreach($requiredFields as $field) {
			$requiredFieldsInputs .= "<div class='form-group col-md-12'><label for='$field' class='control-label col-md-3'>{$field}: </label><div class='col-md-9'><input type='text' name='data[Client][$field]' class='form-control' id='$field' placeholder='$field' required /></div></div>";
		}
	}

	if(!empty($signupData['AddOrUpdateClientsResult']['Clients']['Client']['Action']) && $signupData['AddOrUpdateClientsResult']['Clients']['Client']['Action'] == 'Failed' && !empty($signupData['AddOrUpdateClientsResult']['Clients']['Client']['Messages'])) {
		foreach($signupData['AddOrUpdateClientsResult']['Clients']['Client']['Messages'] as $message) {
			echo "<pre>".print_r($message,1).'</pre>';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/10.0.2/css/intlTelInput.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/10.0.2/js/intlTelInput.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>MindBody Online API Test</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form method="POST" style="line-height:2">
					<div class="panel panel-default" style="margin-top:40px;">
						<div class="panel-heading">Sign Up</div>
						<div class="panel-body">
							<div class="form-group col-md-12">
								<label for="Username" class="control-label col-md-3">Username: </label>
								<div class="col-md-9">
									<input type="text" name="data[Client][Username]" class="form-control" id="Username" placeholder="Username" required>
								</div>
							</div>
							<div class="form-group col-md-12">
								<label for="Password" class="control-label col-md-3">Password: </label>
								<div class="col-md-9">
									<input type="password" name="data[Client][Password]" class="form-control" id="Password" placeholder="Password" required>
								</div>
							</div>
							<div class="form-group col-md-12">
								<label for="FirstName" class="control-label col-md-3">First Name: </label>
								<div class="col-md-9">
									<input type="text" name="data[Client][FirstName]" class="form-control" id="FirstName" placeholder="First Name" required>
								</div>
							</div>
							<div class="form-group col-md-12">
								<label for="LastName" class="control-label col-md-3">Last Name: </label>
								<div class="col-md-9">
									<input type="text" name="data[Client][LastName]" class="form-control" id="LastName" placeholder="Last Name" required>
								</div>
							</div>
						<?php if(!empty($requiredFields)) : ?>
							<div class="form-group col-md-12">
								<label for="<= $requiredFields['0']; ?>" class="control-label col-md-3">Address Line</label>
								<div class="col-md-9">
									<input type="text" name="data[Client][<?= $requiredFields['0']; ?>]" class="form-control" id="<?= $requiredFields['0']; ?>" placeholder="Street/Bldg/Suite No." required>
								</div>
							</div>
							<div class="form-group col-md-12">
								<label for="$requiredFields['1']" class="control-label col-md-3"><?= $requiredFields['1']; ?></label>
								<div class="col-md-9">
									<input type="text" name="data[Client][<?= $requiredFields['1']; ?>]" class="form-control" id="<?= $requiredFields['1']; ?>" placeholder="<?= $requiredFields['1']; ?>" required>
								</div>
							</div>
							<div class="form-group col-md-12">
								<label for="$requiredFields['2']" class="control-label col-md-3"><?= $requiredFields['2']; ?></label>
								<div class="col-md-9">
									<input type="text" name="data[Client][<?= $requiredFields['2']; ?>]" class="form-control" id="<?= $requiredFields['2']; ?>" placeholder="<?= $requiredFields['2']; ?>" required>
								</div>
							</div>
							<div class="form-group col-md-12">
								<label for="$requiredFields['3']" class="control-label col-md-3">Postal Code</label>
								<div class="col-md-9">
									<input type="text" name="data[Client][<?= $requiredFields['3']; ?>]" class="form-control" id="<?= $requiredFields['3']; ?>" placeholder="Postal Code" required>
								</div>
							</div>
							<div class="form-group col-md-12">
								<label for="$requiredFields['4']" class="control-label col-md-3">Reffered By</label>
								<div class="col-md-9">
									<input type="text" name="data[Client][<?= $requiredFields['4']; ?>]" class="form-control" id="<?= $requiredFields['4']; ?>" placeholder="Reffered By" required>
								</div>
							</div>
							<div class="form-group col-md-12">
								<label for="$requiredFields['5']" class="control-label col-md-3">Birth Date</label>
								<div class="col-md-9">
									<input type="text" name="data[Client][<?= $requiredFields['5']; ?>]" class="form-control" id="<?= $requiredFields['5']; ?>" placeholder="YYYY-MM-DD" required>
								</div>
							</div>
							<div class="form-group col-md-12">
								<label for="$requiredFields['6']" class="control-label col-md-3">Mobile Phone</label>
								<div class="col-md-9">
									<input type="text" name="data[Client][<?= $requiredFields['6']; ?>]" class="form-control" id="<?= $requiredFields['6']; ?>" placeholder="Mobile Phone" required>
								</div>
							</div>
						<?php endif; ?>
						</div>
						<div class="panel-footer clearfix">
							<div class="pull-right">
								<a href="index.php" class="btn btn-default"><span></span>Cancel</a>
								<button type="submit" class="btn btn-primary"><span></span>Sign up</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>