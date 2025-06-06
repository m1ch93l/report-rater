<?php
session_start();
if (isset($_SESSION['admin'])) {
    header('location: admin/home');
}

if (isset($_SESSION['participant'])) {
    header('location: home');
}
?>
<!-- header of html -->
<?php require_once 'includes/header.php'; ?>

<body>
    <div class="container-fluid d-flex align-items-center justify-content-center vh-100">

        <div class="row">
            <div class="col-md-12">
                <div class="card" style="width: 20rem;">
                    <div class="card-header">
                        <h3 class="card-title">reportrater</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_SESSION['registered'])) { ?>
                            <div class="alert alert-primary" role="alert">
                                You have successfully registered.<br> Please login now!
                            </div>
                            <?php unset($_SESSION['registered']);
                        } ?>
                        <form action="crud" method="post">
                            <div class="form-group">
                                <label for="participant" class="form-label">Username</label>
                                <input placeholder="ex. Juan" type="text" class="form-control mb-2" id="participant"
                                    name="participant" autofocus required>
                                <label for="password" class="form-label">Password</label>
                                <input placeholder="ex. 12345" type="text" class="form-control" id="password"
                                    name="password" required>
                                <br>
                                <button type="submit" class="form-control btn btn-primary" name="login">
                                    Login
                                </button>
                                <hr>
                                <a href="signup" class="float-end btn btn-success btn-sm mb-1 me-2">Register</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</body>

</html>