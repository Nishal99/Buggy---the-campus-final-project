function searchBug() {
    var searchInput = document.getElementById('searchInput').value;
    
    // Make AJAX request to server with searchInput
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch-suggestions.php?q=' + encodeURIComponent(searchInput), true);
    xhr.onload = function() {
        if (xhr.status == 200) {
            document.getElementById('suggestions').innerHTML = xhr.responseText;
        } else {
            console.error('Error: ' + xhr.statusText);
        }
    };
    xhr.onerror = function() {
        console.error('Request failed.');
    };
    xhr.send();
}



