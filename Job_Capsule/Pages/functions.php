<!-- kullanıcı bilgilerini tutarken kullanılacak bir güvenlik fonksiyonu; -->
<?php
function Security($userData)
{
    $userData = trim($userData);
    $userData = stripslashes($userData);
    $userData = htmlspecialchars($userData);

    return $userData;
}

?>