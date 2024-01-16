<header>
  <span class="me"><img class="me" src="/portfolio/img/me.jpeg" alt=""><h2>Hidde Wierper</h2></span>
  <span class="nav">
  <ul>
    <a href="#home"><li>HOME</li></a>
    <a href="#skills"><li>SKILLS</li></a>
    <a href="#projects"><li>PROJECTS</li></a>
    <a href="#contact"><li>CONTACT</li></a>
    <a href="/portfolio/subpages/login.php" ><li><?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : "LOGIN"; ?></li></a>
  </ul>
  </span>
</header>
