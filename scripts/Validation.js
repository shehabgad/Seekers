class Validation
{
  usernameValidate(username) {
    let regex = new RegExp(/^[A-Za-z][A-Za-z0-9_]{7,29}$/);
    if (username === "") {
      return "please enter a user name";
    } else if (username.length < 8) {
      return "username should be at least 8 characters";
    } else if (username.indexOf(" ") !== -1) {
      return "username should not contain spaces";
    } else if (!(username.match(regex))) {
      return "please enter a valid username"
    } else {
      return ""
    }
  }
  nameValidate(name) {
      let regex = new RegExp(/^[a-zA-Z ]*$/);
      if (name === "") {
        return "please enter a name"
      } else if (!(name.match(regex))) {
        return "please enter a valid name"
      } else {
        return  "";
      }

  }

  passwordValidate(password) {
    if (password.length < 6) {
      return "password must be at least 6 characters"
      
    } else {
      return ""
    }
  }
  password2Validate(password, password2) {
    if(password != password2) {
      return "password doesnt match";
    }
    return "";
  }
  ageValidation(age)
  {
    if (age !== age) {
      return "please enter your age";
      
    } else if (age < 18 || age > 65) {
      return "age should be minimu 18 and maximum 65";
      
    } else {
      return ""
    }
  }
  addressValidate(address)
  {
    let regex = new RegExp(/^[a-zA-Z ]*$/);
    if (address === "") {
      return "please enter an address";
    } else if (!(address.match(regex))) {
      return "please enter a valid address";
    } else {
      return "";
    }
  }

  industryValidate(industry)
  {
    let regex = new RegExp(/^[a-zA-Z }]*$/);
    if (industry === "") {
      return "please enter an industry"
      
    } else if (industry.length < 5 || industry.length > 30) {
      return "industry must be between 5 and 30 characters"
      
    } else if (!(industry.match(regex))) {
      return "please enter a valid industry"
      
    } else {
      return ""
    }
  }

  emailValidate(email)
  {
    let regex = new RegExp(/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i)
    if (email === "") {
      return "please enter an email"
      
    } else if (!(email.match(regex))) {
      return "please enter a valid email"
      
    } else {
      return ""
    }
  }

  wCompanyValidate(company) {
    let regex = new RegExp(/(?=.*[a-zA-z])/)
    if (company === "") {
      return "please enter your current company"
      
    } else if (!(company.match(regex))) {
      return "please enter a valid company name"
      
    } else {
      return ""
    }
  }

  expLevelValidate(explevel)
  {
    let regex = new RegExp(/[a-zA-z]/)
    if (explevel === "") {
      return "please enter your current experience level"
    } else if (!(explevel.match(regex))) {
      return "please enter a valid experience level"
    } else {
      return ""
    }
  }

  skillValidate(skill)
  {
    let regex = new RegExp(/[a-zA-z]/);
    if (skill === "") {
       return "please enter a skill"
      
    } else if (!(skill.match(regex))) {
      return "please enter a valid skill"
      
    } else {
      return ""
    }
  }
}
export let validation =  new Validation();