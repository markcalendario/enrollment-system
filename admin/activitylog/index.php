<?php
    include '../../php/connection.php';
    include '../../php/log.php';
    include '../../php/user_init.php';
    session_start();

    $user = new user;

    if (!$user->getutype() == 2) {
        header("location: ../../");
    }

    if (!isset($_SESSION['accessed'])) {
        header("location: ../../");
    }

    function getlogs() {
        $con = connect();

        $stmt = $con->prepare('SELECT * FROM log ORDER BY logid DESC');
        $stmt->execute();
        $res = $stmt->get_result();
        
        while ($row = $res->fetch_assoc()) {
            ?>
            <form method="post">
            <input type="hidden" name="log-id" value="<?php echo $row['logid']; ?>">
                <tr>
                    <td> <?php echo $row['logtext']; ?> </td>
                    <td> <?php echo $row['log_time']; ?> </td>
                    <td>
                        <button name="removelog" class="remove">Remove</button>
                    </td>
                </tr>
            </form>
            <?php
        }
    }

    function getlogsteach() {
        $con = connect();

        $stmt = $con->prepare('SELECT * FROM log ORDER BY logid ASC');
        $stmt->execute();
        $res = $stmt->get_result();
        
        while ($row = $res->fetch_assoc()) {
            ?>
            <form method="post">
            <input type="hidden" name="log-id" value="<?php echo $row['logid']; ?>">
                <tr>
                    <td> <?php echo $row['logtext']; ?> </td>
                </tr>
            </form>
            <?php
        }
    }
    
    if (isset($_POST['removelog'])) {
        $con = connect();
        $stmt = $con->prepare('DELETE FROM log WHERE logid = ?');
        $stmt->bind_param('i', $_POST['log-id']);
        $stmt->execute();
        header('location: ../activitylog');
    }

    if (isset($_POST['deletealllogs'])) {
        $con = connect();
        $stmt = $con->prepare('DELETE FROM log');
        $stmt->execute();
        header('location: ../activitylog');
    }

    if (isset($_POST['back'])) {
        header('location: ../');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../css/query.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="../../css/fontawesome/css/all.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll | AUES </title>
</head>
<body>

    <nav>
        <div class="container">
            <div class="nav-wrapper">
                <div class="aues-title">
                    <div class="au-logo">
                        <img src="../../assets/AULOGO.png">
                    </div>
                    <h1>AUES</h1>
                </div>
            </div>
        </div>
    </nav>

    <section id="activitylog">
        <div class="container">
            <div class="wrapper">

                <div class="topper">
                    <h1>Activity Log</h1>
                    <form method="post">
                        <button style="background-color: royalblue;" name="back"> BACK </button>
                        <button name="deletealllogs"> Delete All Logs </button>
                    </form>
                    
                </div>

                <table>
                    <tr>
                        <th>Activity</th>
                        <th>Timestamp</th>
                        <th>Button</th>
                    </tr>
                    <?php getlogs(); ?>
                </table>

            </div>
        </div>
    </section>

</body>
</html>