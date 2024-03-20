<header>
  <span class="me"><img class="me" onclick="enlargeImg()" id="me" src="/portfolio/img/me.jpeg" alt=""><h2>Hidde Wierper</h2></span>
  <span class="nav">
  <svg class="ham hamRotate ham1 hamburger " viewBox="0 0 100 100" width="80" onclick="this.classList.toggle('active');openMenu();">
  <path
        class="line top"
        d="m 30,33 h 40 c 0,0 9.044436,-0.654587 9.044436,-8.508902 0,-7.854315 -8.024349,-11.958003 -14.89975,-10.85914 -6.875401,1.098863 -13.637059,4.171617 -13.637059,16.368042 v 40" />
  <path
        class="line middle"
        d="m 30,50 h 40" />
  <path
        class="line bottom"
        d="m 30,67 h 40 c 12.796276,0 15.357889,-11.717785 15.357889,-26.851538 0,-15.133752 -4.786586,-27.274118 -16.667516,-27.274118 -11.88093,0 -18.499247,6.994427 -18.435284,17.125656 l 0.252538,40" />
</svg>

  <ul class="">
    <a href="/portfolio/index.php"><li>HOME</li></a>
    <a href="#skills"><li>SKILLS</li></a>
    <a href="#projects"><li>PROJECTS</li></a>
    <a href="#contact"><li>CONTACT</li></a>
    <a href="/portfolio/subpages/login.php" ><li><?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : "LOGIN"; ?></li></a>
  </ul>
  </span>
</header>

<div id="imgModal">
  <span class="close" onclick="closeImg()">&times;</span>
  <img class="modal-content" class="me" src="/portfolio/img/me.jpeg" id="imgMe">
  <div id="caption">Hidde Wierper</div>
</div>
