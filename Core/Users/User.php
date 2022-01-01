<?php

abstract class User
{
  protected $username;
  protected $name;
  protected $email;
  protected $password;

  protected $age;
  protected $address;
  protected $workingCompany;


  public function __construct($username, $name, $email, $password, $age, $address, $workingCompany)
  {
    $this->username = $username;
    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
    $this->age = $age;
    $this->address = $address;
    $this->workingCompany = $workingCompany;
  }
  public abstract function getAssocArray($withPassword = false);
}
