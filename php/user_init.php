<?php

    class user {

        private $step = '';
        private $status = '';
        private $lrn = '';
        private $age = '';
        private $gender = '';
        private $cont = '';
        private $mname = '';
        private $mcontact = '';
        private $fname = '';
        private $fcontact = '';
        private $gwa = '';
        private $bid = '';
        private $email = '';
        private $fb = '';
        private $strand = '';
        private $utype = '';

        private $section = '';
        private $accstatus = '';
        

        public function user() {
            $con = connect();

            $sql = "SELECT * FROM user_info
            INNER JOIN user_account
            ON user_account.id = user_info.id
            WHERE user_account.id = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('i', $_SESSION['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            $this->setUserStatus($row['status_enroll']);
            $this->setName($row['fullname']);
            $this->setlrn($row['lrn']);
            $this->setage($row['age']);
            $this->setgender($row['sex']);
            $this->setcont($row['contact']);

            $this->setmname($row['mname']); #
            $this->setmcontact($row['mcontact']);
            $this->setfname($row['fname']);
            $this->setfcontact($row['fcontact']);
            $this->setgwa($row['gwa']);
            $this->setbid($row['birthcert_id']);
            $this->setemail($row['email']);
            $this->setfb($row['fb']);
            $this->setstrand($row['strand']);
            $this->setsection($row['section']);
            $this->setutype($row['utype']);
            $this->sstatus($row['status']);
        }

        private function sstatus($status) {
            $this->accstatus = $status;
        }

        public function gstatus() {
            return $this->accstatus;
        }
        #

        private function setutype($utype) {
            $this->utype = $utype;
        }

        public function getutype() {
            return $this->utype;
        }

        private function setsection($section) {
            $this->section = $section;
        }

        public function getsection() {
            return $this->section;
        }

        private function setstrand($strand) {
            $this->strand = $strand;
        }

        public function getstrand() {
            return $this->strand;
        }

        private function setfb($fb) {
            $this->fb = $fb;
        }

        public function getfb() {
            return $this->fb;
        }

        private function setemail($email) {
            $this->email = $email;
        }

        public function getemail() {
            return $this->email;
        }

        private function setbid($bid) {
            $this->bid = $bid;
        }

        public function getbid() {
            return $this->bid;
        }

        private function setgwa($gwa) {
            $this->gwa = $gwa;
        }

        public function getgwa() {
            return $this->gwa;
        }

        private function setfcontact($fcontact) {
            $this->fcontact = $fcontact;
        }

        public function getfcontact() {
            return $this->fcontact;
        }

        private function setfname($fname) {
            $this->fname = $fname;
        }

        public function getfname() {
            return $this->fname;
        }

        private function setmcontact($mcontact) {
            $this->mcontact = $mcontact;
        }

        public function getmcontact() {
            return $this->mcontact;
        }

        private function setmname($mname) {
            $this->mname = $mname;
        }

        public function getmname() {
            return $this->mname;
        }

        private function setcont($cont) {
            $this->cont = $cont;
        }

        public function getcont() {
            return $this->cont;
        }
        
        private function setgender($gender) {
            $this->gender = $gender;
        }

        public function getgender() {
            return $this->gender;
        }

        private function setage($age) {
            $this->age = $age;
        }

        public function getage() {
            return $this->age;
        }

        private function setlrn($lrn) {
            $this->lrn = $lrn;
        }

        public function getlrn() {
            return $this->lrn;
        }

        private function setName($name) {
            $this->name = $name;
        }

        public function getName() {
            return $this->name;
        }

        private function setUserStatus($status) {
            $this->status = $status;
        }

        public function getUserStatus() {
            return $this->status;
        }

        private function setUserStep($step) {
            $this->step = $step;
        }

        public function getUserStep() {
            return $this->step;
        }
    }

    class enrollee {

        private $step = '';
        private $status = '';
        private $lrn = '';
        private $age = '';
        public $birthday = '';
        public $birthplace = '';
        public $religion = '';
        public $motherTongue = '';
        public $homeAddress = '';
        private $gender = '';
        private $cont = '';

        private $mname = '';
        private $mcontact = '';
        public $malumni = '';
        private $fname = '';
        private $fcontact = '';
        public $falumni = '';
        private $gwa = '';
        private $bid = '';
        private $email = '';
        private $fb = '';
        private $strand = '';
        private $utype = '';

        private $section = '';
        private $accstatus = '';

        public $listahan = '';
        public $fourPs = '';
        public $schoolType = '';
        public $lastSchool = '';
        

        public function enrollee() {
            $con = connect();

            $sql = "SELECT * FROM user_info
            WHERE user_info.id = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('i', $_GET['sid']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            $this->birthday = $row['birthday'];
            $this->birthplace = $row['birthplace'];
            $this->religion = $row['religion'];
            $this->motherTongue = $row['mother_tongue'];
            $this->homeAddress = $row['home_address'];
            $this->malumni = $row['malumni'];
            $this->falumni = $row['falumni'];
            $this->lastSchool = $row['last_school'];
            $this->schoolType = $row['school_type'];
            $this->listahan = $row['listahan_benef'];
            $this->fourPs = $row['four_p'];
            
            $this->setUserStatus($row['status_enroll']);
            $this->setName($row['fullname']);
            $this->setlrn($row['lrn']);
            $this->setage($row['age']);
            $this->setgender($row['sex']);
            $this->setcont($row['contact']);

            $this->setmname($row['mname']); #
            $this->setmcontact($row['mcontact']);
            $this->setfname($row['fname']);
            $this->setfcontact($row['fcontact']);
            $this->setgwa($row['gwa']);
            $this->setbid($row['birthcert_id']);
            $this->setemail($row['email']);
            $this->setfb($row['fb']);
            $this->setstrand($row['strand']);
            $this->setsection($row['section']);
            $this->setutype($row['utype']);
        }

        public function gstatus() {
            return $this->accstatus;
        }
        #

        private function setutype($utype) {
            $this->utype = $utype;
        }

        public function getutype() {
            echo $this->utype;
            return $this->utype;
        }

        private function setsection($section) {
            $this->section = $section;
        }

        public function getsection() {
            return $this->section;
        }

        private function setstrand($strand) {
            $this->strand = $strand;
        }

        public function getstrand() {
            return $this->strand;
        }

        private function setfb($fb) {
            $this->fb = $fb;
        }

        public function getfb() {
            return $this->fb;
        }

        private function setemail($email) {
            $this->email = $email;
        }

        public function getemail() {
            return $this->email;
        }

        private function setbid($bid) {
            $this->bid = $bid;
        }

        public function getbid() {
            return $this->bid;
        }

        private function setgwa($gwa) {
            $this->gwa = $gwa;
        }

        public function getgwa() {
            return $this->gwa;
        }

        private function setfcontact($fcontact) {
            $this->fcontact = $fcontact;
        }

        public function getfcontact() {
            return $this->fcontact;
        }

        private function setfname($fname) {
            $this->fname = $fname;
        }

        public function getfname() {
            return $this->fname;
        }

        private function setmcontact($mcontact) {
            $this->mcontact = $mcontact;
        }

        public function getmcontact() {
            return $this->mcontact;
        }

        private function setmname($mname) {
            $this->mname = $mname;
        }

        public function getmname() {
            return $this->mname;
        }

        private function setcont($cont) {
            $this->cont = $cont;
        }

        public function getcont() {
            return $this->cont;
        }
        
        private function setgender($gender) {
            $this->gender = $gender;
        }

        public function getgender() {
            return $this->gender;
        }

        private function setage($age) {
            $this->age = $age;
        }

        public function getage() {
            return $this->age;
        }

        private function setlrn($lrn) {
            $this->lrn = $lrn;
        }

        public function getlrn() {
            return $this->lrn;
        }

        private function setName($name) {
            $this->name = $name;
        }

        public function getName() {
            return $this->name;
        }

        private function setUserStatus($status) {
            $this->status = $status;
        }

        public function getUserStatus() {
            return $this->status;
        }

        private function setUserStep($step) {
            $this->step = $step;
        }

        public function getUserStep() {
            return $this->step;
        }
    }

?>