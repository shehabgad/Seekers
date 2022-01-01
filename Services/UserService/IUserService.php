<?php
interface IUserService
{
  public function getUser($username, $password);
  public function isUsernameExist($username);
  public function isEmailExist($email);
  public function addUser($User);
  public function updateEmployerName($id, $newName);
  public function updateEmployerEmail($id, $newEmail);
  public function updateEmployerAddress($id, $newAddress);
  public function updateEmployerWcompany($id, $newCompany);
  public function updateJobSeekerName($id, $newName);
  public function updateJobSeekerEmail($id, $newEmail);
  public function updateJobSeekerAddress($id, $newAddress);
  public function updateJobSeekerWcompany($id, $newCompany);
  public function updateJobSeekerExplevel($id, $newExplevel);
  public function updateJobSeekerIndustry($id, $newIndustry);
  public function updateJobSeekerSkill($id, $newSkill);
  public function addVacancyToEmployer($employerID, $vacancyID);
  public function DeleteVacancyFromEmployer($employerID, $vacancyID);
  public function addAppReqEmployer($employerID, $appReqID);
  public function addAppReqJobSeeker($jobseekerID, $appReqID);
  public function getJobSeeker($jobseekerID);
  public function getEmployer($employerID);
  public function toggleSaveVacancy($jobseekerID, $vacancyID, $save = true);
  public function isApplied($jobseekerID, $vacancyID);
  public function isSaved($jobseekerID, $vacancyID);
  public function removeApplicationRequest($jobseekerID, $employerID, $appReqID);
  public function getJobSeekers($industry, $location, $explevel);
}
