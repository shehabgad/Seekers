<?php
class ApplicationRequest implements IApplicationRequest
{
  private $jobSeekerID;
  private $vacancyID;
  private $coverLetter;
  private $employerID;

  public function __construct($jobSeekerID, $vacancyID, $coverLetter, $employerID)
  {
    $this->jobSeekerID = $jobSeekerID;
    $this->vacancyID = $vacancyID;
    $this->coverLetter = $coverLetter;
    $this->employerID = $employerID;
  }
  public function getAssocArray()
  {
    return array('jobSeekerID' => $this->jobSeekerID, 'vacancyID' => $this->vacancyID, 'coverLetter' => $this->coverLetter, 'employerID' => $this->employerID);
  }
}
