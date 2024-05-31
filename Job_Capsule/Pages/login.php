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
            background-color: transparent;
        }
    </style>
</head>

<body>
    <?php
    include_once "../libs/functions.php"; ?>
    <?php include "../libs/config.php" ?>
    <?php session_start(); ?>

    <?php $mail = $password = $mailError = $passwordError = ""; ?>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {


        if (empty($_POST["mail"])) {
            $mailError = "Mail alanını boş bırakamazsınız";

        } else if (empty($_POST["password"])) {
            $passwordError = "Şifre alanını boş bırakamazsınız";
        } else {
            // // Başarılı giriş işlemi
            // echo "Başarılı giriş işlemi";
            $mail = Security($_POST["mail"]);
            $password = Security($_POST["password"]);

            if (empty($mailError) && empty($passwordError)) {
                $sql = "SELECT id, mail, password, role FROM users where mail = ?";

                if ($stmt = mysqli_prepare($connection, $sql)) {
                    $param_mail = $mail;
                    mysqli_stmt_bind_param($stmt, "s", $param_mail);

                    if (mysqli_stmt_execute($stmt)) {
                        mysqli_stmt_store_result($stmt);
                        if (mysqli_stmt_num_rows($stmt) == 1) {
                            mysqli_stmt_bind_result($stmt, $id, $mail, $hashed_password, $role);

                            if (mysqli_stmt_fetch($stmt)) {
                                if (password_verify($password, $hashed_password)) {
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["userId"] = $id;
                                    $_SESSION["mail"] = $mail;
                                    $_SESSION["role"] = $role;

                                    if ($role == 0) {
                                        header("location: ../Components/home.php");
                                    } else if ($role == 1) {
                                        header("location: ../Components/Admin-Operations/admin-homepage.php");
                                    } else {
                                        echo "kullanıcı rolü bulunamadı";
                                    }

                                } else {
                                    $login_err = "Hatalı veya eksik bilgi girdiniz.";
                                }
                            }
                        } else {
                            $login_err = "Hatalı veya eksik bilgi girdiniz.";
                        }
                    } else {
                        echo "bilinmeyen bir hata oluştu";
                    }
                    mysqli_stmt_close($stmt);
                }
            }
            mysqli_close($connection);
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
                            </div>
                            <div>
                                <div data-mdb-input-init class="form-outline form-navy mb-3">
                                    <label class="form-label" for="typeuserName">E-Mail</label>
                                    <input type="email" id="typeuserName" name="mail"
                                        class="form-control form-control-lg <?php echo (!empty($mailError)) ? 'is-invalid' : '' ?>"
                                        value="<?php echo htmlspecialchars($mail); ?>" />
                                    <span class="invalid-feedback"><?php echo $mailError ?></span>
                                </div>

                                <div data-mdb-input-init class="form-outline form-white mb-3">
                                    <label class="form-label" for="typePasswordX">Şifre</label>
                                    <input type="password" id="typePasswordX" name="password"
                                        class="form-control form-control-lg <?php echo (!empty($passwordError)) ? 'is-invalid' : '' ?>"
                                        value="<?php echo htmlspecialchars($password); ?>" />
                                    <span class="invalid-feedback"><?php echo $passwordError ?></span>
                                </div>
                            </div>

                            <div>
                                <button data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-outline-light btn-lg px-5" type="submit">Giriş Yap</button> <br> <br>
                                <a href="register.php" class="btn btn-outline-light btn-lg px-5">Hesap Oluştur</a>
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