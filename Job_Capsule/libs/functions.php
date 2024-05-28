<!-- kullanıcı bilgilerini tutarken kullanılacak bir güvenlik fonksiyonu; -->
<?php
function Security($userData)
{
    $userData = trim($userData);
    $userData = stripslashes($userData);
    $userData = htmlspecialchars($userData);

    return $userData;
}



// function createUser(string $name, string $username, string $email, string $password)
// {
//     $db = getData();

//     array_push(
//         $db["users"],
//         array(
//             "id" => count($db["users"]) + 1,
//             "username" => $username,
//             "password" => $password,
//             "name" => $name,
//             "email" => $email
//         )
//     );

//     $myfile = fopen("db.json", "w");
//     fwrite($myfile, json_encode($db, JSON_PRETTY_PRINT));
//     fclose($myfile);

// }

// function getUser(string $username)
// {
//     $users = getData()["users"];

//     foreach ($users as $user) {
//         if ($user["username"] == $username) {
//             return $user;
//         }
//     }
//     return null;
// }


function createJob(string $title, string $short_description, string $long_description, string $location, int $isDeleted = 0, int $isActive = 0, $created_on = null, $created_by = "", $last_modified_on = null, $last_modified_by = "")
{
    include "config.php";

    $query = "INSERT INTO jobs (title, short_description, long_description, location, is_Deleted, isActive, created_on, created_by, last_modified_on, last_modified_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $result = mysqli_prepare($connection, $query);

    // Eğer $created_on ve $last_modified_on değerleri null ise, varsayılan değerleri atayın
    if ($created_on === null) {
        $created_on = date("Y-m-d H:i:s");
    }
    if ($last_modified_on === null) {
        $last_modified_on = date("Y-m-d H:i:s");
    }

    // Varsayılan değerler yerine parametrelerin değerlerini kullanın
    if (empty($created_by)) {
        $created_by = "admin";
    }
    if (empty($last_modified_by)) {
        $last_modified_by = "admin";
    }

    mysqli_stmt_bind_param($result, 'ssssiiisss', $title, $short_description, $long_description, $location, $isDeleted, $isActive, $created_on, $created_by, $last_modified_on, $last_modified_by);
    mysqli_stmt_execute($result);
    mysqli_stmt_close($result);
    mysqli_close($connection);

    return $result;
}


// function updateJob(int $job_id, string $title, string $short_description, string $long_description, string $location, int $isDeleted = 0, int $isActive = 0, $last_modified_on = null, $last_modified_by = "")
// {
//     include "config.php";

//     $query = "UPDATE jobs SET title=?, short_description=?, long_description=?, location=?, isDeleted=?, isActive=?, last_modified_on=?, last_modified_by=? WHERE job_id=?";
//     $result = mysqli_prepare($connection, $query);

//     // Eğer $last_modified_on değeri null ise, varsayılan değeri atayın
//     if ($last_modified_on === null) {
//         $last_modified_on = date("Y-m-d H:i:s");
//     }

//     // Varsayılan değerler yerine parametrelerin değerlerini kullanın
//     if (empty($last_modified_by)) {
//         $last_modified_by = "admin";
//     }

//     mysqli_stmt_bind_param($result, 'ssssiiisi', $title, $short_description, $long_description, $location, $isDeleted, $isActive, $last_modified_on, $last_modified_by, $job_id);
//     mysqli_stmt_execute($result);
//     mysqli_stmt_close($result);
//     mysqli_close($connection);

//     return $result;
// }


// function getJobs()
// {
//     include "config.php";

//     $query = "SELECT * FROM jobs WHERE is_deleted=0";
//     $result = mysqli_query($connection, $query);
//     $jobs = mysqli_fetch_all($result, MYSQLI_ASSOC);
//     mysqli_close($connection);

//     return $jobs;
// }

function getJobs($keyword, $page)
{
    include "config.php";

    $pageCount = 2;
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

function getJobsCount()
{
    include "config.php";

    $query = "SELECT COUNT(*) as job_count FROM jobs WHERE is_deleted=0";
    $result = mysqli_query($connection, $query);

    $row = mysqli_fetch_assoc($result);
    mysqli_close($connection);

    return $row['job_count'];
}

function editJobs(int $id, string $title, string $description, string $image, string $url, int $isActive)
{
    include "config.php";

    $query = "UPDATE blogs SET title='$title',description='$description',image='$image',url='$url',isActive='$isActive' WHERE id='$id'";
    $result = mysqli_query($connection, $query);
    echo mysqli_error($connection);
    return $result;
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

function getJobsByID(int $id)
{
    include "config.php";
    $query = "SELECT * from jobs WHERE id='$id'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($connection);
    return $row;

}



?>