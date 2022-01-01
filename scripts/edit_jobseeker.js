import { validation } from "./Validation.js";
function validateSignupData(e) {
  let error = false;
  let form = document.getElementById("edit-form");
  e.preventDefault();
  let name = document.getElementById("name").value;
  let address = document.getElementById("address").value;
  let industry = document.getElementById("industry").value;
  let email = document.getElementById("email").value;
  let wcompany = document.getElementById("wcompany").value;
  let explevel = document.getElementById("explevel").value;
  let skill = document.getElementById("skill").value;

  // name validation
  let nameErrorStr = validation.nameValidate(name);
  if(!error) error = nameErrorStr.length > 0;
  document.getElementById("error-name").innerHTML = nameErrorStr;


  // address validation
  let addressErrorStr = validation.addressValidate(address);
  if(!error) error = addressErrorStr.length > 0;
  document.getElementById("error-address").innerHTML = addressErrorStr;

  // industry validation
  let industryErrorStr = validation.industryValidate(industry);
  if(!error) error = industryErrorStr.length > 0;
  document.getElementById("error-industry").innerHTML = industryErrorStr;

  // email validation
  let emailErrorStr = validation.emailValidate(email);
  if(!error) error = emailErrorStr.length > 0;
  document.getElementById("error-email").innerHTML = emailErrorStr;

  // working comapny validation
  let wCompanyErrorStr = validation.wCompanyValidate(wcompany);
  if(!error) error = wCompanyErrorStr.length > 0;
  document.getElementById("error-wcompany").innerHTML = wCompanyErrorStr;

  // exp level validation
  let expLevelErrorStr = validation.expLevelValidate(explevel);
  if(!error) error = expLevelErrorStr.length > 0;
  document.getElementById("error-explevel").innerHTML = expLevelErrorStr;

  // skill validation
  if(skill.length > 0)
  {
   let skillErrorStr = validation.skillValidate(skill);
   if(!error) error = skillErrorStr.length > 0;
   document.getElementById("error-skill").innerHTML = skillErrorStr;
  }
  if (!error) form.submit();

}
document.getElementById("submit_btn").addEventListener("click",validateSignupData);