function showAnswer(question) {
    var answer = question.nextElementSibling;
    answer.style.display = (answer.style.display === 'none') ? 'block' : 'none';

    // Apply styling to clicked question
    question.style.backgroundColor = '#4272d7';
    question.style.color = 'white';
    question.style.fontWeight = 'bold';
    question.style.padding = '10px 20px';

    var allQuestions = document.querySelectorAll('.ques_div-container');
    allQuestions.forEach(function(q) {
        if (q !== question) {
            q.style.display = 'none'; // Hide other questions
            // Reset styling of other questions
            q.style.backgroundColor = '';
            q.style.color = '';
            q.style.fontWeight = '';
        }
    });

    // Send AJAX request to store click data
    var slotId = question.getAttribute('data-slotid');
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'store-click.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log(xhr.responseText); // Display the response from the server
        } else {
            console.error('Error: ' + xhr.statusText);
        }
    };
    xhr.send('slotId=' + encodeURIComponent(slotId));
}

document.addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('ques_div-container')) {
        // Show answer for clicked question
        showAnswer(e.target);
    }
});
