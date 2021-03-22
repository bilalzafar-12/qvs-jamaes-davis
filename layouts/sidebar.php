<nav id="sidebar">
    <p></p>
    <img src="assets/img/qvs_logo4.png" id="sidebar_logo" >
    <div class="p-4 pt-5" style="margin-top:-35%;">
        <a href="dashboard.html" class="img logo rounded-circle mb-5" style="background-image: url(assets/images/logo.jpg);"></a>
        <ul class="list-unstyled components mb-5">
            <li <?php if(basename($_SERVER['PHP_SELF']) == 'dashboard.php') { ?> class="active" <?php } ?>>
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> 
                    <i class="fa fa-home" style="margin: 0% 1% 0% 1%;"> </i> 
                    Dashboard
                </a>
                <?php 
                    $emailQ = "SELECT id,subscription_expiry_date  FROM user_subscription WHERE user_id='$loggedInUserID' LIMIT 1";	
                    $checkSubsExpiry = $connection->query($emailQ);
                    if ($checkSubsExpiry->num_rows > 0) { 
                        $checkSubsExpiryy=mysqli_fetch_assoc($checkSubsExpiry); 		
                        if($checkSubsExpiryy['subscription_expiry_date'] > date('Y-m-d')) { ?>
                            <ul class="collapse list-unstyled" id="homeSubmenu" style="margin-left: 5%;">
                                <li>
                                    <a href="new_validation.php"> 
                                        <i class="fa fa-plus" style="margin: 0% 1% 0% 1%;"> </i> 
                                        New Validation
                                    </a>
                                </li>
                            </ul>
                        <?php }  ?>
                    <?php } ?> 
                    
            </li>
            
           
            <?php if($_SESSION["security"] == "1"){ ?>
                <li <?php if(basename($_SERVER['PHP_SELF']) == 'record.php') { ?> class="active" <?php } ?>>
                    <a href="record.php"> 
                        <i class="fa fa-file" style="margin: 0% 1% 0% 1%;"></i> 
                        Records
                    </a>
                </li>
                <li <?php if(basename($_SERVER['PHP_SELF']) == 'account.php' || basename($_SERVER['PHP_SELF']) == 'editaccount.php') { ?> class="active" <?php } ?>>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle"> 
                        <i class="fa fa-shield-alt" style="margin-left: 1%;"></i> 
                        Security
                    </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu" style="margin-left: 5%;">
                        <li <?php (basename($_SERVER['PHP_SELF']) == 'account.php') ? 'class="active"' : ''; ?> >
                            <a href="account.php"> <i class="fa fa-users-cog" style="margin: 0% 1% 0% 1%;"> </i> User Accounts</a>
                        </li>
                    </ul>
                </li>
            <?php } ?>
            <li>
                <a href="#"> <i class="fa fa-cog" style="margin: 0% 1% 0% 1%;"> </i> Settings </a>
            </li>
            <li>
                <a href="logout.php"> <i class="fa fa-sign-out-alt" style="margin: 0% 1% 0% 1%;"> </i> Log out</a>
            </li>
        </ul>
    </div>
</nav>