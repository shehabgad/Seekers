let btn = document.getElementById("search_vacancies");
let vacancies = document.getElementById("vacancies");
let searchForm = document.getElementById("form-search");
function getVacancyData() {
  let searchTitle = document.getElementById("vacancy_title").value;
  if (searchTitle != "") {
    if(window.location.href != "http://localhost:8080/seekers/jobseekerHome.php")
    {
      window.location.href = ("http://localhost:8080/seekers/jobseekerHome.php");
    }
    vacancies.innerHTML = "<div class='spinner-border text-dark text-center'></div>";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        vacancies.innerHTML = this.responseText;
      }
    }
    xmlhttp.open("GET", "http://Localhost:8080/seekers/features/get_vacancies.php?searchTitle=" + searchTitle, true);
    xmlhttp.send();
  }
}
btn.addEventListener("click", getVacancyData);
searchForm.addEventListener("submit", (event) => {event.preventDefault()});