import { validation } from "./Validation.js";
function validateSignupData(e) {
  let error = false;
  let form = document.getElementById("signup-form");
  e.preventDefault();
  let username = document.getElementById("username").value;
  let name = document.getElementById("name").value;
  let password = document.getElementById("password").value;
  let password2 = document.getElementById("password2").value;
  let age = parseInt(document.getElementById("age").value);
  let address = document.getElementById("address").value;
  let email = document.getElementById("email").value;
  let wcompany = document.getElementById("wcompany").value;

  // username validation
  let userNameErrorStr = validation.usernameValidate(username);
  if(!error) error = userNameErrorStr.length > 0;
  document.getElementById("error-username").innerHTML = userNameErrorStr;
  // name validation
  let nameErrorStr = validation.nameValidate(name);
  if(!error) error = nameErrorStr.length > 0;
  document.getElementById("error-name").innerHTML = nameErrorStr;

  // password validation
  let passwordErrorStr = validation.passwordValidate(password);
  if(!error) error = passwordErrorStr.length > 0;
  document.getElementById("error-password").innerHTML = passwordErrorStr;
  let password2ErrorStr = validation.password2Validate(password,password2);
  if(!error) error = password2ErrorStr.length > 0;
  document.getElementById("error-password2").innerHTML = password2ErrorStr;
  
  

  // age validation
  let ageErrorStr = validation.ageValidation(age);
  if(!error) error = ageErrorStr.length > 0;
  document.getElementById("error-age").innerHTML = ageErrorStr;

  // address validation
  let addressErrorStr = validation.addressValidate(address);
  if(!error) error = addressErrorStr.length > 0;
  document.getElementById("error-address").innerHTML = addressErrorStr;


  // email validation
  let emailErrorStr = validation.emailValidate(email);
  if(!error) error = emailErrorStr.length > 0;
  document.getElementById("error-email").innerHTML = emailErrorStr;

  // working comapny validation
  let wCompanyErrorStr = validation.wCompanyValidate(wcompany);
  if(!error) error = wCompanyErrorStr.length > 0;
  document.getElementById("error-wcompany").innerHTML = wCompanyErrorStr;

  if (!error) form.submit();

}
document.getElementById("submit_btn").addEventListener("click",validateSignupData);