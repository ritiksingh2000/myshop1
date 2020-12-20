
<?php

session_start();
include "_include/_header.php";
if (isset($_SESSION['is_msg'])) {
    echo '<div class="container px-md-3 mt-3">
            <div class="alert alert-' . $_SESSION['msg_bg'] . ' alert-dismissible fade show" role="alert">
            <strong>' . $_SESSION['msg'] . '</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          </div>';
    unset($_SESSION['is_msg']);
    unset($_SESSION['msg_bg']);
    unset($_SESSION['msg']);
}
if (isset($_SESSION['is_logged'])) {
    echo '
        
<div class="container">
    <div class="card my-3">
        <div class="card-head m-0 pt-2 row" style="background-color: rgba(0, 0, 0, 0.1);">
            <div class="col-xs-6 col-md-10 px-2 mx-0">
                <p class="lead fw-bold">User : ' . strtoupper($_SESSION['f_name']) . '</p>
            </div>
            <div class="col-2 px-2  mb-2 mx-0">
                <form action="_act.php" method="post">
                    <input type="hidden" name="act" value="logout">
                    <button class="ml-5 btn btn-outline-danger text-end px-3 py-1">Logout</button>
                </form>
            </div>

        </div>
        <div class="card-body">

            <nav>
                <div class="nav nav-tabs justify-content-center py-2" id="nav-tab" role="tablist">
                    <a class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="true">Profile</a>
                    <a class="nav-link" id="nav-user_orders-tab" data-bs-toggle="tab" href="#nav-user_orders" role="tab" aria-controls="nav-user_orders" aria-selected="false">Orders</a>
                    <!-- <a class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a> -->
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show shadow border border-dark rounded active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="card-body">
                        <h1 class="h3">Your Data <span class="text-muted small">- Update Here, If Necessary.</span> </h1>
                        <form action="_act.php" method="post">
                            <div class="mb-3 border-2 border-dark py-2 border-bottom fw-bold row" style="background-color: rgba(0,0,0,0.2);">
                                <label for="staticEmail" class="col-sm-2 col-form-label">First Name</label>
                                <div class="col-md-4">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="' . $_SESSION['f_name'] . '">
                                </div>
                                <div class="col-md-2">
                                    Change to 
                                </div>
                                <div class="col-md-4">
                                    <input type="test" name="updated_f_name" class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 border-2 border-dark py-2 border-bottom fw-bold row" style="background-color: rgba(0,0,0,0.2);">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Last Name</label>
                                <div class="col-md-4">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="' . $_SESSION['l_name'] . '">
                                </div>
                                <div class="col-md-2">
                                    Change to 
                                </div>
                                <div class="col-md-4">
                                    <input type="test" name="updated_l_name" class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 border-2 border-dark py-2 border-bottom fw-bold row" style="background-color: rgba(0,0,0,0.2);">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Userame</label>
                                <div class="col-md-4">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="' . $_SESSION['username'] . '">
                                </div>
                                <div class="col-md-2">
                                    Change to 
                                </div>
                                <div class="col-md-4">
                                    <input type="test" name="updated_username" class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 border-2 border-dark py-2 border-bottom fw-bold row" style="background-color: rgba(0,0,0,0.2);">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-md-4">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" name="email" value="'.$_SESSION['email']. '">
                                </div>
                                <div class="col-md-2">
                                    Change to 
                                </div>
                                <div class="col-md-4">
                                    <input type="email" name="updated_email" class="form-control">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-success fw-bold">Update My Data</button>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-user_orders" role="tabpanel" aria-labelledby="nav-user_orders-tab">Order</div>
                <!-- <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"></div> -->
            </div>

        </div>
    </div>
</div>

    ';
} else {

    echo '<div class="row mx-0">
    <div class="mx-auto col-md-7 my-3 p-3 rounded shadow bg-light">
        <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pills-login-tab" data-bs-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">Login</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-reg-tab" data-bs-toggle="pill" href="#pills-reg" role="tab" aria-controls="pills-reg" aria-selected="false">Register</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active p-4" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
                <form action="_act.php" class="shadow p-3 border border-secondary rounded" method="post">
                    <h1 class="h3 my-3">Enter Your Registered Email and Password</h1>
                    <div class="my-3">
                        <label for="email" class="form-label ">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
                    </div>
                    <div class="my-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password"></input>
                    </div>
                    <input type="hidden" name="act" value="login">
                    <button type="submit" class="my-3 btn btn-outline-dark">Login</button><br>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#Forgot_Password" class="ml-2 btn btn-outline-danger">Forgot Passord?</button>
                </form>
            </div>
            <div class="tab-pane fade" id="pills-reg" role="tabpanel" aria-labelledby="pills-reg-tab">
                <form action="_act.php" class="shadow p-3 border border-secondary rounded" method="post">
                    <div class="row my-2">
                        <div class="col-6 p-3">
                            First Name <input type="text" name="f_name" id="name" class="form-control">
                        </div>
                        <div class="col-6 p-3">
                            Last Name <input type="text" name="l_name" id="name" class="form-control">
                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username">
                        <span class="small text-muted">"Must Be Unique"</span>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="email">
                        <div id="email" class="form-text">We will never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="mb-3">
                        <label for="con_pass" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="con_pass" id="con_pass"><span class="small text-muted">"Repeat The Password Again"</span>
                    </div>
                    <input type="hidden" name="act" value="reg">

                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>

        </div>
    </div>
</div>';
}
?>

















<div class="modal fade" id="Forgot_Password" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Forgot_PasswordLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgba(0, 0, 0, 0.1);">
                <h5 class="modal-title" id="Forgot_PasswordLabel">Forgot Password </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="px-md-5">
                    <form action="search.php" class="my-2 px-md-3" method="post">
                        <label for="Forgot_Password" class="form-label h2 mb-3">Forgot Password</label>
                        <p class="lead my-3">You will recive change password link in your email.</p>
                        <input type="Forgot_Password" require id="Forgot_Password" name="keywoard" class="form-control shadow" placeholder="Enter Your Registered Email." aria-describedby="Forgot_Password">

                        <button type="submit" class=" shadow btn mx-auto mt-3 px-4 btn-outline-dark fw-bold">Submit </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
include "_include/_footer.php";
?>