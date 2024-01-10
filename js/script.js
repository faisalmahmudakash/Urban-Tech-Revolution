// adminSingUp script
document.getElementById("loadPage").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent the default behavior of the hyperlink
    
    var contentDiv = document.getElementById("adminSing"); //target of showing result
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                contentDiv.innerHTML = xhr.responseText;
            } else {
                console.error('Error: ' + xhr.status);
            }
        }
    };
    
    xhr.open('GET', 'adminSingUp.php', true); // Replace 'yourWebpage.html' with the URL of the webpage you want to load
    xhr.send();
    
    // Clear previous content when clicked second time
    contentDiv.innerHTML = '';
});


// adminSingIn script
document.getElementById("loadPage2").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent the default behavior of the hyperlink
    
    var contentDiv = document.getElementById("adminSing"); //target of showing result
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                contentDiv.innerHTML = xhr.responseText;
            } else {
                console.error('Error: ' + xhr.status);
            }
        }
    };
    
    xhr.open('GET', 'adminSingIn.php', true); // Replace 'yourWebpage.html' with the URL of the webpage you want to load
    xhr.send();
    
    // Clear previous content when clicked second time
    contentDiv.innerHTML = '';
});



// citizenSingUp script
document.getElementById("loadPage3").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent the default behavior of the hyperlink
    
    var contentDiv = document.getElementById("adminSing"); //target of showing result
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                contentDiv.innerHTML = xhr.responseText;
            } else {
                console.error('Error: ' + xhr.status);
            }
        }
    };
    
    xhr.open('GET', 'citizenSingUp.php', true); // Replace 'yourWebpage.html' with the URL of the webpage you want to load
    xhr.send();
    
    // Clear previous content when clicked second time
    contentDiv.innerHTML = '';
});


// citizenSingIn script
document.getElementById("loadPage4").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent the default behavior of the hyperlink
    
    var contentDiv = document.getElementById("adminSing"); //target of showing result
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                contentDiv.innerHTML = xhr.responseText;
            } else {
                console.error('Error: ' + xhr.status);
            }
        }
    };
    
    xhr.open('GET', 'citizenSingIn.php', true); // Replace 'yourWebpage.html' with the URL of the webpage you want to load
    xhr.send();
    
    // Clear previous content when clicked second time
    contentDiv.innerHTML = '';
});
