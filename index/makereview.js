// JavaScript: ajax.js

// Link the button to the ajaxrequest function when the page loads
function main() {
    document.getElementById('ajaxbtnreview').addEventListener('click', ajaxreview);

    var burger= document.getElementById("burger");
    burger.addEventListener('click',show);
}

function show(){
    var navlinks=document.querySelector('.nav-links');
    navlinks.classList.toggle('nav-active');
}


function ajaxreview()
{
    var xhr2 = new XMLHttpRequest();
    var reviewtxt = document.getElementById("reviewtext").value;
    var poiid = document.getElementById("parseid").value;
    if(reviewtxt==''){
        alert("Please type in review text and try again");
    }
    else{
        var data = new FormData();
        data.append("revtxt", reviewtxt);
        data.append("poiid", poiid);
        xhr2.addEventListener ("load", reviewresponse);
        xhr2.open('POST',
        'https://edward2.solent.ac.uk/~assign253/index/review');
        xhr2.send(data);
    }
}

function reviewresponse(e){
    var responsedivreview = document.getElementById("responsedivreview");

    responsedivreview.innerHTML = e.target.responseText;
    responsedivreview.style.display = "block";

}


