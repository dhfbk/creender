<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 mx-auto">

                    <?php

                    if ($_SESSION['message']) {
                        ?>
                            <div class="alert alert-<?php echo $_SESSION['message_kind']; ?>" role="alert">
                                <?php echo $_SESSION['message']; ?>
                            </div>
                        <?php
                    }

                    ?>

                    <!-- form card login -->
                    <div class="card rounded-0">
                        <div class="card-header" id="login-header">
                            <h3 class="mb-0 text-center"><img src="creender.png" /></h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" id="formLogin" novalidate="" method="POST" action="index.php?action=login">
                                <div class="form-group">
                                    <label for="uname1">Username</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" name="uname1" id="uname1" required="">
                                </div>
                                <div class="form-group">
                                    <label for="pwd1">Password</label>
                                    <input type="password" class="form-control form-control-lg rounded-0" id="pwd1" required="" autocomplete="new-password" name="pwd1">
                                </div>
                                <button type="submit" class="btn btn-success btn-lg float-right" id="btnLogin">Login</button>
                            </form>
                        </div>
                        <!--/card-block-->
                    </div>
                    <!-- /form card login -->

                </div>


            </div>
            <!--/row-->

        </div>
        <!--/col-->
    </div>
    <!--/row-->
</div>
<!--/container-->