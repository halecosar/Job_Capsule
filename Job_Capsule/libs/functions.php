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

    $pageCount = 3;
    $offset = ($page - 1) * $pageCount;

    // Temel sorgu
    $query = "FROM application WHERE user_id=?";
    $params = [$user_id];
    $types = "i";

    // Anahtar kelime eklenirse
    if (!empty($keyword)) {
        $query .= " AND (application.title LIKE ?)";
        $params[] = "%$keyword%";
        $types .= "s";
    }

    // Toplam kayıt sayısını hesaplama
    $total_sql = "SELECT COUNT(*) " . $query;
    $stmt = mysqli_prepare($connection, $total_sql);
    mysqli_stmt_bind_param($stmt, $types, ...$params);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $count);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    $total_pages = ceil($count / $pageCount);

    // Verileri getirme
    $sql = "SELECT * " . $query . " LIMIT ?, ?";
    $stmt = mysqli_prepare($connection, $sql);
    $params[] = $offset;
    $params[] = $pageCount;
    $types .= "ii";
    mysqli_stmt_bind_param($stmt, $types, ...$params);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $applications = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);

    mysqli_close($connection);

    return array(
        "total_pages" => $total_pages,
        "data" => $applications,
        "totalCount" => $count
    );
}



?>