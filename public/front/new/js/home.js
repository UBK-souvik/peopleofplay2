 // For onscroll

window.onscroll = function() {myFunction()};

var header = document.getElementById("DesktopHeaderHome");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}



// Add active class to the current button (highlight it)
var header = document.getElementById("inbox_chatMessage");
var clicks = header.getElementsByClassName("div");
for (var i = 0; i < clicks.length; i++) {
  clicks[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active_chat");
  current[0].className = current[0].className.replace(" active_chat", "");
  this.className += " active_chat";
  });
}

