<?php
class Vacancy implements IVacancy
{
  private $title;
  private $description;
  private $location;
  private $jobType;
  private $expLevel;
  private $companyName;
  private $companyLink;
  private $employerID;
  public function __construct($title, $description, $location, $jobType, $expLevel, $companyName, $companyLink, $employerID)
  {
    $this->title = $title;
    $this->description = $description;
    $this->location = $location;
    $this->jobType = $jobType;
    $this->companyName = $companyName;
    $this->companyLink = $companyLink;
    $this->employerID = $employerID;
    $this->expLevel = $expLevel;
  }
  public function getAssocArray()
  {
    return array('title' => $this->title, 'description' => $this->description, 'location' => $this->location, 'jobType' => $this->jobType, 'companyName' => $this->companyName, 'companyLink' => $this->companyLink, 'employerID' => $this->employerID, 'expLevel' => $this->expLevel);
  }
}
