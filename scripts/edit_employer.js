import { validation } from "./Validation.js";
function validateSignupData(e) {
  let error = false;
  let form = document.getElementById("edit_form");
  e.preventDefault();
  let name = document.getElementById("name").value;
  let address = document.getElementById("address").value;
  let email = document.getElementById("email").value;
  let wcompany = document.getElementById("wcompany").value;

 
  // name validation
  let nameErrorStr = validation.nameValidate(name);
  if(!error) error = nameErrorStr.length > 0;
  document.getElementById("error-name").innerHTML = nameErrorStr;

  
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