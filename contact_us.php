<?php

session_start();
include "_include/_header.php";
?>

<section>
    <div class="row m-0">
        <div class="col-10 mx-auto">
            <?php
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
            ?>
        </div>
        <div class="col-md-7 p-3 mx-auto">

            <div class="card-body rounded bg-light">
                <div class="card-header">
                    <h1 class="h3">Contact Us</h1>
                </div>
                <form action="_act.php" method="post" class="p-4 shadow">
                    <div class="form-floating mb-3">
                        <input type="email" required class="form-control" name="email" placeholder="name@example.com">
                        <label for="email">Email address</label>
                    </div>
                    <div class="form-floating my-3">
                        <input type="tel" class="form-control" name="Phone" maxlength="10" minlength="10" pattern="[0-9]{10}" required placeholder="Phone No.">
                        <p class="text-muted small">Numbers From 0-9</p>
                        <label for="Phone">Phone No.</label>
                    </div>
                    <div class="form-floating my-3">
                        <input type="text" required class="form-control" name="Subject" placeholder="Subject">
                        <label for="Subject">Subject</label>
                    </div>
                    <div class="form-floating my-3">
                        <textarea class="form-control" name="message" placeholder="Leave a Message here" id="floatingTextarea2" style="height: 150px;"></textarea>
                        <label for="floatingTextarea2">Your Message</label>
                    </div>
                    <input type="hidden" name="act" value="send_message">
                    <button type="submit" class="btn btn-outline-dark fw-bold">Send Message</button>
                </form>
            </div>
        </div>
</section>


<?php
include "_include/_footer.php";
?>