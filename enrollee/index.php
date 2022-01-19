<?php
    session_start();
    include '../php/connection.php';
    include '../php/user_init.php';
    include '../php/log.php';

    $user = new user;

    if (isset($_GET['sid'])) {
        $enrollee = new enrollee;
    } else {
        header('location: ..');
    }

    if (!isset($_SESSION['accessed'])) {
        header("location: ..");
    } 

    if ($user->getutype() < 1) {
        header("location: ..");
    }

    if (isset($_POST['back'])) {
        header("location: ../admin");
    }

    if (isset($_POST['saveNewSection'])) {
        if (empty($_POST['newSectionName'])) {
            ?>
            <script>
            
            alert("The new section field is empty.");

            </script>
            <?php
        } else {

            $con = connect();
            $stmt = $con->prepare('UPDATE user_info SET section = ? WHERE id = ?');
            $stmt->bind_param('ss', $_POST['newSectionName'], $_GET['sid']);
            $stmt->execute();

            $log = new activitylog;
            $user = new user;
            $log->log($user->getfname() . ' transferred a student to another section.');
            header('location: ../enrollee?sid='.$_GET['sid']);

        }
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
                    <h1>AUES</h1>
                </div>
            </div>
        </div>
    </nav>

    <section id="welcomer">
        <div class="container">
            <div class="welcomer-wrapper">
                <div class="texter">
                    <form action="" method="post">
                        <h1>Student: <?php echo $enrollee->getName(); ?></h1>
                        <div>
                        <input type="submit" name="back" value="Back">
                        <button type="button" onclick="window.print()"> Print </button>
                        <?php
                            if ($enrollee->getUserStatus() == 2) {
                                if (!isset($_POST['newSectionTrigger'])) {
                                    ?>
                                    <button type="submit" name="newSectionTrigger"> Section Edit </button>
                                    <?php
                                } else {
                                    ?>
                                    <button type="submit" name="saveNewSection"> Save </button>
                                    <?php
                                }

                                if (isset($_POST['newSectionTrigger'])) {
                                    ?>
                                    <input type="text" name="newSectionName" placeholder="New Section Name">
                                    <?php
                                }
                            }
                        ?>
                        </div>
                    </form>
                    <?php 
                    
                    if ($enrollee->getUserStatus() == 0) {
                        ?>
                        <h3 class="curstat">Current Status: <span class="ne">Incomplete</span> </h3>
                        <?php
                    } else if ($enrollee->getUserStatus() == 1) {
                        ?>
                        <h3 class="curstat">Current Status: <span class="wl">Requirements are not yet passed.</span> </h3>
                        <?php
                    } else if ($enrollee->getUserStatus() == 2) {
                        ?>
                        <h3 class="curstat">Current Status: <span class="ok">Accepted</span> </h3>
                        <?php
                    } else if ($enrollee->getUserStatus() == 3) {
                        ?>
                        <h3 class="curstat">Current Status: <span class="ne">Declined</span> </h3>
                        <?php
                    }
                    
                    ?>
                </div>
            </div>
        </div>
    </section>

    <section id="step-one-preview">
        <div class="container">
            <div class="step-one-preview-wrapper">
                <div class="content">
                    <table>
                        <tr>
                            <th>Full name</th>
                            <td><?php echo $enrollee->getName(); ?></td>
                        </tr>
                        <tr>
                            <th>LRN</th>
                            <td><?php echo $enrollee->getlrn(); ?></td>
                        </tr>
                        <tr>
                            <th>Age</th>
                            <td><?php echo $enrollee->getage(); ?></td>
                        </tr>
                        <tr>
                            <th>Birthday</th>
                            <td><?php echo $enrollee->birthday; ?></td>
                        </tr>
                        <tr>
                            <th>Birth Place</th>
                            <td><?php echo $enrollee->birthplace; ?></td>
                        </tr>
                        <tr>
                            <th>Religion</th>
                            <td><?php echo $enrollee->religion; ?></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td><?php echo $enrollee->getgender(); ?></td>
                        </tr>
                        <tr>
                            <th>Contact Number</th>
                            <td><?php echo "(+63) " . $enrollee->getcont(); ?></td>
                        </tr>
                        <tr>
                            <th>Home Address</th>
                            <td><?php echo $enrollee->homeAddress; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
    

            <section id="step-one-preview">
                <div class="container">
                    <div class="step-one-preview-wrapper">
                        <div class="content">
                            <table>
                                <tr>
                                    <th>Mother Full Name</th>
                                    <td><?php echo $enrollee->getmname(); ?></td>
                                </tr>
                                <tr>
                                    <th>Mother Contact</th>
                                    <td><?php echo $enrollee->getmcontact(); ?></td>
                                </tr>
                                <tr>
                                    <th>is Mother Alumna</th>
                                    <td><?php echo $enrollee->malumni; ?></td>
                                </tr>
                                <tr>
                                    <th>Father Full Name</th>
                                    <td><?php echo $enrollee->getfname(); ?></td>
                                </tr>
                                <tr>
                                    <th>Father Contact</th>
                                    <td><?php echo $enrollee->getfcontact(); ?></td>
                                </tr>
                                <tr>
                                    <th>is Father Alumnus</th>
                                    <td><?php echo $enrollee->falumni; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <section id="step-one-preview">
                <div class="container">
                    <div class="step-one-preview-wrapper">
                        <div class="content">
                            <table>
                                <tr>
                                    <th>Last School Attended</th>
                                    <td><?php echo $enrollee->lastSchool; ?></td>
                                </tr>
                                <tr>
                                    <th>School Type</th>
                                    <td><?php echo $enrollee->schoolType; ?></td>
                                </tr>
                                <tr>
                                    <th>GWA</th>
                                    <td><?php echo $enrollee->getgwa(); ?></td>
                                </tr>
                                <tr>
                                    <th>Birth Certificate ID</th>
                                    <td><?php echo $enrollee->getbid(); ?></td>
                                </tr>
                                <tr>
                                    <th>Email Address</th>
                                    <td><?php echo $enrollee->getemail(); ?></td>
                                </tr>
                                <tr>
                                    <th>Facebook Link</th>
                                    <td><?php echo $enrollee->getfb(); ?></td>
                                </tr>
                                <tr>
                                    <th>Strand</th>
                                    <td><?php echo $enrollee->getstrand(); ?></td>
                                </tr>
                                <tr>
                                    <th>Section</th>
                                    <td><?php echo $enrollee->getsection(); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <br/>

            <div class="container">
            <h3>Government Subsidy</h3>
            </div>
    
            <section id="step-one-preview">
                <div class="container">
                    <div class="step-one-preview-wrapper">
                        <div class="content">
                            <table>
                                <tr>
                                    <th>Listahan 2.0 Beneficiary</th>
                                    <td><?php echo $enrollee->listahan; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <section id="step-one-preview">
                <div class="container">
                    <div class="step-one-preview-wrapper">
                        <div class="content">
                            <table>
                                <tr>
                                    <th>4 Ps Beneficiary</th>
                                    <td><?php echo $enrollee->fourPs; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
</body>
</html>