
var id;
var activeLink = null;

function active(id){
  
  if (activeLink) {
    activeLink.style.color = "black";
  }
  var element = document.getElementById(id);
  element.style.color = "#7843e9";
  activeLink = element;
}

document.addEventListener("DOMContentLoaded", function() {
  console.log("DOM fully loaded and parsed");
  active('skill');  
});


//add var for every skill icon
var html = document.querySelector(".html");
var css = document.querySelector(".css");
var js = document.querySelector(".js");
var php = document.querySelector(".php");
var sql = document.querySelector(".sql");
var git = document.querySelector(".git");
var java = document.querySelector(".java");
var github = document.querySelector(".github");
var term = document.querySelector(".terminal");
var gitIcon = document.querySelector(".gitIcon");


//add var for every skill text
var htmlText = document.getElementById("htmlText");
var cssText = document.getElementById("cssText");
var jsText = document.getElementById("jsText");
var phpText = document.getElementById("phpText");
var sqlText = document.getElementById("sqlText");
var gitText = document.getElementById("gitText");
var javaText = document.getElementById("javaText");
var githubText = document.getElementById("githubText");
var termText = document.getElementById("termText");
var section = document.getElementById("section");




//now add that if mouseover, the icon will be red
htmlText.addEventListener("mouseover", function(){
  html.style.transform = "scale(1.3)";
  html.style.boxShadow = "1px 1px 38px 0px rgba(0,0,0,0.75)";
});
htmlText.addEventListener("mouseout", function(){
  html.style.transform = "";
  html.style.boxShadow = "";
});

cssText.addEventListener("mouseover", function(){
  css.style.transform = "scale(1.3)";
  css.style.boxShadow = "1px 1px 38px 0px rgba(0,0,0,0.75)";
});
cssText.addEventListener("mouseout", function(){
  css.style.transform = "";
  css.style.boxShadow = "";
});

jsText.addEventListener("mouseover", function(){
  js.style.transform = "scale(1.3)";
  js.style.boxShadow = "1px 1px 38px 0px rgba(0,0,0,0.75)";
});
jsText.addEventListener("mouseout", function(){
  js.style.transform = "";
  js.style.boxShadow = "";
});

phpText.addEventListener("mouseover", function(){
  php.style.transform = "scale(1.3)";
  php.style.boxShadow = "1px 1px 38px 0px rgba(0,0,0,0.75)";
});
phpText.addEventListener("mouseout", function(){
  php.style.transform = "";
  php.style.boxShadow = "";
});

sqlText.addEventListener("mouseover", function(){
  sql.style.transform = "scale(1.3)";
  sql.style.boxShadow = "1px 1px 38px 0px rgba(0,0,0,0.75)";
});
sqlText.addEventListener("mouseout", function(){
  sql.style.transform = "";
  sql.style.boxShadow = "";
});

gitText.addEventListener("mouseover", function(){
  git.style.transform = "scale(1.3)";
  git.style.boxShadow = "1px 1px 38px 0px rgba(0,0,0,0.75)";
});
gitText.addEventListener("mouseout", function(){
  git.style.transform = "";
  git.style.boxShadow = "";
});

javaText.addEventListener("mouseover", function(){
  java.style.transform = "scale(1.3)";
  java.style.boxShadow = "1px 1px 38px 0px rgba(0,0,0,0.75)";
});
javaText.addEventListener("mouseout", function(){
  java.style.transform = "";
  java.style.boxShadow = "";
});
githubText.addEventListener("mouseover", function(){
  github.style.transform = "scale(1.3)";
  github.style.boxShadow = "1px 1px 38px 0px rgba(0,0,0,0.75)";
});
githubText.addEventListener("mouseout", function(){
  github.style.transform = "";
  github.style.boxShadow = "";
});
termText.addEventListener("mouseover", function(){
  term.style.transform = "scale(1.3)";
  term.style.boxShadow = "1px 1px 38px 0px rgba(0,0,0,0.75)";
});
termText.addEventListener("mouseout", function(){
  term.style.transform = "";
  term.style.boxShadow = "";
});

function goToElement(elementId) {
  // Scroll to the element with the specified ID
  var element = document.getElementById(elementId);
  if (element) {
    element.scrollIntoView({ behavior: 'smooth' });
  }
}
function switchImage(id) {
  var Image_Id = document.getElementById(id);
  if (Image_Id.src.match("img/weform-pc.png")) {
      Image_Id.src = "img/weform-mobile.png";
      Image_Id.style.transform = "scaleX(-1)";
      Image_Id.style.transition = "all 0.5s ease-in-out";
  }
  else if (Image_Id.src.match("img/weform-mobile.png")) {
      Image_Id.src = "img/weform-pc.png";
      Image_Id.style.transform = "scaleX(1)";
      Image_Id.style.transition = "all 0.5s ease-in-out";
  }
  if (Image_Id.src.match("img/kat-pc.png")) {
    Image_Id.src = "img/kat-mobile.png";
    Image_Id.style.transform = "scaleX(1)";
    Image_Id.style.transition = "all 0.5s ease-in-out";
  }
  else if (Image_Id.src.match("img/kat-mobile.png")) {
      Image_Id.src = "img/kat-pc.png";
      Image_Id.style.transform = "scaleX(-1)";
      Image_Id.style.transition = "all 0.5s ease-in-out";
  }
}




document.addEventListener("DOMContentLoaded", function() {
  document.querySelectorAll('a[href^="#"], input[type="button"]').forEach(element => {
    element.addEventListener('click', function (e) {
      e.preventDefault();

      let targetId;
      if (this.tagName === 'A') {
        targetId = this.getAttribute('href').substring(1);
      } else if (this.tagName === 'INPUT' && this.type === 'button') {
        targetId = this.getAttribute('data-target');
      }

      const targetElement = document.getElementById(targetId);

      if (targetElement) {
        const offset = targetElement.getBoundingClientRect().top + window.scrollY;

        // Additional actions and scrolling based on target ID
        if (targetId === 'skills') {
          console.log('Scrolling to section1 with custom action');
          window.scrollTo({
            top: offset - window.innerHeight + 0.45 * window.innerHeight, 
            behavior: 'smooth'
          });
          // Add your specific code for 'section1' here
        } else if (targetId === 'projects') {
          console.log('Scrolling to section2 with custom action');
          window.scrollTo({
            top: offset - window.innerHeight + 0.9 * window.innerHeight,
            behavior: 'smooth'
          });
          // Add your specific code for 'section2' here
        } else {
          console.log('Scrolling to default section');
          window.scrollTo({
            top: offset - window.innerHeight + 0 * window.innerHeight,
            behavior: 'smooth'
          });
        }
      }
    });
  });
});



function createObserver(targetSelector, childSelector, className) {
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      const insight = entry.target.querySelector(childSelector);

      if (entry.isIntersecting) {
        insight.classList.add(className);
        return; // if we added the class, exit the function
      }

      // We're not intersecting, so remove the class!
      // insight.classList.remove(className);
    });
  });

  observer.observe(document.querySelector(targetSelector));
}

// Observer 1
createObserver('.project:nth-of-type(1):not(hr)', '.odd', 'fly-in-right');
createObserver('.project:nth-of-type(1):not(hr)', '.imgContainer', 'rotate-image-clockwise');

// Observer 2
createObserver('.project:nth-of-type(2):not(hr)', '.even', 'fly-in-left');
createObserver('.project:nth-of-type(2):not(hr)', '.imgContainer', 'rotate-image-counter-clockwise');

// Observer 3
createObserver('.project:nth-of-type(3):not(hr)', '.odd', 'fly-in-right');
createObserver('.project:nth-of-type(3):not(hr)', '.imgContainer', 'rotate-image-clockwise');

// Observer 4
createObserver('.project:nth-of-type(4):not(hr)', '.odd', 'fly-in-left');
createObserver('.project:nth-of-type(4):not(hr)', '.imgContainer', 'rotate-image-counter-clockwise');

// Observer 5
createObserver('.project:nth-of-type(5):not(hr)', '.odd', 'fly-in-right');
createObserver('.project:nth-of-type(5):not(hr)', '.imgContainer', 'rotate-image-clockwise');

// Observer 6
createObserver('.project:nth-of-type(6):not(hr)', '.odd', 'fly-in-left');
createObserver('.project:nth-of-type(6):not(hr)', '.imgContainer', 'rotate-image-counter-clockwise');

// Add more observers and if statements for different animation classes as needed

function previousEdit(id){
  var current = document.getElementById(id);
  var cat = document.getElementById("catSubmit");
  var weform = document.getElementById("weformSubmit");
  var no_escape = document.getElementById("no-escapeSubmit");
  if (id == "weformSubmit"){
    current.style.display = "none";
    cat.style.display = "grid";
  }
  else if (id == "catSubmit"){
    current.style.display = "none";
    weform.style.display = "grid";
  }
  else if (id == "no-escapeSubmit"){
    current.style.display = "none";
    weform.style.display = "grid";
  }
}

function showLoader(){
  var loader = document.getElementById("container");
  loader.style.display = "flex";
}

function hideLoader(){
  var loader = document.getElementById("container");
  loader.style.display = "none";
}

function hideWarning(){
  var warning = document.getElementById("warning");
  warning.style.display = "none";
  refresh();

}

function refresh(){
  //go to specific link
  window.location.href = "http://localhost/portfolio/subpages/admin.php";


}


