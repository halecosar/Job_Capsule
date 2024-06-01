<!-- kullanıcı bilgilerini tutarken kullanılacak bir güvenlik fonksiyonu; -->
<?php
function Security($userData)
{
    $userData = trim($userData);
    $userData = stripslashes($userData);
    $userData = htmlspecialchars($userData);

    return $userData;
}

function createJob(string $title, string $short_description, string $long_description, string $location, int $isDeleted = 0, int $isActive, $created_by = "", $last_modified_by = "")
{
    include "config.php";

    $query = "INSERT INTO jobs (title, short_description, long_description, location, is_Deleted, isActive, created_on, created_by, last_modified_on, last_modified_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $result = mysqli_prepare($connection, $query);

    $created_on = date("Y-m-d H:i:s");
    $last_modified_on = "";
    $last_modified_by = "";

    if (empty($created_by)) {
        $created_by = "admin";
    }

    mysqli_stmt_bind_param($result, 'ssssiissss', $title, $short_description, $long_description, $location, $isDeleted, $isActive, $created_on, $created_by, $last_modified_on, $last_modified_by);
    mysqli_stmt_execute($result);
    mysqli_stmt_close($result);
    mysqli_close($connection);

    return $result;
}

function getJobs($keyword, $page)
{
    include "config.php";

    $pageCount = 3;
    $offset = ($page - 1) * $pageCount;
    $query = "";

    $query = "FROM jobs j WHERE j.is_deleted=0 && j.isActive=1";

    if (!empty($keyword)) {
        $query .= " && (j.title LIKE '%$keyword%' or j.short_description LIKE '%$keyword%' or j.location LIKE '%$keyword%')";
    }

    $total_sql = "SELECT COUNT(*) " . $query;

    $count_data = mysqli_query($connection, $total_sql);
    $count = mysqli_fetch_array($count_data)[0];
    $total_pages = ceil($count / $pageCount); //kaç eleman çekildi kaç sayfa yapılacak. 

    $sql = "SELECT * " . $query . " LIMIT $offset, $pageCount";
    $result = mysqli_query($connection, $sql);
    mysqli_close($connection);
    return array(
        "total_pages" => $total_pages,
        "data" => $result,
        "totalCount" => $count
    );
}

function getAllJobs($keyword, $page)
{
    include "config.php";

    $pageCount = 3;
    $offset = ($page - 1) * $pageCount;
    $query = "";

    $query = "FROM jobs j WHERE j.is_deleted=0";

    if (!empty($keyword)) {
        $query .= " && (j.title LIKE '%$keyword%' or j.short_description LIKE '%$keyword%' or j.location LIKE '%$keyword%')";
    }

    $total_sql = "SELECT COUNT(*) " . $query;

    $count_data = mysqli_query($connection, $total_sql);
    $count = mysqli_fetch_array($count_data)[0];
    $total_pages = ceil($count / $pageCount); //kaç eleman çekildi kaç sayfa yapılacak. 

    $sql = "SELECT * " . $query . " LIMIT $offset, $pageCount";
    $result = mysqli_query($connection, $sql);
    mysqli_close($connection);
    return array(
        "total_pages" => $total_pages,
        "data" => $result,
        "totalCount" => $count
    );
}

function editJob(int $id, string $title, string $short_description, string $long_description, string $location, int $isActive)
{
    include "config.php";
    $last_modified_by = "admin";

    $query = "UPDATE jobs SET title=?, short_description=?, long_description=?, location=?, isActive=?, last_modified_on=NOW(), last_modified_by=? WHERE id=?";

    $stmt = mysqli_prepare($connection, $query);

    mysqli_stmt_bind_param($stmt, "ssssisi", $title, $short_description, $long_description, $location, $isActive, $last_modified_by, $id);

    $result = mysqli_stmt_execute($stmt);

    // Sorgu başarılı mı kontrolü
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function deleteJob(int $id)
{
    include "config.php";

    $query = "UPDATE jobs SET is_deleted = 1 WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);

    $result = mysqli_stmt_execute($stmt);

    mysqli_close($connection);

    return $result;
}

function getJobByID(int $id)
{
    include "config.php";
    $query = "SELECT * from jobs WHERE id='$id'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($connection);
    return $row;

}






function ApplicationAdd($user_id, $job_id, $status)
{
    include "config.php";

    if (empty($status)) {
        $status = 1;
    }

    $query = "INSERT INTO application (user_id, job_id, status) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($connection, $query);

    if ($stmt === false) {
        die('MySQL prepare failed: ' . mysqli_error($connection));
    }

    mysqli_stmt_bind_param($stmt, 'iii', $user_id, $job_id, $status);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $success = true;
    } else {
        $success = false;
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    return $success;
}

function getAllApplications($user_id, $keyword, $page)
{
    include "config.php";

    $pageCount = 1;
    $offset = ($page - 1) * $pageCount;
    $query = "";

    $query = "FROM application a INNER JOIN jobs j ON j.id = a.job_id WHERE user_id=$user_id";

    if (!empty($keyword)) {
        $query .= " && (j.title LIKE '%$keyword%' or j.short_description LIKE '%$keyword%' or j.location LIKE '%$keyword%')";
    }

    $total_sql = "SELECT COUNT(*) " . $query;

    $count_data = mysqli_query($connection, $total_sql);
    $count = mysqli_fetch_array($count_data)[0];
    $total_pages = ceil($count / $pageCount); //kaç eleman çekildi kaç sayfa yapılacak. 

    $sql = "SELECT * " . $query . " LIMIT $offset, $pageCount";
    $result = mysqli_query($connection, $sql);
    mysqli_close($connection);
    return array(
        "total_pages" => $total_pages,
        "data" => $result,
        "totalCount" => $count
    );
}

function saveCv($file)
{
    $message = "";
    $uploadOK = 1;
    $fileTempPath = $file["tmp_name"];
    $fileName = $file["name"];
    $fileSize = $file["size"];
    $maxfileSize = ((1024 * 1024) * 1);
    $desteklenenDosyaUzantisi = "pdf";
    $uploadFolder = "../file/";

    if ($fileSize > $maxfileSize) {
        $message = "Dosya boyutu fazla";
        $uploadOK = 0;
    }
    $dosyaAdi_Arr = pathinfo($fileName);
    $dosyaAdi_uzantisiz = $dosyaAdi_Arr['filename'];
    $dosya_uzantisi = isset($dosyaAdi_Arr['extension']) ? $dosyaAdi_Arr['extension'] : '';

    if ($dosya_uzantisi != $desteklenenDosyaUzantisi) {
        $message .= "dosya uzantısı kabul edilemiyor.";
        $message .= "kabul edilen dosya uzantısı: " . $desteklenenDosyaUzantisi;
        $uploadOK = 0;
        $yeni_DosyaAdi = "";
    } else {
        $yeni_DosyaAdi = md5(time() . $dosyaAdi_uzantisiz) . '.' . $dosya_uzantisi;
        $dest_path = $uploadFolder . $yeni_DosyaAdi;
        if ($uploadOK == 0) {
            $message .= "Dosya yüklenemedi";
        } else {
            if (move_uploaded_file($fileTempPath, $dest_path)) {
                $message .= "dosya yüklendi.";
            }
        }
    }

    return array(
        "isSuccess" => $uploadOK,
        "message" => $message,
        "cvFile" => $yeni_DosyaAdi
    );
}

function getAllCandidates($keyword, $page)
{
    include "config.php";

    $pageCount = 3;
    $offset = ($page - 1) * $pageCount;
    $query = "";

    $query = "FROM users u WHERE u.role=0 && isDeleted=0";

    if (!empty($keyword)) {
        $query .= " && (u.fullname LIKE '%$keyword%' or u.mail  LIKE '%$keyword%' or u.phone LIKE '%$keyword%')";
    }

    $total_sql = "SELECT COUNT(*) " . $query;

    $count_data = mysqli_query($connection, $total_sql);
    $count = mysqli_fetch_array($count_data)[0];
    $total_pages = ceil($count / $pageCount); //kaç eleman çekildi kaç sayfa yapılacak. 

    $sql = "SELECT * " . $query . " LIMIT $offset, $pageCount";
    $result = mysqli_query($connection, $sql);
    mysqli_close($connection);
    return array(
        "total_pages" => $total_pages,
        "data" => $result,
        "totalCount" => $count
    );
}

function deleteCandidate(int $id)
{
    include "config.php";

    $query = "UPDATE users SET isDeleted = 1 WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);

    $result = mysqli_stmt_execute($stmt);

    mysqli_close($connection);

    return $result;
}

function CandidateAdd($mail, $phone, $fullname, $lastTitle, $lastCompany, $experienceYear)
{
    include "config.php";



    $query = "INSERT INTO users (mail, phone, fullname, lastTitle, lastCompany, experienceYear) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $query);

    if ($stmt === false) {
        die('MySQL prepare failed: ' . mysqli_error($connection));
    }

    mysqli_stmt_bind_param($stmt, 'ssssss', $mail, $phone, $fullname, $lastTitle, $lastCompany, $experienceYear);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $success = true;
    } else {
        $success = false;
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    return $success;
}

function editCandidate(int $id, string $mail, string $phone, string $fullname, string $lastTitle, string $lastCompany, int $experienceYear)
{
    include "config.php";


    $query = "UPDATE users SET mail=?, phone=?, fullname=?, lastTitle=?, lastCompany=?, experienceYear=?  WHERE id=? ";

    $stmt = mysqli_prepare($connection, $query);

    mysqli_stmt_bind_param($stmt, "sssssii", $mail, $phone, $fullname, $lastTitle, $lastCompany, $experienceYear, $id);

    $result = mysqli_stmt_execute($stmt);

    // Sorgu başarılı mı kontrolü
    if ($result) {
        return true;
    } else {
        return false;
    }
}


function getCandidateByID(int $id)
{
    include "config.php";
    $query = "SELECT * from users WHERE id='$id'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($connection);
    return $row;

}
?>