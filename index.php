<?php
include "db_conn.php";

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Table</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Jost', sans-serif;
            background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
            color: white;
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem;
            box-sizing: border-box;
        }
        .container {
            width: 100%;
            max-width: 1200px;
        }
        .table-container {
            background: #fff;
            border-radius: 10px;
            padding: 2rem;
            margin-top: 2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .table thead th {
            background-color: #573b8a;
            color: #fff;
        }
        .btn-custom {
            background: #573b8a;
            color: #fff;
            border: none;
            transition: background-color 0.3s ease;
        }
        .btn-custom:hover {
            background: #6d44b8;
        }
        @media (max-width: 768px) {
            .table-container {
                padding: 1rem;
            }
            .btn-custom {
                width: 100%;
                margin-bottom: 1rem;
            }
        }
        @media (max-width: 576px) {
            .table thead {
                display: none;
            }
            .table tbody tr {
                display: block;
                margin-bottom: 1rem;
                border-bottom: 1px solid #ddd;
                padding-bottom: 1rem;
            }
            .table tbody tr td {
                display: block;
                text-align: right;
                padding-left: 50%;
                position: relative;
            }
            .table tbody tr td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 1rem;
                font-weight: bold;
                text-align: left;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="table-container">
            <h2 class="text-center">CRUD Table</h2>

            <?php
if(isset($_GET['msg'])){
    $msg = $_GET['msg'];
    echo '
    <div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
        '.$msg.'
    </div>
    <script>
       
        setTimeout(function() {
            var alert = document.getElementById("alert");
            if (alert) {
                alert.classList.remove("show");
            }
        }, 2000);
    </script>
    ';
}
?>

            <a href="register.php" class="btn btn-custom mb-3">Add New Record</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Confirm Password</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td data-label="ID"><?php echo $row['user_id']; ?></td>
                        <td data-label="Name"><?php echo $row['name']; ?></td>
                        <td data-label="Email"><?php echo $row['email']; ?></td>
                        <td data-label="Password"><?php echo $row['password']; ?></td>
                        <td data-label="Confirm Password"><?php echo $row['confirm_password']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
