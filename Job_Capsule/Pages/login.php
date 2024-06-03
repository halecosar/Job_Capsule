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
            background-color: #191769;
        }

        .bg-custom {
            background-color: transparent;
        }

        .login-logo {
            width: 100%;
            max-width: 500px;
            /* margin-bottom: 20px; */
            height: 400px;
        }

        .form-content {
            color: #E96238;

        }

        .form-control {

            /* Input genişliğini daraltmak için */

        }

        @media (min-width: 768px) {
            .login-logo {
                margin-bottom: 0;
            }
        }
    </style>
</head>

<body>
    <?php
    include_once "../libs/functions.php";
    include "../libs/config.php";
    session_start();

    $mail = $password = $mailError = $passwordError = $login_err = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["mail"])) {
            $mailError = "Mail alanını boş bırakamazsınız";
        } else if (empty($_POST["password"])) {
            $passwordError = "Şifre alanını boş bırakamazsınız";
        } else {
            $mail = Security($_POST["mail"]);
            $password = Security($_POST["password"]);

            if (empty($mailError) && empty($passwordError)) {
                $sql = "SELECT id, mail, password, role FROM users WHERE mail = ? AND isDeleted = 0";

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
                <div class="col-12 col-sm-10 col-md-10 col-lg-9 col-xl-8">
                    <div class="card bg-custom text-white" style="border-radius: 1rem;">
                        <div class="row">
                            <div class="col-sm-5 d-flex align-items-center justify-content-center">
                                <img src="../img/jc-logo1.png" alt="Logo" class="login-logo">
                            </div>
                            <div class="col-sm-7">
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
                                    class="card-body p-4 text-center form-content"
                                    style="display: flex; flex-direction: column; justify-content: flex-start; margin-top: 20px;">
                                    <div>
                                        <h2 class="fw-bold mb-2 text-uppercase">GİRİŞ YAP</h2>
                                    </div>
                                    <div>
                                        <?php
                                        if (!empty($login_err)) {
                                            echo '<div class="alert alert-danger">' . $login_err . '</div>';
                                        }
                                        ?>
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
                                            class="btn btn-outline-light btn-lg px-5" type="submit">Giriş Yap</button>
                                        <br> <br>

                                        <a href="register.php" class="btn btn-outline-light btn-lg px-2">Hesabın Yok
                                            mu?</a>
                                    </div>

                                    <div class="d-flex justify-content-center text-center mt-3 pt-1">
                                        <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                        <a href="#!" class="text-white"><i
                                                class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                        <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>