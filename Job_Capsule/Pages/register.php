<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .gradient-custom {
            background: #f5f5dc;
            background: -webkit-linear-gradient(to right, rgb(247, 238, 221), rgb(65, 201, 226));
            background: linear-gradient(to right, rgb(247, 238, 221), rgb(65, 201, 226));
        }

        .bg-custom {
            background-color: transparent;
        }
    </style>
</head>

<body>

    <?php
    require "functions.php"; ?>

    <?php $fullname = $password = $password2 = $email = $userNameError = $passwordError = ""; ?>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {


        if (empty($_POST["fullname"])) {
            $name = "Bu alanı boş bırakamazsınız";

        } else if (empty($_POST["password"])) {
            $passwordError = "Bu alanı boş bırakamazsınız";
        } else if (!preg_match("/^[a-zA-Z-']*$/", Security($_POST["fullname"]))) {
            $userNameError = "Geçersiz karakter girildi.";
        } else {
            // Başarılı kayıt işlemi
            echo "Başarılı kayıt işlemi";
            $userName = Security($_POST["fullname"]);
            $password = Security($_POST["password"]);
            $password2 = Security($_POST["password2"]);
            $password = Security($_POST["email"]);
        }
    }
    ?>

    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100 " style="width= 400px">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-custom text-white" style="border-radius: 1rem;">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post"
                            class="card-body p-4 text-center">
                            <div>
                                <h2 class="fw-bold mb- text-uppercase">KAYIT OL</h2>
                                <p class="text-white-50 mb-4"></p>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div data-mdb-input-init class="form-outline form-white mb-3">
                                        <label class="form-label" for="fullname">Kullanıcı Adı</label>
                                        <input type="text" id="typefullname" name="fullname"
                                            class="form-control form-control-lg"
                                            value="<?php echo htmlspecialchars($fullname); ?>" />

                                        <small class="form-text text-muted" style="color:white"> *Bu alan
                                            zorunludur.</small>
                                        <small class="error"><?php echo $userNameError; ?></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline form-white mb-3">
                                        <label class="form-label" for="typePasswordX">Şifre</label>
                                        <input type="password" id="typePasswordX" name="password"
                                            class="form-control form-control-lg" />
                                        <small class="form-text text-muted" style="color:white"> *Bu alan
                                            zorunludur.</small>
                                        <small class="error"><?php
                                        echo $passwordError; ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline form-white mb-3">
                                        <label class="form-label" for="typePasswordX">Şifre Tekrar</label>
                                        <input type="password" id="typePasswordX" name="password2"
                                            class="form-control form-control-lg" />
                                        <small class="form-text text-muted" style="color:white"> *Bu alan
                                            zorunludur.</small>
                                        <small class="error"><?php
                                        echo $passwordError; ?></small>
                                    </div>
                                </div>

                                <div class="col">
                                    <div data-mdb-input-init class="form-outline form-white mb-3">
                                        <label class="form-label" for="email">E-mail</label>
                                        <input type="email" id="typeemail" name="email"
                                            class="form-control form-control-lg"
                                            value="<?php echo htmlspecialchars($email); ?>" />

                                        <small class="form-text text-muted" style="color:white"> *Bu alan
                                            zorunludur.</small>
                                        <small class="error"><?php echo $userNameError; ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline form-white mb-3">
                                        <label class="form-label" for="tel">Cep No</label>
                                        <input type="tel" value="+90" id="typetel" name="tel"
                                            class="form-control form-control-lg" />

                                        <small class="form-text text-muted" style="color:white"> *Bu alan
                                            zorunludur.</small>
                                        <small class="error"><?php echo $userNameError; ?></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline form-white mb-3">
                                        <label class="form-label" for="tel">Cep No</label>
                                        <input type="tel" value="+90" id="typetel" name="tel"
                                            class="form-control form-control-lg" />

                                        <small class="form-text text-muted" style="color:white"> *Bu alan
                                            zorunludur.</small>
                                        <small class="error"><?php echo $userNameError; ?></small>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div>

                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5"
                            type="submit">Kayıt Ol</button>
                    </div>

                    <div class="d-flex justify-content-center text-center mt-3 pt-1">
                        <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                        <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                        <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
</body>

</html>