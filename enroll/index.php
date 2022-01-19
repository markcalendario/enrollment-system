<?php
    include '../php/connection.php';
    include '../php/log.php';

    $log = new activitylog;

    session_start();

    if (isset($_SESSION['accessed'])) {
        header("location: ../enrollee/");
    }


    if (isset($_POST['enroll'])) {
        enrollStudentStageOne();
    }

    function enrollStudentStageOne() {
        $con = connect();

        $givenName = mysqli_real_escape_string($con, $_POST['givenName']);
        $middleName = mysqli_real_escape_string($con, $_POST['middleName']);
        $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
        $age = mysqli_real_escape_string($con, $_POST['age']);
        $sex = mysqli_real_escape_string($con, $_POST['sex']);
        $contact = mysqli_real_escape_string($con, $_POST['contact']);
        $LRN = mysqli_real_escape_string($con, $_POST['LRN']);
        $fullName = $givenName . " " . $middleName . " " . $lastName . " ";

        $motherName = mysqli_real_escape_string($con, $_POST['motherName']);
        $motherContact = mysqli_real_escape_string($con, $_POST['motherContact']);
        $fatherName = mysqli_real_escape_string($con, $_POST['fatherName']);
        $fatherContact = mysqli_real_escape_string($con, $_POST['fatherContact']);
        
        $gwa = mysqli_real_escape_string($con, $_POST['gwa']);
        $birthCertID = mysqli_real_escape_string($con, $_POST['bci']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $fb = mysqli_real_escape_string($con, $_POST['fblink']);
        $strand = mysqli_real_escape_string($con, $_POST['strand']);

        $bday = mysqli_real_escape_string($con, $_POST['birthday']);
        $bplace = mysqli_real_escape_string($con, $_POST['birthplace']);
        $religion = mysqli_real_escape_string($con, $_POST['religion']);
        $motherTongue = mysqli_real_escape_string($con, $_POST['motherTongue']);
        $home_address = mysqli_real_escape_string($con, $_POST['address']);
        $malumni = mysqli_real_escape_string($con, $_POST['malumni']);
        $falumni = mysqli_real_escape_string($con, $_POST['falumni']);
        $lastschool = mysqli_real_escape_string($con, $_POST['lastSchool']);
        $schooltype = mysqli_real_escape_string($con, $_POST['schoolType']);
        
        if (isset($_POST['listahanBenef'])) {
            $listahan = mysqli_real_escape_string($con, $_POST['listahanBenef']);
        } else {
            $_POST['listahanBenef'] = 'No';
        }
        
        if (isset($_POST['fourpiece'])) {
            $fourP = mysqli_real_escape_string($con, $_POST['fourpiece']);
        } else {
            $_POST['fourpiece'] = 'No';
        }

        $sql = "INSERT INTO user_info
        (fullname, age, sex, contact, lrn, mname, mcontact, fname, fcontact, gwa, birthcert_id, email, fb, strand, birthday, birthplace, religion, mother_tongue, home_address, malumni, falumni, last_school, school_type, listahan_benef, four_p)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = $con->prepare($sql);
        $stmt->bind_param('sssssssssssssssssssssssss', $fullName, $age, $sex, $contact, $LRN, $motherName, $motherContact, $fatherName, $fatherContact, $gwa, $birthCertID, $email, $fb, $strand, $bday, $bplace, $religion, $motherTongue ,$home_address, $malumni, $falumni, $lastschool, $schooltype, $listahan, $fourP);

        if (hasNoDuplicateLRN($LRN)) {
            $result = $stmt->execute();
            
            if ($result) {
                // registerCredentials($LRN, $lastName);
                $log = new activitylog;
                $log->log('[ENROLLMENT] '. $fullName .' has enrolled.');
                header("location: ../?new");
            } 
            else {
                echo $con->error;
                echo "<script>alert(\"Error Occured.\")</script>";
            }
        } 
        else {
            echo "<script>alert(\"Account duplication occured: LRN.\")</script>";
        }


    }

    function hasNoDuplicateLRN($LRN) {
        $con = connect();

        $sql = "SELECT lrn FROM user_info WHERE lrn = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('i', $LRN);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return 0;
        } else {
            return 1;
        }
    }

    function registerCredentials($LRN, $lastName) {
        $con = connect();
        $id = $con->insert_id;
        $enrollee = 0;
        $username = $LRN."jrc";

        $sql = "INSERT INTO user_account
        (id, username, password)
        VALUES (?, ?, ?)";

        $stmt = $con->prepare($sql);
        $stmt->bind_param('iss', $id, $username, $lastName);
        $result = $stmt->execute();

        if (!$result) {
            echo $con->error;
        } else {
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

    <section id="agreement">
        <div class="container">
            <div class="guide-wrapper">
                <div class="guide-content">
                    <h1>Agreements</h1>
                    <p>By filling out this form, you are agreeing to the Data Policy of the Arellano University that:</p>
                    <div class="requirements">
                        <ul>
                            <li>We collect and store your data.</li>
                            <li>We review and do not share to any institutions.</li>
                            <li>Personal Information such as names and other must be valid and true.</li>
                            <li>Once you submitted the form, you cannot undo it.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="guide">
        <div class="container">
            <div class="guide-wrapper">
                <div class="guide-content">
                    <h1>Requirements</h1>
                    <p>Requirements for Enrollment</p>
                    <p>After filling out the form, please bring the following:</p>
                    <div class="requirements">
                        <ul>
                            <li>2x2 Picture, White Background</li>
                            <li>Grade 10 Report Card</li>
                            <li>Good Moral</li>
                            <li>Form 137</li>
                            <li>Birth Certificate</li>
                            <li>Complete the filling out of the Enrollment Form.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="firstform">
        <div class="container">
            <div class="firstform-wrapper">
            <form action="" method="post">

                <div class="left">
                    <h1>PERSONAL INFORMATION</h1>
                    <p>Complete the form and submit. After submission, you will receive your username and password. <br>
                    After your first login, complete the remaining information and wait for the process result.
                    </p>
                    <div class="inputer">
                        <label>Given Name</label>
                        <input type="text" name="givenName" required>
                    </div>
                    <div class="inputer">
                        <label>Middle Name</label>
                        <input type="text" name="middleName" required>
                    </div>
                    <div class="inputer">
                        <label>Last Name</label>
                        <input type="text" name="lastName" required>
                    </div>
                    <div class="inputer">
                        <label>Age</label>
                        <input type="number" min="14" max="40" name="age" required>
                    </div>
                    <div class="inputer">
                        <label>Birthday</label>
                        <input type="date" name="birthday" required>
                    </div>
                    <div class="inputer">
                        <label>Birth Place</label>
                        <input type="text" name="birthplace" required>
                    </div>
                    <div class="inputer">
                        <label>Religion</label>
                        <input type="text" name="religion" required>
                    </div>
                    <div class="inputer">
                        <label>Mother Tongue</label>
                        <input type="text" name="motherTongue" required>
                    </div>
                    <div class="inputer">
                        <label>Home Address</label>
                        <input type="text" name="address" required>
                    </div>
                    <div class="inputer">
                        <label>Sex</label>
                        <select name="sex" id="" required>
                            <option value="">Select your gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="inputer">
                        <label>Contact</label>
                        <input type="text" name="contact" required>
                    </div>
                    <div class="inputer">
                        <label>LRN</label>
                        <input type="number" name="LRN" required>
                    </div>

                </div>

                <div class="right">
                
                    <h1>STEP 2: FAMILY BACKGROUND</h1>
                    <div class="inputer">
                        <label>Mother's Name</label>
                        <input type="text" name="motherName" required>
                    </div>
                    <div class="inputer">
                        <label>Mother's Contact</label>
                        <input type="number" name="motherContact" required>
                    </div> 
                    <div class="inputer">
                        <label>She is an Alumni of AU</label>
                        <input type="radio" name="malumni" value="yes" required>
                    </div> 
                    <div class="inputer">
                        <label>She is NOT Alumni of AU</label>
                        <input type="radio" name="malumni" value="no" required>
                    </div>
                    <hr>
                    <div class="inputer">
                        <label>Father's Name</label>
                        <input type="text" name="fatherName" required>
                    </div> 
                    <div class="inputer">
                        <label>He is an Alumni of AU</label>
                        <input type="radio" name="falumni" value="yes" required>
                    </div> 
                    <div class="inputer">
                        <label>He is NOT an Alumni of AU</label>
                        <input type="radio" name="falumni" value="no" required>
                    </div>
                    <div class="inputer">
                        <label>Father's Contact</label>
                        <input type="number" name="fatherContact" >
                    </div>
                    <hr>
                    <div class="inputer">
                        <label>Check this if you are <strong>LISTAHAN 2.0 Beneficiary</strong></label>
                        <input type="radio" name="listahanBenef" value="Yes">
                    </div>
                    <div class="inputer">
                        <label>Check this if you are <strong>4PS Beneficiary</strong></label>
                        <input type="radio" name="fourpiece" value="Yes">
                    </div>

                    <h1>STEP 3: SCHOOL'S FILE</h1>
                    <div class="inputer">
                        <label>General Weighted Average</label>
                        <input type="number" min="75" max="99" name="gwa" >
                    </div>
                    <div class="inputer">
                        <label>Last School Attended</label>
                        <input type="text" name="lastSchool">
                    </div>
                    <div class="inputer">
                        <label>Public</label>
                        <input type="radio" name="schoolType" value="Public">
                    </div>
                    <div class="inputer">
                        <label>Private</label>
                        <input type="radio" name="schoolType" value="Private">
                    </div>
                    <div class="inputer">
                        <label>Birth Certificate ID</label>
                        <input type="number" name="bci" required>
                    </div>
                    <div class="inputer">
                        <label>Email</label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="inputer">
                        <label>FB Link</label>
                        <input type="text" name="fblink" required>
                    </div>
                    <div class="inputer">
                        <label>Strand</label>
                        <select name="strand" required>
                            <option value="">Select Strand</option>
                            <option value="ABM">Academic Track: ABM</option>
                            <option value="STEM">Academic Track: STEM</option>
                            <option value="HUMSS">Academic Track: HUMSS</option>
                            <option value="GAS">Academic Track: GAS</option>
                            <option value="HE1">TVL Track: HE1</option>
                            <option value="HE1">TVL Track: HE2</option>
                            <option value="HE1">TVL Track: ICT</option>
                            <option value="HE1">TVL Track: TG</option>
                            <option value="HE1">TVL Track: EIM</option>

                        </select>
                    </div>            

                    <div class="inputer">
                        
                        <label> <input type="checkbox" required> I do respect the policy of Arellano University. I know that my data and information will be stored and collected in their database.</label>
                        <button name="enroll" type="submit"><i class="fal fa-check"></i> Enroll now</button>
                    </div>
                
                </div>
                </form>
            </div>
        </div>
    </section>

    

</body>
</html>