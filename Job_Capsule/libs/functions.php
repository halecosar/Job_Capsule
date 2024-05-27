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


function createJob(string $title, string $description, string $image, string $url, int $category, int $isActive = 0)
{
    include "config.php";

    $query = "INSERT INTO blogs(title,description,image,url,category_id,isActive) VALUES (?,?,?,?,?,?)";
    $result = mysqli_prepare($connection, $query);

    mysqli_stmt_bind_param($result, 'ssssii', $title, $description, $image, $url, $category, $isActive);
    mysqli_stmt_execute($result);
    mysqli_stmt_close($result);
    mysqli_close($connection);

    return $result;
}


function getJobs()
{
    include "config.php";

    $query = "SELECT * FROM jobs WHERE is_deleted=0";
    $result = mysqli_query($connection, $query);
    $jobs = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($connection);

    return $jobs;
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




function deleteJobs(int $id)
{
    include "config.php";
    $query = "DELETE from blogs WHERE id=$id";
    $result = mysqli_query($connection, $query);
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