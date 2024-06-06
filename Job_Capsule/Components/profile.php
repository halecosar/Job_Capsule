<?php
include_once "../libs/functions.php";
include "../libs/config.php";
require "navbar.php";

if (isset($_SESSION["role"]) && $_SESSION["role"] == 1) {
    echo "Oturum hatası: Admin rolüyle işlem yapılamaz!";
    header("location: ../Pages/logout.php");
    exit();
}

if (empty($_SESSION["loggedin"])) {
    header("Location: ../Pages/login.php");
}

$user_id = $_SESSION['userId'];
$error = "";
$success = "";
$phoneErr = "";
$mailErr = "";
$fullnameErr = "";
$passwordErr = "";
$passwordConfirmErr = "";

// user  bilgilerini veritabanından çek
$query = "SELECT fullname, mail, phone, password FROM users WHERE id = ?";
if ($stmt = mysqli_prepare($connection, $query)) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $fullname, $mail, $phone, $current_password);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($fullname != trim($_POST["fullname"])) {
        if (empty(trim($_POST["fullname"]))) {
            $fullnameErr = "ad-soyad girmelisiniz";
        } else if (strlen(trim($_POST["fullname"])) < 5 or strlen(trim($_POST["fullname"])) > 15) {
            $fullnameErr = "Ad-Soyad 5-15 karakter arasında olmalıdır.";

            // tr karakter regex'i eklendi
        } else if (!preg_match('/^[a-zA-Z0-9ğüşöçİĞÜŞÖÇ]+$/', $_POST["fullname"])) {
            $fullnameErr = "Ad-Soyad sadece harflerden oluşmalıdır.";
        } else {
            $fullname = $_POST["fullname"];
        }
    }

    if ($mail != trim($_POST["mail"])) {

        if (empty(trim($_POST["mail"]))) {
            $mailErr = "mail girmelisiniz";
        } else {
            $sql = "select id FROM users where mail = ?";

            if ($stmt = mysqli_prepare($connection, $sql)) {
                $param_email = trim($_POST["mail"]);
                mysqli_stmt_bind_param($stmt, "s", $param_email);

                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);


                    // aynı mail adresi ile sadece 1 kere üyelik yapılabilir
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
    }

    if ($phone != trim($_POST["phone"])) {

        if (empty(trim($_POST["phone"]))) {
            $phoneErr = "telefon numarası girmelisiniz";
        } else if (strlen($_POST["phone"]) < 10 || strlen($_POST["phone"]) > 10) {
            $phoneErr = "telefon numarasını başında 0 olmadan 10 haneli giriniz.";
        } else if (!preg_match('/^[0-9]*$/', $_POST["phone"])) {
            $phoneErr = "telefon numarası sadece rakamlardan oluşmalıdır.";
        } else {
            $phone = $_POST["phone"];
        }
    }
    $update_password = isset($_POST["update_password"]) ? true : false;
    $password = $update_password && isset($_POST["password"]) ? trim($_POST["password"]) : "";
    $confirm_password = $update_password && isset($_POST["confirm_password"]) ? trim($_POST["confirm_password"]) : "";

    if ($update_password && $password != $confirm_password) {
        $passwordConfirmErr = "Şifreler eşleşmiyor.";
    } else {
        if ($update_password) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $hashed_password = $current_password;
        }

        if (empty($fullnameErr) && empty($mailErr) && empty($phoneErr) && empty($passwordErr) && empty($passwordConfirmErr)) {
            $update_query = "UPDATE users SET fullname = ?, mail = ?, phone = ?, password = ? WHERE id = ?";
            if ($stmt = mysqli_prepare($connection, $update_query)) {
                mysqli_stmt_bind_param($stmt, "ssssi", $fullname, $mail, $phone, $hashed_password, $user_id);
                if (mysqli_stmt_execute($stmt)) {
                    //session'a maili tekrar attık. heder ile sayfayı refresh ettik.
                    $success = "Profiliniz başarıyla güncellendi.";
                    $_SESSION["mail"] = $mail;
                    header("location: profile.php");
                } else {
                    $error = "Profil güncelleme başarısız oldu.";
                }
                mysqli_stmt_close($stmt);
            }
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
    <title>Profil Güncelleme</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script>

        // kullanıcı şifresini güncellemek istemeyebilir. Default olarak checked geliyor kutucuk.
        function togglePasswordFields() {
            var checkbox = document.getElementById('update_password');
            var passwordFields = document.getElementsByClassName('password-field');
            for (var i = 0; i < passwordFields.length; i++) {
                passwordFields[i].disabled = !checkbox.checked;
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="text-center mb-4">
            <i class="fas fa-user-circle fa-6x"></i>
        </div>
        <h2>ÜYELİK BİLGİLERİM</h2>

        <form action="profile.php" method="POST">

            <label for="fullname">Ad-Soyad</label>
            <input type="text" class="form-control  <?php echo (!empty($fullnameErr)) ? 'is-invalid' : '' ?>"
                id="fullname" name="fullname" value="<?= htmlspecialchars($fullname) ?>" <?php if (!empty($fullnameErr)): ?> /> <span class="invalid-feedback"><?php echo $fullnameErr; ?></span>
            <?php endif; ?>

            <label for="mail">E-posta</label>
            <input type="email" class="form-control <?php echo (!empty($mailErr)) ? 'is-invalid' : '' ?>" id="mail"
                name="mail" value="<?= htmlspecialchars($mail) ?>" <?php if (!empty($mailErr)): ?> />
                <span class="invalid-feedback"><?php echo $mailErr; ?></span>
            <?php endif; ?>


            <label for="phone">Telefon</label>
            <input type="text" class="form-control <?php echo (!empty($phoneErr)) ? 'is-invalid' : '' ?>" id="phone"
                name="phone" value="<?php echo htmlspecialchars($phone); ?>" />
            <?php if (!empty($phoneErr)): ?>
                <span class="invalid-feedback"><?php echo $phoneErr; ?></span>
            <?php endif; ?>

            <hr>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="update_password" name="update_password"
                    onclick="togglePasswordFields()" checked>
                <label class="form-check-label" for="update_password"> Şifremi güncellemek istiyorum</label>
            </div>

            <label for="password">Şifre</label>
            <input type="password" class="form-control password-field" id="password" name="password" required>


            <label for="confirm_password">Şifre Tekrar</label>
            <input type="password" class="form-control password-field" id="confirm_password" name="confirm_password"
                required>

            <button type="submit" class="btn btn-primary">Güncelle</button>
        </form>
    </div>

</body>
<?php include "../Pages/footer.php"; ?>

</html>