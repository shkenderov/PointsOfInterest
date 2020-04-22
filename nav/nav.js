function main(){
   var burger= document.getElementById("burger");
   burger.addEventListener('click',show);
}

function show(){
    var navlinks=document.querySelector('.nav-links');
    navlinks.classList.toggle('nav-active');
}
