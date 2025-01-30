<nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="./danhSachBaiViet.php">MTRI</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="./danhSachBaiViet.php">Bai viet</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./createUI.php">Them bai</a>
        </li>
      </ul>
      <form class="d-flex" action="searchHandle.php" method="get">
        <input class="form-control me-2" name="searchQuery" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>