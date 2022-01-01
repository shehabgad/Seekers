<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <ul class="navbar-nav">
      <a href="index.php" class="navbar-brand">Seekers</a>
      <li class="nav-item me-2">
        <a href="applicationrequests-jobseeker.php" class="nav-link btn btn-light text-dark">Applied vacancies</a>
      </li>
      <li class="nav-item">
        <a href="saved-vacancies.php" class="nav-link btn btn-light text-dark">Saved vacanciees</a>
      </li>
    </ul>
    <form class="d-flex p-2 me-2" id="form-search">
      <input type="text" class="form-control me-2" placeholder="Search" id="vacancy_title">
      <button class="btn btn-light" id="search_vacancies">Search</button>
    </form>
    <a href="config/logout.php" class="btn btn-danger">Logout</a>
  </div>
</nav>