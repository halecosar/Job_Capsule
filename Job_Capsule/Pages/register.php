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

        .form-container {
            max-width: 500px;
            margin: auto;
        }
    </style>
</head>

<body>

    <?php
    include_once "../libs/functions.php"; ?>
    <?php include "../libs/config.php" ?>
    <?php session_start(); ?>

    <?php $fullname = $mail = $password = $passwordConfirm = $phone = $fullnameErr = $mailErr = $passwordErr = $passwordConfirmErr = $cvFile = $cvFile_err = $phoneErr = ""; ?>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty(trim($_POST["fullname"]))) {
            $fullnameErr = "ad-soyad girmelisiniz";
        } else if (strlen(trim($_POST["fullname"])) < 5 or strlen(trim($_POST["fullname"])) > 15) {
            $fullnameErr = "Ad-Soyad 5-15 karakter arasında olmalıdır.";
        } else if (!preg_match('/^[a-zA-Z0-9ğüşöçİĞÜŞÖÇ]+$/', $_POST["fullname"])) {
            $fullnameErr = "Ad-Soyad sadece harflerden oluşmalıdır.";
        } else {
            $fullname = $_POST["fullname"];
        }

        if (empty(trim($_POST["mail"]))) {
            $mailErr = "mail girmelisiniz";
        } else {
            $sql = "select id FROM users where mail = ?";

            if ($stmt = mysqli_prepare($connection, $sql)) {
                $param_email = trim($_POST["mail"]);
                mysqli_stmt_bind_param($stmt, "s", $param_email);

                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $mailErr = "mail daha önce kullanılmıştır.";
                    } else {
                        $mail = $_POST["mail"];
                    }
                } else {
                    echo mysqli_error($connection);
                    echo "hata oluştu";
                }
            }
        }

        if (empty(trim($_POST["phone"]))) {
            $phoneErr = "telefon numarası girmelisiniz";
        } else if (strlen($_POST["phone"]) < 10 || strlen($_POST["phone"]) > 10) {
            $phoneErr = "telefon numarasını başında 0 olmadan 10 haneli giriniz.";
        } else if (!preg_match('/^[0-9]*$/', $_POST["phone"])) {
            $phoneErr = "telefon numarası sadece rakamlardan oluşmalıdır.";
        } else {
            $phone = $_POST["phone"];
        }


        if (empty(trim($_POST["password"]))) {
            $passwordErr = "şifre girmelisiniz";
        } else if (strlen($_POST["password"]) < 6) {
            $passwordErr = "şifre min. 6 karakterden oluşturulmalıdır.";
        } else {
            $password = $_POST["password"];
        }
        if (empty(trim($_POST["passwordConfirm"]))) {
            $passwordConfirmErr = "şifre tekrarı girmelisiniz";
        } else {
            $passwordConfirm = $_POST["passwordConfirm"];
            if (empty($passwordErr) && ($password != $passwordConfirm)) {
                $passwordConfirmErr = "parolalar eşleşmiyor.";
            }
        }

        if (empty($_FILES["cvFile"]["name"])) {
            $cvFile_err = "dosya seçiniz.";
        } else {
            $result = saveCv($_FILES["cvFile"]);
            if ($result["isSuccess"] == 0) {
                $cvFile_err = $result["message"];
            } else {
                $cvFile = $result["cvFile"];
            }
        }


        if (empty($fullnameErr) && empty($mailErr) && empty($phoneErr) && empty($passwordErr) && empty($passwordConfirmErr) && empty($cvFile_err)) {
            $sql = "INSERT INTO users (fullname,mail,phone,password,cvfilename) VALUES (?,?,?,?,?)";

            if ($stmt = mysqli_prepare($connection, $sql)) {
                $param_fullname = $fullname;
                $param_mail = $mail;
                $param_phone = $phone;
                $param_password = password_hash($password, PASSWORD_DEFAULT);
                $param_cvfilename = $cvFile;

                mysqli_stmt_bind_param($stmt, "sssss", $param_fullname, $param_mail, $param_phone, $param_password, $param_cvfilename);

                if (mysqli_stmt_execute($stmt)) {
                    // header("location: login.php");
                    $_SESSION['register_message'] = "Üyelik işleminiz başarıyla gerçekleşmiştir.";
                    $_SESSION['register_type'] = "success";
                } else {
                    echo mysqli_error($connection);
                    echo "hata oluştu";
                }
            }
        }
    }
    ?>

    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-custom text-white" style="border-radius: 1rem;">

                        <?php if (isset($_SESSION['register_message'])): ?>
                            <div class="alert alert-<?php echo $_SESSION['register_type']; ?>">
                                <?php
                                echo $_SESSION['register_message'];
                                ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post"
                            class="card-body p-4 text-center form-container" enctype="multipart/form-data">
                            <div>
                                <h2 class="fw-bold mb-2 text-uppercase">KAYIT OL</h2>
                                <p class="text-white-50 mb-4"></p>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div data-mdb-input-init class="form-outline form-white mb-3">
                                        <label class="form-label" for="fullname">Ad-Soyad</label>
                                        <input type="text" id="typefullname" name="fullname"
                                            class="form-control form-control-sm <?php echo (!empty($fullnameErr)) ? 'is-invalid' : '' ?>"
                                            value="<?php echo htmlspecialchars($fullname); ?>" />
                                        <span class="invalid-feedback"><?php echo $fullnameErr ?></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div data-mdb-input-init class="form-outline form-white mb-3">
                                        <label class="form-label" for="mail">Mail Adresi</label>
                                        <input type="email" id="typemail" name="mail"
                                            class="form-control form-control-sm <?php echo (!empty($mailErr)) ? 'is-invalid' : '' ?>"
                                            value="<?php echo htmlspecialchars($mail); ?>" />
                                        <span class="invalid-feedback"><?php echo $mailErr ?></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div data-mdb-input-init class="form-outline form-white mb-3">
                                        <label class="form-label" for="phone">Telefon</label>
                                        <input type="text" id="typephone" name="phone"
                                            class="form-control form-control-sm <?php echo (!empty($phoneErr)) ? 'is-invalid' : '' ?>"
                                            value="<?php echo htmlspecialchars($phone); ?>" />
                                        <span class="invalid-feedback"><?php echo $phoneErr ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div data-mdb-input-init class="form-outline form-white mb-3">
                                        <label class="form-label" for="typePasswordX">Şifre</label>
                                        <input type="password" id="typePasswordX" name="password"
                                            class="form-control form-control-sm <?php echo (!empty($passwordErr)) ? 'is-invalid' : '' ?>" />

                                        <span class="invalid-feedback"><?php echo $passwordErr ?></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div data-mdb-input-init class="form-outline form-white mb-3">
                                        <label class="form-label" for="typePasswordXConfirm">Şifre Tekrar</label>
                                        <input type="password" id="typePasswordXConfirm" name="passwordConfirm"
                                            class="form-control form-control-sm <?php echo (!empty($passwordConfirmErr)) ? 'is-invalid' : '' ?>" />

                                        <span class="invalid-feedback"><?php echo $passwordConfirmErr ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div data-mdb-input-init class="form-outline form-white mb-3">
                                        <label for="cvFile" class="form-label">CV Yükle</label>
                                        <input type="file"
                                            class="form-control <?php echo (!empty($cvFile_err)) ? 'is-invalid' : '' ?>"
                                            name="cvFile" id="cvFile">
                                        <span class="invalid-feedback"><?php echo $cvFile_err ?></span>

                                    </div>
                                </div>
                            </div>

                            <div>
                                <button data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-outline-light btn-lg px-5" type="submit">Kayıt Ol</button>

                                <?php if (isset($_SESSION['register_message'])): ?>
                                    <a href="login.php" class="btn btn-primary btn-large float-right mb-2">Giriş Yap</a>
                                    <?php
                                    unset($_SESSION['register_message']);
                                    unset($_SESSION['register_type']);
                                    ?>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>