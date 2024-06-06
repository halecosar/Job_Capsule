<?php
session_start();
include_once "../libs/functions.php";
include "../libs/config.php";

$fullname = $mail = $password = $passwordConfirm = $phone = "";
$fullnameErr = $mailErr = $passwordErr = $passwordConfirmErr = $cvFile = $cvFile_err = $phoneErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ad-Soyad doğrulama
    if (empty(trim($_POST["fullname"]))) {
        $fullnameErr = "Ad-Soyad girmelisiniz.";
    } else if (strlen(trim($_POST["fullname"])) < 5 || strlen(trim($_POST["fullname"])) > 15) {
        $fullnameErr = "Ad-Soyad 5-15 karakter arasında olmalıdır.";
    } else if (!preg_match('/^[a-zA-Z0-9ğüşöçİĞÜŞÖÇ ]+$/', $_POST["fullname"])) {
        $fullnameErr = "Ad-Soyad sadece harflerden ve boşluklardan oluşmalıdır.";
    } else {
        $fullname = trim($_POST["fullname"]);
    }

    // E-posta doğrulama
    if (empty(trim($_POST["mail"]))) {
        $mailErr = "Mail adresi girmelisiniz.";
    } else {
        $sql = "SELECT id FROM users WHERE mail = ?";
        if ($stmt = mysqli_prepare($connection, $sql)) {
            $param_email = trim($_POST["mail"]);
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $mailErr = "Bu mail adresi zaten kullanılıyor.";
                } else {
                    $mail = trim($_POST["mail"]);
                }
            } else {
                echo "Hata oluştu: " . mysqli_error($connection);
            }
            mysqli_stmt_close($stmt);
        }
    }

    // Telefon numarası doğrulama
    if (empty(trim($_POST["phone"]))) {
        $phoneErr = "Telefon numarası girmelisiniz.";
    } else if (!preg_match('/^[0-9]{10}$/', $_POST["phone"])) {
        $phoneErr = "Telefon numarasını başında 0 olmadan 10 haneli giriniz.";
    } else {
        $phone = trim($_POST["phone"]);
    }

    // Şifre doğrulama
    if (empty(trim($_POST["password"]))) {
        $passwordErr = "Şifre girmelisiniz.";
    } else if (strlen(trim($_POST["password"])) < 6) {
        $passwordErr = "Şifre en az 6 karakterden oluşmalıdır.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Şifre tekrar doğrulama
    if (empty(trim($_POST["passwordConfirm"]))) {
        $passwordConfirmErr = "Şifre tekrarı girmelisiniz.";
    } else {
        $passwordConfirm = trim($_POST["passwordConfirm"]);
        if (empty($passwordErr) && ($password != $passwordConfirm)) {
            $passwordConfirmErr = "Şifreler eşleşmiyor.";
        }
    }

    // CV dosyası doğrulama
    if (empty($_FILES["cvFile"]["name"])) {
        $cvFile_err = "CV dosyası seçiniz.";
    } else {
        $result = saveCv($_FILES["cvFile"]);
        if ($result["isSuccess"] == 0) {
            $cvFile_err = $result["message"];
        } else {
            $cvFile = $result["cvFile"];
        }
    }

    // Veritabanına kayıt
    if (empty($fullnameErr) && empty($mailErr) && empty($phoneErr) && empty($passwordErr) && empty($passwordConfirmErr) && empty($cvFile_err)) {
        $sql = "INSERT INTO users (fullname, mail, phone, password, cvfilename) VALUES (?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($connection, $sql)) {
            $param_fullname = $fullname;
            $param_mail = $mail;
            $param_phone = $phone;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_cvfilename = $cvFile;
            mysqli_stmt_bind_param($stmt, "sssss", $param_fullname, $param_mail, $param_phone, $param_password, $param_cvfilename);

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['register_message'] = "Üyelik işleminiz başarıyla gerçekleşmiştir.";
                $_SESSION['register_type'] = "success";
                header("Location: login.php");
                exit();
            } else {
                $_SESSION['register_message'] = "Üyelik işlemi sırasında hata oluştu.";
                $_SESSION['register_type'] = "danger";
            }
            mysqli_stmt_close($stmt);
        }
    }
}
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .gradient-custom {
            background-color: #191769;
        }

        .bg-custom {
            background-color: transparent;
        }

        .form-container {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            background-color: transparent;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-content {
            color: #E96238;
        }

        .alert {
            margin-top: 20px;
            font-size: 0.9em;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-custom text-white" style="border-radius: 1rem;">

                        <?php if (isset($_SESSION['register_message'])): ?>
                            <div class="alert alert-<?php echo $_SESSION['register_type']; ?>">
                                <?php
                                echo $_SESSION['register_message'];
                                unset($_SESSION['register_message']);
                                unset($_SESSION['register_type']);
                                ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post"
                            class="card-body p-4 text-center form-container" enctype="multipart/form-data">
                            <div>
                                <h2 class="fw-bold mb-2 text-uppercase form-content">Kayıt Ol</h2>
                                <p class="text-white-50 mb-4"></p>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-outline form-white mb-3 form-content">
                                        <label class="form-label" for="fullname">Ad-Soyad</label>
                                        <input type="text" id="typefullname" name="fullname"
                                            class="form-control form-control-sm <?php echo (!empty($fullnameErr)) ? 'is-invalid' : '' ?>"
                                            value="<?php echo htmlspecialchars($fullname); ?>" />
                                        <span class="invalid-feedback"><?php echo $fullnameErr ?></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-outline form-white mb-3 form-content">
                                        <label class="form-label" for="mail">Mail Adresi</label>
                                        <input type="email" id="typemail" name="mail"
                                            class="form-control form-control-sm <?php echo (!empty($mailErr)) ? 'is-invalid' : '' ?>"
                                            value="<?php echo htmlspecialchars($mail); ?>" />
                                        <span class="invalid-feedback"><?php echo $mailErr ?></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-outline form-white mb-3 form-content">
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
                                    <div class="form-outline form-white mb-3 form-content">
                                        <label class="form-label" for="typePasswordX">Şifre</label>
                                        <input type="password" id="typePasswordX" name="password"
                                            class="form-control form-control-sm <?php echo (!empty($passwordErr)) ? 'is-invalid' : '' ?>" />
                                        <span class="invalid-feedback"><?php echo $passwordErr ?></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-outline form-white mb-3 form-content">
                                        <label class="form-label" for="typePasswordXConfirm">Şifre Tekrar</label>
                                        <input type="password" id="typePasswordXConfirm" name="passwordConfirm"
                                            class="form-control form-control-sm <?php echo (!empty($passwordConfirmErr)) ? 'is-invalid' : '' ?>" />
                                        <span class="invalid-feedback"><?php echo $passwordConfirmErr ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-outline form-white mb-3 form-content">
                                        <label for="cvFile" class="form-label">CV Yükle</label>
                                        <input type="file"
                                            class="form-control <?php echo (!empty($cvFile_err)) ? 'is-invalid' : '' ?>"
                                            name="cvFile" id="cvFile">
                                        <span class="invalid-feedback"><?php echo $cvFile_err ?></span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-outline-light btn-lg px-5" type="submit">Kayıt Ol</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>