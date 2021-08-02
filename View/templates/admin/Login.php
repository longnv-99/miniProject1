<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <form action="../../../Controller/LoginController.php" method="post">
                    <span style="color: red;font-style: italic" id="username-error"></span>
                    <div class="input-group mb-3">
                        <input autofocus type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $username ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    
                    <span style="color: red;font-style: italic;" id="password-error"></span>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo $password ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="input-group mb-3">
                        <span style="color: red; font-style: italic;"><?php echo isset($_SESSION['error']) ? $_SESSION['error']: " " ?></span>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember" value="1" <?php echo ($checked)?"checked":"" ?>>
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" id="buttonSubmit" <?php echo ($checked)? "":"disabled" ?>>Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Register</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

<?php include('../layouts/footer.php') ?>