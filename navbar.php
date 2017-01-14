<nav class="navbar navbar-inverse navbar-default navbar-static-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Snippets</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li>
        <?php
          if(!(isset($_SESSION["name"]) && $_SESSION["name"] != '')){
            echo "  <a href='signin.php'>Sign in</a>
            </li>
            <li>
              <a href='register.php'>Register</a>";
          } else {
            echo "<a href='profile.php'>Logged in as " .$_SESSION['name'] . "</a>
          </li>
          <li>
            <a href='snippets.php'>Snippets</a>
          </li>
          <li>
            <a href='fileupload.php'>Storage</a>
          </li>
          <li>
            <a href='logOut.php'>Logout</a>";
          } ?>
        </li>
      </ul>
    </div>
  </div>
</nav>
