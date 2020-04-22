// JavaScript: ajax.js

// Link the button to the ajaxrequest function when the page loads
 function main() {
    document.getElementById('ajaxbtn').addEventListener('click', ajaxrequest);

    var burger= document.getElementById("burger");
    burger.addEventListener('click',show);
}

function show(){
    var navlinks=document.querySelector('.nav-links');
    navlinks.classList.toggle('nav-active');
}




function ajaxrequest()
{
    // Create the XMLHttpRequest variable.
    // This variable represents the AJAX communication between client and
    // server.
    var xhr2 = new XMLHttpRequest();

    // Read the data from the form fields.
    var a = document.getElementById("region").value;
    if(a==''){
        alert("Please type in region and try again");
    }
    else{
        // Specify the CALLBACK function. 
        // When we get a response from the server, the callback function will run
        xhr2.addEventListener ("load", responseReceived);

        // Open the connection to the server
        // We are sending a request to "flights.php" in the same folder
        // and passing in the 
        // destination and date as a query string. 
        xhr2.open('GET',
            'https://edward2.solent.ac.uk/~assign253/index/search/'+a);

        // Send the request.
        xhr2.send();
    }
}

// The callback function
// It simply places the response from the server in the div with the ID
// of 'response'.

// The parameter "e" contains the original XMLHttpRequest variable as
// "e.target".
// We get the actual response from the server as "e.target.responseText"
function responseReceived(e)
{    var responsediv = document.getElementById("response");
    responsediv.innerHTML = e.target.responseText;
    responsediv.scrollIntoView();
}