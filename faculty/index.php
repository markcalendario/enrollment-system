<?php
    session_start();
    include '../php/connection.php';
    include '../php/user_init.php';
    include '../php/log.php';
    $user = new user;
    $log = new activitylog;

    if (!isset($_SESSION['accessed'])) {
        header("location: ..");
    }

    if ($user->getutype() != 1) {
        header("location: ..");
    }

    if (isset($_POST['out'])) {
        $log = new activitylog;
        $user = new user;
        $log->log($user->getfname() . ' has logged out.');
        session_destroy();
        header("location: ..");
    }

    if (isset($_POST['waitinglist'])) {
        header("location: ?list=w");
    }

    if (isset($_POST['enrolled'])) {
        header("location: ?list=e");
    }

    if (isset($_POST['declined'])) {
        header("location: ?list=d");
    }

    if (isset($_POST['accept'])) {
        if (empty($_POST['section'])) {
            echo "<script>alert(\"ASSIGN TO SECTION FIRST\")</script>";
        } else {
            $SQL = "UPDATE user_info SET section = ?, status_enroll = ? WHERE id = ?";
            $con = connect();
            $stmt = $con->prepare($SQL);
            $statusEnrollAccepted = 2;
            $section = $con->real_escape_string($_POST['section']);
            $stmt->bind_param('sii', $section, $statusEnrollAccepted, $_POST['studentID']);
            if ($stmt->execute()) {
                $log->log('accepted a student.');
                echo "<script>alert(\"STUDENT SUCESSFULLY ACCEPTED\")</script>";
            }
        }
    }

    if (isset($_POST['decline'])) {
        $SQL = "UPDATE user_info SET status_enroll = ? WHERE id = ?";
        $con = connect();
        $stmt = $con->prepare($SQL);
        $statusEnrollDecline = 3;
        $section = $con->real_escape_string($_POST['section']);
        $stmt->bind_param('ii', $statusEnrollDecline, $_POST['studentID']);
        if ($stmt->execute()) {
            $log->log('declined a student.');
            echo "<script>alert(\"STUDENT SUCESSFULLY DECLINED\")</script>";
        }
    }


    define('noprocess', 0); 
    define('waitinglist', 1);
    define('enrolled', 2);
    define('declined', 3);
    

    function populateTable() {
        $con = connect();
        
        $list = getListType();

        if (isset($_POST['searchString'])) {
            $searchString = $_POST['searchString'];
            $sql = "SELECT * FROM user_info WHERE status_enroll = ? AND fullname LIKE '%$searchString%' ORDER BY section ASC";
        } else {
            $sql = "SELECT * FROM user_info WHERE status_enroll = ? ORDER BY section ASC";
        }

        $stmt = $con->prepare($sql);
        $stmt -> bind_param('i', $list);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($list == waitinglist) {
            while ($row = $result->fetch_assoc()) {
                if ($row['utype'] == 0) {
                    ?>
                    <form action="" method="post">
                    <input type="hidden" name="studentID" value="<?php echo $row['id'] ?>">
                    <tr>
                    <td> <a href="../enrollee?sid=<?php echo $row['id']; ?>"> <?php echo $row['fullname']; ?> </a></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><?php echo $row['sex']; ?></td>
                    <td><?php echo $row['gwa']; ?></td>
                    <td><?php echo $row['lrn']; ?></td>
                    <td>
                        <input type="text" name="section" placeholder="EX. 11 ICT 2A" id="">
                    </td>
                    <td><input type="submit" name="accept" value="ACCEPT"></td>
                    <td><input type="submit" name="decline" value="DECLINE"></td>
                    </tr>
                    </form>
                    <?php
                }
            }
        }

        if ($list == enrolled || $list == declined) {
            while ($row = $result->fetch_assoc()) {
                if ($row['utype'] == 0) {
                    ?>
                    <tr>
                    <td> <a href="../enrollee?sid=<?php echo $row['id']; ?>"> <?php echo $row['fullname']; ?> </a></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><?php echo $row['sex']; ?></td>
                    <td><?php echo $row['gwa']; ?></td>
                    <td><?php echo $row['lrn']; ?></td>
                    <td><?php echo $row['contact']; ?></td>
                    <td><?php echo $row['strand']; ?></td>
                    <td><?php echo $row['section']; ?></td>
                    </tr>
                    <?php
                }
            }
        }

    }

    function getListType() {
        if (!isset($_GET['list'])) {
            return waitinglist;
        } else if (isset($_GET['list']) && $_GET['list'] == 'w') {
            return waitinglist;
        } else if (isset($_GET['list']) && $_GET['list'] == 'e') {
            return enrolled;
        } else if (isset($_GET['list']) && $_GET['list'] == 'd') {
            return declined;
        } else {
            header("location: " . $_SERVER['PHP_SELF']);
        }
    }

    if (isset($_POST['log'])) {
        header('location: activitylog/');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/query.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="../css/fontawesome/css/all.min.css">
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
                        <img src="../assets/AULOGO.png">
                    </div>
                    <h1>AUES | ADMIN</h1>
                </div>
            </div>
        </div>
    </nav>

    <section id="welcomer">
        <div class="container">
            <div class="welcomer-wrapper">
                <div class="texter">
                    <form action="" method="post">
                        <h1>Welcome back! <?php echo $user->getName(); ?></h1>
                        <div>
                        <input type="submit" name="log" value="Activity Log">
                        <input type="submit" name="out" value="Sign out">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section id="selectors">
        <div class="container">
            <div class="selectors-wrapper">
                <form action="" method="post">
                    <button name="enrolled">ACCEPTED</button>
                    <button name="waitinglist">WAITING LIST</button>
                    <button name="declined">DECLINED</button>
                </form>
            </div>
        </div>
    </section>
    

    <section id="infoer">
        <div class="container">
            <div class="infoer-wrapper">
                <h1 class="titler">
                    <?php 
                    if (getListType() == noprocess) {
                        echo "LIST OF ALL STUDENTS WHO ARE NOT DONE YET";
                    } else if (getListType() == waitinglist) {
                        echo "LIST OF ALL WAITING STUDENTS";
                    } else if (getListType() == enrolled) {
                        echo "LIST OF ALL ACCEPTED STUDENTS";
                    } else if (getListType() == declined) {
                        echo "LIST OF ALL DECLINED STUDENTS";
                    } 

                    ?>
                </h1>

                <form id="sorter" method="post">
                
                    <input type="text" style="padding: 5px; width: 200px" name="searchString" placeholder="Type a name here.">
                    <button name="search"> Search </button>
                    
                </form>

                <br>
                
                <table>
                    <tr>
                        <th>FULL NAME</th>
                        <th>AGE</th>
                        <th>SEX</th>
                        <th>GWA</th>
                        <th>LRN</th>
                        <?php 
                        
                        if (getListType() == waitinglist) {
                            ?>
                            <th>ASSIGN SECTION</th>
                            <th>ACCEPT</th>
                            <th>DECLINE</th>
                            <?php
                        } else {
                            ?>
                            <th>CONTACT</th>
                            <th>STRAND</th>
                            <th>SECTION</th>
                            <?php
                        }
                        
                        ?>
                        
                    </tr>
                    <?php 
                        populateTable();
                    ?>
                </table>
            </div>
        </div>
    </section>
    
</body>
</html>