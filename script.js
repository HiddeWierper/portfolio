

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





