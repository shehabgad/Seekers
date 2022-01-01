<?php
class JobSeeker extends User
{
  private $skills;
  private $industry;
  private $experienceLevel;
  private $applicationRequests;
  private $savedVacancies;

  public function __construct($username, $name, $email, $password, $age, $address, $workingCompany, $skills, $industry, $experienceLevel, $applicationRequests = [], $savedVacancies = [])
  {
    parent::__construct($username, $name, $email, $password, $age, $address, $workingCompany);
    $this->skills = $skills;
    $this->industry = $industry;
    $this->experienceLevel = $experienceLevel;
    $this->applicationRequests = $applicationRequests;
    $this->savedVacancies = $savedVacancies;
  }
  public function getAssocArray($withPassword = false)
  {
    $jobSeekerarray = array(
      'name' => $this->name,
      'username' => $this->username,
      'industry' => $this->industry,
      'expLevel' => $this->experienceLevel,
      'applicationRequests' => $this->applicationRequests,
      'savedVacs' => $this->savedVacancies,
      'Age' => $this->age,
      'address' => $this->address,
      'company' => $this->workingCompany,
      'email' => $this->email,
      'skills' => $this->skills
    );
    if ($withPassword) $jobSeekerarray['password'] = $this->password;
    return $jobSeekerarray;
  }
}
