<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="./index.php">ERP SYSTEM</a>

  <div class="collapse navbar-collapse justify-content-center" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item <?php if($page=='customer'){echo 'active';} ?>">
        <a class="nav-link" href="./index.php">Customer</span></a>
      </li>
      <li class="nav-item <?php if($page=='item'){echo 'active';} ?>">
        <a class="nav-link" href="./item.php">Item</a>
      </li>
    </ul>
  </div>
</nav>