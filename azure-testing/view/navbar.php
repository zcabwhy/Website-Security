<nav class="navbar navbar-inverse navbar-default navbar-static-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Snippets</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li>
        <?php
          if(!(isset($_SESSION["name"]) && $_SESSION["name"] != '')){
            echo "  <a href='/?action=login'>Sign in</a>
            </li>
            <li>
              <a href='/?action=register'>Register</a>";
          } else {
            echo "<a href='/?action=profile'>Logged in as " .$_SESSION['name'] . "</a>
          </li>
          <li>
            <a href='/?action=snippets'>Snippets</a>
          </li>
          <li>
            <a href='/?action=fileupload'>Storage</a>
          </li>
          <li>
            <a href='logOut.php'>Logout</a>";
          } ?>
        </li>
      </ul>
    </div>
  </div>
</nav>
