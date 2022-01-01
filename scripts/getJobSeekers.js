let btn = document.getElementById("search_jobseekers");
let jobseekers = document.getElementById("jobseekers");
let searchForm = document.getElementById("form-search");
function getJobseekersData() {
  let industry = document.getElementById("industry").value;
  let location = document.getElementById("location").value;
  let explevel = document.getElementById("explevel").value;
  if (industry != "" && location !="" && explevel !="") {
 
    jobseekers.innerHTML = "<div class='spinner-border text-dark text-center'></div>";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        jobseekers.innerHTML = this.responseText;
      }
    }
    xmlhttp.open("GET", `http://Localhost:8080/seekers/features/get_jobseekers.php?industry=${industry}&location=${location}&explevel=${explevel}`, true);
    xmlhttp.send();
  }
}
btn.addEventListener("click", getJobseekersData);
searchForm.addEventListener("submit", (event) => {event.preventDefault()});