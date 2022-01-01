<?php
class Employer extends User
{
  private $vacanciesMade;
  private $applicationRequests;

  public function __construct($username, $name, $email, $password, $age, $address, $workingCompany, $applicationRequests = [], $vacanciesMade = [])
  {
    parent::__construct($username, $name, $email, $password, $age, $address, $workingCompany);
    $this->applicationRequests = $applicationRequests;
    $this->vacanciesMade = $vacanciesMade;
  }
  public function getAssocArray($withPassword = false)
  {
    $employerArray  = array('name' => $this->name, 'vacs' => $this->vacanciesMade, 'applicationRequests' => $this->applicationRequests, 'Age' => intval($this->age), 'address' => $this->address, 'company' => $this->workingCompany, 'email' => $this->email, 'username' => $this->username);
    if ($withPassword) $employerArray['password'] = $this->password;
    return $employerArray;
  }
}
