<?php
    session_start();
    include '../includes/header.php';
    include '../includes/nav.php';

    $birthDate = date_create($_SESSION['client']['BirthDate']);
    $birthDate = date_format($birthDate,"M d, Y");
?>            
            <div class="col-md-6 col-md-offset-3">	
                <div class="col-md-12" style="margin-top: 20px;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="pull-left">
                                <label class="control-label">Welcome <?= $_SESSION['client']['FirstName'].' '.$_SESSION['client']['LastName']; ?></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pull-right">
                                <label class="control-label"><a href="logout.php">Log out</a></label>
                            </div>
                        </div>
                    </div>         
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-md-6">First Name</label>
                            <label class="control-label col-md-6"><?= $_SESSION['client']['FirstName']; ?></label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-6">Last Name</label>
                            <label class="control-label col-md-6"><?= $_SESSION['client']['LastName']; ?></label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-6">Birth Date</label>
                            <label class="control-label col-md-6"><?= $birthDate; ?></label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-6">Mobile Phone</label>
                            <label class="control-label col-md-6"><?= $_SESSION['client']['MobilePhone']; ?></label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-6">Address</label>
                            <label class="control-label col-md-6"><?= $_SESSION['client']['AddressLine1'].'<br>'.$_SESSION['client']['City'].', '.$_SESSION['client']['State'].'<br>'.$_SESSION['client']['PostalCode']; ?></label>
                        </div>
                        <pre><?= print_r($_SESSION); ?></pre>
                    </div>
                </div>
            </div>