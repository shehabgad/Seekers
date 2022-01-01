<?php
include 'IAppReqService.php';
class AppReqService implements IAppReqService
{
  private $conn;
  public function __construct($servername, $username, $password, $dbname)
  {
    $this->conn = new mysqli($servername, $username, $password, $dbname);
  }
  public function addAppReq($appReq)
  {
    $appReqinfo = $appReq->getAssocArray();
    $jobSeekerId = $appReqinfo['jobSeekerID'];
    $vacanyID = $appReqinfo['vacancyID'];
    $coverLetter = $appReqinfo['coverLetter'];
    $employerID = $appReqinfo['employerID'];
    $query = "INSERT INTO apprequests  (jobseeker_id, vacancy_id, cover_letter, employer_id) VALUES ('$jobSeekerId', '$vacanyID',
     '$coverLetter', $employerID)";
    $result = $this->conn->query($query);
    if ($result) {
      return $this->conn->insert_id;
    } else {
      return false;
    }
  }
  public function getAppReq($appReqID)
  {
    $query = "SELECT * FROM apprequests WHERE apprequest_id = '$appReqID'";
    $result = $this->conn->query($query);
    if ($result) {
      return $result->fetch_assoc();
    }
    return false;
  }
  public function removeAppReq($appReq)
  {
    $query = "DELETE FROM apprequests WHERE apprequest_id  = $appReq";
    $result = $this->conn->query($query);
    if ($result) {
      return true;
    }
    return false;
  }
}
