<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .gradient-custom {
            background: #f5f5dc;
            background: -webkit-linear-gradient(to right, rgb(247, 238, 221), rgb(65, 201, 226));
            background: linear-gradient(to right, rgb(247, 238, 221), rgb(65, 201, 226));
        }

        .bg-custom {
            background-color: #00A9FF;
        }
    </style>
</head>

<body>

    <?php
    require "functions.php"; ?>

    <?php $userName = $password = $userNameError = $passwordError = ""; ?>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {


        if (empty($_POST["userName"])) {
            $userNameError = "Bu alanı boş bırakamazsınız";

        } else if (empty($_POST["password"])) {
            $passwordError = "Bu alanı boş bırakamazsınız";
        } else if (!preg_match("/^[a-zA-Z-']*$/", Security($_POST["userName"]))) {
            $userNameError = "Geçersiz karakter girildi.";
        } else {
            // Başarılı giriş işlemi
            echo "Başarılı giriş işlemi";
            $userName = Security($_POST["userName"]);
            $password = Security($_POST["password"]);
        }
    }
    ?>

    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-custom text-white" style="border-radius: 1rem;">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post"
                            class="card-body p-4 text-center"
                            style="height: 70vh; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                <h2 class="fw-bold mb-2 text-uppercase">GİRİŞ YAP</h2>
                                <p class="text-white-50 mb-4">E-posta adresinizi ve şifrenizi giriniz.</p>
                            </div>
                            <div>
                                <div data-mdb-input-init class="form-outline form-white mb-3">
                                    <label class="form-label" for="typeuserName">Kullanıcı Adı</label>
                                    <input type="text" id="typeuserName" name="userName"
                                        class="form-control form-control-lg"
                                        value="<?php echo htmlspecialchars($userName); ?>" />

                                    <small class="form-text text-muted" style="color:white"> *Bu alan
                                        zorunludur.</small>
                                    <small class="error"><?php echo $userNameError; ?></small>
                                </div>

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

                            <div>
                                <p class="small mb-3 pb-lg-2"><a class="text-white-50" href="#!">Şifremi Unuttum</a></p>
                                <button data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-outline-light btn-lg px-5" type="submit">Giriş Yap</button>
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