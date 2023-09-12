<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>E Supermarkets</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="images/logos/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php
        session_start();

         if (!isset($_SESSION['totalSumCart'])) {
            $_SESSION['totalSumCart'] = 0;
            $_SESSION['cart'] = [];
        }
//        session_start();

//        $_SESSION['totalSumCart'] = 0;
//        $_SESSION['cart'] = [];

        require('db.php');
    
        $sql = "SELECT id, name, address, email, phone FROM supermarket";
        $result = $con->query($sql);
    ?>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Support</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>


        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-4 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                    <h1 class="m-0 display- font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Supermarkets</h1>
                </a>
            </div>

            <div class="col-lg-8">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Supermarkets</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">

                        <?php if (!isset($_SESSION["username"])): ?>
                        <div class="navbar-nav ml-auto py-0">
                            <a href="login.php" class="nav-item nav-link" style="font-size: 35px;">Σύνδεση</a>
                            <a href="registration.php" class="nav-item nav-link" style="font-size: 35px;">Εγγραφή</a>
                        </div>
                        <?php else: ?>
                        <div class="navbar-nav ml-auto py-0">
                            <div>Logged in as:&nbsp;</div>
                            <?php echo $_SESSION["username"]; ?>
                            <a href="logout.php" class="nav-item nav-link">Logout</a>
                        </div>
                        <?php endif; ?>
                    </div>
                </nav>
            </div>


        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Κατηγορίες</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">Αντισηπτικά <i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                <a href="shop.php?subcategory_id=1" class="dropdown-item" data-subcategory-id="1">Αντισηπτικά</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">Βρεφικά είδη <i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                <a href="shop.php?subcategory_id=2" class="dropdown-item" data-subcategory-id="2">Απορρυπαντικά</a>
                                <a href="shop.php?subcategory_id=3" class="dropdown-item" data-subcategory-id="3">Βρεφικές τροφές</a>
                                <a href="shop.php?subcategory_id=4" class="dropdown-item" data-subcategory-id="4">Γάλα</a>
                            </div>
                        </div>

                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">Για κατοικίδια <i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                <a href="shop.php?subcategory_id=5" class="dropdown-item" data-subcategory-id="5">Pet shop/Τροφή γάτας</a>
                                <a href="shop.php?subcategory_id=6" class="dropdown-item" data-subcategory-id="6">Pet shop/Τροφή σκύλου</a>
                            </div>
                        </div>

                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">Καθαριότητα <i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                <a href="shop.php?subcategory_id=7" class="dropdown-item" data-subcategory-id="7">Αποσμητικά χώρου</a>
                                <a href="shop.php?subcategory_id=8" class="dropdown-item" data-subcategory-id="8">Είδη γενικού καθαρισμού</a>
                                <a href="shop.php?subcategory_id=9" class="dropdown-item" data-subcategory-id="9">Είδη κουζίνας - Μπάνιου</a>
                                <a href="shop.php?subcategory_id=10" class="dropdown-item" data-subcategory-id="10">Εντομοκτόνα - Εντομοαπωθητικά</a>
                                <a href="shop.php?subcategory_id=11" class="dropdown-item" data-subcategory-id="11">Χαρτικά</a>
                            </div>
                        </div>

                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">Ποτά - Αναψυκτικά <i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                <a href="shop.php?subcategory_id=12" class="dropdown-item" data-subcategory-id="12">Κρασιά</a>
                                <a href="shop.php?subcategory_id=13" class="dropdown-item" data-subcategory-id="13">Μπύρες</a>
                                <a href="shop.php?subcategory_id=14" class="dropdown-item" data-subcategory-id="14">Ποτά</a>
                                <a href="shop.php?subcategory_id=15" class="dropdown-item" data-subcategory-id="15">Χυμοί</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

            <!-- Navbar End -->


            <div class="col-lg-9">
                <div class="container">
                    <div class="row">
                        <?php
            while ($row = $result->fetch_assoc()) {
                $supermarketId = $row['id'];
                $supermarketName = $row['name'];
                $supermarketLogoURL = "images/logos/logo-{$supermarketId}.png";
                $supermarketAddress = $row['address'];
                $supermarketEmail = $row['email'];
                $supermarketPhone = $row['phone'];

                if (file_exists($supermarketLogoURL)) {
                ?>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="<?php echo $supermarketLogoURL; ?>" alt="<?php echo $supermarketName; ?>" class="card-img-top" style="height: 150px; object-fit: contain;">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title"><b><?php echo $supermarketName; ?></b></h5>
                                    -------------------
                                    <div> <?php echo $supermarketAddress ?></div>
                                    -------------------
                                    <div> <?php echo $supermarketEmail ?></div>
                                    -------------------
                                    <div> <?php echo $supermarketPhone ?></div>



                                    <label class="mt-auto">
                                        <input type="checkbox" class="supermarket-checkbox" name="supermarkets[]" value="<?php echo $supermarketId; ?>">
                                        Select
                                    </label>
                                </div>
                            </div>
                        </div>
                        <?php
                }
            }
            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!-- Subscribe Start -->
    <div class="container-fluid bg-secondary my-5">
        <div class="row justify-content-md-center py-5 px-xl-5">
            <div class="col-md-6 col-12 py-5">
                <div class="text-center mb-2 pb-2">
                    <h2 class="section-title px-5 mb-3"><span class="bg-secondary px-2">Μείνετε Ενημερωμένοι</span></h2>
                    <p>Amet lorem at rebum amet dolores. Elitr lorem dolor sed amet diam labore at justo ipsum eirmod duo labore labore.</p>
                </div>
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-white p-4" placeholder="Email Goes Here">
                        <div class="input-group-append">
                            <button class="btn btn-primary px-4">Subscribe</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Subscribe End -->




    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">E</span>Supermarkets</h1>
                </a>
                <p>Dolore erat dolor sit lorem vero amet. Sed sit lorem magna, ipsum no sit erat lorem et magna ipsum dolore amet erat.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-dark mb-2" href="checkout.html"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-dark mb-2" href="checkout.html"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Newsletter</h5>
                        <form action="">
                            <div class="form-group">
                                <input type="text" class="form-control border-0 py-4" placeholder="Your Name" required="required" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0 py-4" placeholder="Your Email" required="required" />
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block border-0 py-3" type="submit">Subscribe Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold" href="#">E-Supermarkets</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->




    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

</body>

</html>
