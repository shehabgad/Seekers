<?php
interface IVacancyService
{
  public function addVacancy($vacancy);
  public function getVacancy($vacancyID);
  public function deleteVacancy($vacancyID);
  public function getVacancies($vacancyTitle);
  public function updateVacancy($vacID, $title, $location, $jobtype, $expLevel, $companyName, $companyLink, $description);
}
