<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>

<body>

    <form method="post" action="<?php echo htmlspecialchars('result.php'); ?>" enctype="multipart/form-data">
        <!-- encytype eklemezsen dosya gitmez ve çalışmaz. -->
        <div class="form-group">
            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="myFile">
        </div>
        <button type="submit" class="btn btn-danger">Yükle</button>
    </form>

</body>


</html>