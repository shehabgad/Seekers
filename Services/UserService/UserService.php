<?php
include 'IUserService.php';
class UserService implements IUserService
{
  private $conn;
  public function __construct($servername, $username, $password, $dbname)
  {
    $this->conn = new mysqli($servername, $username, $password, $dbname);
  }
  public function getUser($username, $password)
  {
    $query1 = "SELECT user_id, user_type FROM users WHERE user_name = '$username' AND password = '$password'";
    $result = $this->conn->query($query1);
    echo $this->conn->connect_error;
    if ($result) {
      if ($result->num_rows == 0) return false;
      else {
        $userinfo = $result->fetch_assoc();
        $userid = $userinfo['user_id'];
        if ($userinfo['user_type'] == "JOB_SEEKER") {
          $query2 = "SELECT * FROM jobseekers WHERE user_id = '$userid'";
          $result2 = $this->conn->query($query2);
          $userData = $result2->fetch_assoc();
          $JobSeeker = new JobSeeker(
            $userData['user_name'],
            $userData['name'],
            $userData['email'],
            $password,
            $userData['Age'],
            $userData['address'],
            $userData['wcompany'],
            json_decode($userData['skills'], true),
            $userData['industry'],
            $userData['explevel'],
            json_decode($userData['application_requests'], true),
            json_decode($userData['saved_vacancies'], true)
          );
          return array('userID' => $userid, 'user' => $JobSeeker, 'user_type' => "JOB_SEEKER");
        } else if ($userinfo['user_type'] == "EMPLOYER") {
          $query2 = "SELECT * FROM employers WHERE user_id = '$userid'";
          $result2 = $this->conn->query($query2);
          $userData = $result2->fetch_assoc();
          $employer = new Employer(
            $userData['user_name'],
            $userData['name'],
            $userData['email'],
            $password,
            $userData['Age'],
            $userData['address'],
            $userData['wcompany'],
            json_decode($userData['application_requests'], true),
            json_decode($userData['vacancies_made'], true)
          );
          return array('userID' => $userid, 'user' => $employer, 'user_type' => "EMPLOYER");
        }
      }
    }
  }
  public function isUsernameExist($username)
  {
    $query = "SELECT user_name FROM users WHERE user_name = '$username' LIMIT 1";
    $result = $this->conn->query($query);
    echo $this->conn->connect_error;

    return $result->num_rows > 0;
  }
  public function isEmailExist($email)
  {
    $query = "SELECT email FROM users WHERE email = '$email' LIMIT 1";
    $result = $this->conn->query($query);
    echo $this->conn->connect_error;

    return $result->num_rows > 0;
  }
  public function addUser($user)
  {
    $userinfo = $user->getAssocArray(true);
    $query1 = "";
    $query2 = "";
    if ($user instanceof JobSeeker) {
      $password = $userinfo['password'];
      $userName = $userinfo['username'];
      $email = $userinfo['email'];
      $name = $userinfo['name'];
      $age = $userinfo['Age'];
      $address = $userinfo['address'];
      $wcompany = $userinfo['company'];
      $industry = $userinfo['industry'];
      $explevel = $userinfo['expLevel'];
      $skills = json_encode($userinfo['skills']);
      $query1 = "INSERT INTO users (password, user_name, email, user_type) VALUES ('$password', '$userName', '$email','JOB_SEEKER')";

      $result = $this->conn->query($query1);
      echo $this->conn->connect_error;

      if ($result === true) {
        $userID = $this->conn->insert_id;

        $query2 = "INSERT INTO jobseekers (user_id, user_name, email,name,age,address,wcompany,industry,explevel,skills) VALUES ('$userID','$userName', '$email','$name','$age','$address','$wcompany','$industry','$explevel','$skills')";
        $result2 = $this->conn->query($query2);
        echo $this->conn->error;
        if ($result2 == true) return $userID;
        else return false;
      }
    } else if ($user instanceof Employer) {
      $password = $userinfo['password'];
      $userName = $userinfo['username'];
      $email = $userinfo['email'];
      $name = $userinfo['name'];
      $age = $userinfo['Age'];
      $address = $userinfo['address'];
      $wcompany = $userinfo['company'];

      $query1 = "INSERT INTO users (password, user_name, email, user_type) VALUES ('$password', '$userName', '$email','EMPLOYER')";
      $result = $this->conn->query($query1);
      echo $this->conn->connect_error;


      if ($result === true) {
        $userID = $this->conn->insert_id;
        $query2 = "INSERT INTO employers (user_id, user_name, email,name,age,address,wcompany) VALUES ('$userID','$userName', '$email','$name','$age','$address','$wcompany')";
        $result2 = $this->conn->query($query2);
        echo $this->conn->error;
        if ($result2 == true) return $userID;
        else return false;
      }
    }
  }
  public function updateEmployerName($id, $newName)
  {
    $query = "UPDATE employers SET name='$newName' WHERE user_id='$id'";
    $result = $this->conn->query($query);
    echo $this->conn->error;

    return $result != false;
  }
  public function updateEmployerEmail($id, $newEmail)
  {
    $query = "UPDATE employers SET email='$newEmail' WHERE user_id = '$id'";
    $result = $this->conn->query($query);
    $query2 = "UPDATE users SET email='$newEmail' WHERE user_id = '$id'";
    $result2 = $this->conn->query($query2);
    echo $this->conn->error;

    return $result != false && $result2 != false;
  }
  public function updateEmployerAddress($id, $newAddress)
  {
    $query = "UPDATE employers SET address='$newAddress' WHERE user_id = '$id'";
    $result = $this->conn->query($query);
    echo $this->conn->error;

    return $result != false;
  }
  public function updateEmployerWcompany($id, $newCompany)
  {
    $query = "UPDATE employers SET wcompany='$newCompany' WHERE user_id = '$id'";
    $result = $this->conn->query($query);
    echo $this->conn->error;

    return $result != false;
  }
  public function updateJobSeekerName($id, $newName)
  {
    $query = "UPDATE jobseekers SET name='$newName' WHERE user_id='$id'";
    $result = $this->conn->query($query);
    echo $this->conn->error;

    return $result != false;
  }
  public function updateJobSeekerEmail($id, $newEmail)
  {
    $query = "UPDATE jobseekers SET email='$newEmail' WHERE user_id = '$id'";
    $result = $this->conn->query($query);
    $query2 = "UPDATE users SET email='$newEmail' WHERE user_id = '$id'";
    $result2 = $this->conn->query($query2);
    echo $this->conn->error;
  }
  public function updateJobSeekerAddress($id, $newAddress)
  {
    $query = "UPDATE jobseekers SET address='$newAddress' WHERE user_id = '$id'";
    $result = $this->conn->query($query);
    echo $this->conn->error;

    return $result != false;
  }
  public function updateJobSeekerWcompany($id, $newCompany)
  {
    $query = "UPDATE jobseekers SET wcompany='$newCompany' WHERE user_id = '$id'";
    $result = $this->conn->query($query);
    echo $this->conn->error;

    return $result != false;
  }
  public function updateJobSeekerExplevel($id, $newExplevel)
  {
    $query = "UPDATE jobseekers SET explevel='$newExplevel' WHERE user_id = '$id'";
    $result = $this->conn->query($query);
    echo $this->conn->error;

    return $result != false;
  }
  public function updateJobSeekerIndustry($id, $newIndustry)
  {
    $query = "UPDATE jobseekers SET industry='$newIndustry' WHERE user_id = '$id'";
    $result = $this->conn->query($query);
    echo $this->conn->error;

    return $result != false;
  }
  public function updateJobSeekerSkill($id, $newSkill)
  {
    $query = "SELECT skills FROM jobseekers WHERE user_id = '$id'";
    $result = $this->conn->query($query);
    if ($result) {
      $skills = $result->fetch_assoc();
      $skills = json_decode($skills['skills'], true);
      $skills[] = $newSkill;
      $skills = json_encode($skills);
      $query2 = "UPDATE jobseekers SET skills='$skills' WHERE user_id = '$id'";
      $result2 = $this->conn->query($query2);
    }
  }
  public function addVacancyToEmployer($employerID, $vacancyID)
  {
    $query = "SELECT vacancies_made FROM employers WHERE user_id = '$employerID'";
    $result = $this->conn->query($query);
    if ($result) {
      $vacancies_made = $result->fetch_assoc();
      $vacancies_made = json_decode($vacancies_made['vacancies_made'], true);
      $vacancies_made[] = $vacancyID;
      $vacancies_made = json_encode($vacancies_made);
      $query2 = "UPDATE employers SET vacancies_made='$vacancies_made' WHERE user_id = '$employerID'";
      $result2 = $this->conn->query($query2);
    }
  }
  public function DeleteVacancyFromEmployer($employerID, $vacancyID)
  {
    $query = "SELECT vacancies_made FROM employers WHERE user_id = '$employerID'";
    $result = $this->conn->query($query);
    $vacancies_made = $result->fetch_assoc();
    $vacancies_made = json_decode($vacancies_made['vacancies_made'], true);
    $key = array_search($vacancyID, $vacancies_made);
    unset($vacancies_made[$key]);
    $vacancies_made_arr = [];
    foreach ($vacancies_made as $vacancyID) {
      $vacancies_made_arr[] = $vacancyID;
    }
    $vacancies_made = json_encode($vacancies_made_arr);
    $query2 = "UPDATE employers SET vacancies_made='$vacancies_made' WHERE user_id = '$employerID'";
    $result2 = $this->conn->query($query2);
  }
  public function addAppReqEmployer($employerID, $appReqID)
  {
    $query = "SELECT application_requests FROM employers WHERE user_id = '$employerID'";
    $result = $this->conn->query($query);
    if ($result) {
      $application_requests = $result->fetch_assoc();
      $application_requests = json_decode($application_requests['application_requests'], true);
      $application_requests[] = $appReqID;
      $application_requests = json_encode($application_requests);
      $query2 = "UPDATE employers SET application_requests='$application_requests' WHERE user_id = '$employerID'";
      $result2 = $this->conn->query($query2);
    }
  }
  public function addAppReqJobSeeker($jobseekerID, $appReqID)
  {
    $query = "SELECT application_requests FROM jobseekers WHERE user_id = '$jobseekerID'";
    $result = $this->conn->query($query);
    if ($result) {
      $application_requests = $result->fetch_assoc();
      $application_requests = json_decode($application_requests['application_requests'], true);
      $application_requests[] = $appReqID;
      $application_requests = json_encode($application_requests);
      $query2 = "UPDATE jobseekers SET application_requests='$application_requests' WHERE user_id = '$jobseekerID'";
      $result2 = $this->conn->query($query2);
    }
  }
  public function getJobSeeker($jobseekerID)
  {
    $query = "SELECT * FROM jobseekers WHERE user_id = '$jobseekerID'";
    $result = $this->conn->query($query);
    if ($result) {
      $jobseeker = $result->fetch_assoc();
      $jobseeker['skills'] = json_decode($jobseeker['skills'], true);
      $jobseeker['application_requests'] = json_decode($jobseeker['application_requests'], true);
      $jobseeker['application_requests'] = json_decode($jobseeker['saved_vacancies'], true);
      return $jobseeker;
    }
    return false;
  }
  public function getEmployer($employerID)
  {
    $query = "SELECT * FROM employers WHERE user_id = '$employerID'";
    $result = $this->conn->query($query);
    if ($result) {
      $employer = $result->fetch_assoc();
      $employer['application_requests'] = json_decode($employer['application_requests'], true);
      $employer['vacancies_made'] = json_decode($employer['vacancies_made'], true);
      return $employer;
    }
    return false;
  }
  public function toggleSaveVacancy($jobseekerID, $vacancyID, $save = true)
  {
    if ($save) {
      $query = "SELECT saved_vacancies FROM jobseekers WHERE user_id = '$jobseekerID'";
      $result = $this->conn->query($query);
      if ($result) {
        $savedVacs = $result->fetch_assoc();
        $savedVacs = json_decode($savedVacs['saved_vacancies'], true);
        $savedVacs[] = $vacancyID;
        $savedVacs = json_encode($savedVacs);
        $query2 = "UPDATE jobseekers SET saved_vacancies='$savedVacs' WHERE user_id = '$jobseekerID'";
        $result2 = $this->conn->query($query2);
      }
    } else {
      $query = "SELECT saved_vacancies FROM jobseekers WHERE user_id = '$jobseekerID'";
      $result = $this->conn->query($query);
      $saved_vacancies = $result->fetch_assoc();
      $saved_vacancies = json_decode($saved_vacancies['saved_vacancies'], true);
      $key = array_search($vacancyID, $saved_vacancies);
      unset($saved_vacancies[$key]);
      $saved_vacancies_arr = [];
      foreach ($saved_vacancies as $vacancyID) {
        $saved_vacancies_arr[] = $vacancyID;
      }
      $saved_vacancies = json_encode($saved_vacancies_arr);
      $query2 = "UPDATE jobseekers SET saved_vacancies='$saved_vacancies' WHERE user_id = '$jobseekerID'";
      $result2 = $this->conn->query($query2);
    }
  }
  public function isApplied($jobseekerID, $vacancyID)
  {
    $query = "SELECT apprequest_id FROM apprequests WHERE jobseeker_id='$jobseekerID' AND vacancy_id	= '$vacancyID'";
    $result = $this->conn->query($query);
    if ($result->num_rows > 0) {
      return intval(($result->fetch_assoc())['apprequest_id']);
    }
    return false;
  }
  public function isSaved($jobseekerID, $vacancyID)
  {
    $query = "SELECT saved_vacancies FROM jobseekers WHERE user_id = '$jobseekerID'";
    $result = $this->conn->query($query);
    $saved_vacancies = json_decode(($result->fetch_assoc())['saved_vacancies']);
    return in_array($vacancyID, $saved_vacancies);
  }
  private function removeApplicationRequestFrom($ID, $appReqID, $table)
  {
    $query = "SELECT application_requests FROM $table WHERE user_id = '$ID'";
    $result = $this->conn->query($query);
    $application_requests = $result->fetch_assoc();
    $application_requests = json_decode($application_requests['application_requests'], true);
    $key = array_search($appReqID, $application_requests);
    unset($application_requests[$key]);
    $application_requests_arr = [];
    foreach ($application_requests as $appreqID) {
      $application_requests_arr[] = $appreqID;
    }
    $application_requests = json_encode($application_requests_arr);
    $query2 = "UPDATE $table SET application_requests='$application_requests' WHERE user_id = '$ID'";
    $result2 = $this->conn->query($query2);
  }
  public function removeApplicationRequest($jobseekerID, $employerID, $appReqID)
  {
    $this->removeApplicationRequestFrom($jobseekerID, $appReqID, "jobseekers");
    $this->removeApplicationRequestFrom($employerID, $appReqID, "employers");
  }
  public function getJobSeekers($industry, $location, $explevel)
  {
    $query = "SELECT name,industry,address,explevel,email,age,wcompany,skills FROM jobseekers WHERE lower(industry) LIKE lower('%$industry%') AND lower(address) LIKE lower('%$location%') AND lower(explevel) LIKE lower('%$explevel%')";
    // $query = "SELECT * FROM jobseekers";
    $result = $this->conn->query($query);
    if ($result) {
      if ($result->num_rows == 0) {
        return false;
      }
      $jobseekers = [];
      while ($row = $result->fetch_assoc()) {
        $row['skills'] = json_decode($row['skills'], true);
        $jobseekers[] = $row;
      }
      return $jobseekers;
    }
    return false;
  }
}
