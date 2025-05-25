  <div class="navbar navbar-fixed-top navbar-inverse">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <span class="brand" href="#">ADMIN Panel</span>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
						<?php $query= mysqli_query($conn,"select * from users where user_id = '$session_id'")or die(mysqli_error($conn));
								$row = mysqli_fetch_array($query);
                                
						?>
                            <li class="dropdown">
                            <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
    <i class="icon-user icon-large"></i>
    <?php 
    if(isset($row) && !is_null($row)) {
        echo $row['firstname'] . " " . $row['lastname'];
    } else {
        echo ""; // or any default value you want to display
    }
    ?>
    <i class="caret"></i>
</a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="#">Profile</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a tabindex="-1" href="../login.php"><i class="icon-signout"></i>&nbsp;Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>