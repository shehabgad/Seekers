<?php
include 'IVacancyService.php';
class VacancyService implements IVacancyService
{
  private $conn;
  public function __construct($servername, $username, $password, $dbname)
  {
    $this->conn = new mysqli($servername, $username, $password, $dbname);
  }
  public function addVacancy($vacancy)
  {
    $vacancyInfo = $vacancy->getAssocArray();
    $title = $vacancyInfo['title'];
    $description = $vacancyInfo['description'];
    $location = $vacancyInfo['location'];
    $jobType = $vacancyInfo['jobType'];
    $expLevel = $vacancyInfo['expLevel'];
    $companyName = $vacancyInfo['companyName'];
    $companyLink = $vacancyInfo['companyLink'];
    $employerID = $vacancyInfo['employerID'];

    $query1 = "INSERT INTO vacancies (title, description, location, job_type,exp_level,company_name,company_link,employer_id) VALUES ('$title', '$description', '$location','$jobType','$expLevel','$companyName','$companyLink','$employerID')";
    $result = $this->conn->query($query1);
    if ($result) {
      return $this->conn->insert_id;
    }
    return false;
  }
  public function getVacancy($vacancyID)
  {
    $query = "SELECT * FROM vacancies WHERE vacancy_id = '$vacancyID'";
    $result = $this->conn->query($query);
    $vacancy = null;
    if ($result) {
      $vacancy = $result->fetch_assoc();
      return $vacancy;
    }
    return false;
  }
  public function deleteVacancy($vacancyID)
  {
    $query = "DELETE FROM vacancies WHERE vacancy_id = $vacancyID";
    $result = $this->conn->query($query);

    if ($result) {
      return true;
    }
    return false;
  }
  public function getVacancies($vacancyTitle)
  {
    $query = "SELECT * FROM vacancies WHERE LOWER(title) LIKE LOWER('%$vacancyTitle%')";
    $result = $this->conn->query($query);
    $vacancies = [];
    if ($result->num_rows == 0) {
      return false;
    }
    while ($row = $result->fetch_assoc()) {
      $vacancies[] = $row;
    }
    return $vacancies;
  }
  public function updateVacancy($vacID, $title, $location, $jobtype, $expLevel, $companyName, $companyLink, $description)
  {
    // $query = "UPDATE vacancies SET title='$title', location='$location', job_type='$jobtype', company_name='$companyName', company_link='$companyLink', exp_level=$expLevel, description=$description WHERE vacancy_id = '$vacID'";

    $query = "UPDATE vacancies SET title='$title', location='$location', job_type='$jobtype', company_name='$companyName', company_link='$companyLink', exp_level='$expLevel', description='$description' WHERE vacancy_id='$vacID'";
    $result = $this->conn->query($query);
    return $result;
  }
}
