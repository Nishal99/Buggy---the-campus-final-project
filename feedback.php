<?php 
include_once 'header.php';
require_once 'includes/dbh.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rating = $_POST['rating'];
    $comment = $_POST['opinion'];
    $userId = isset($_SESSION['potId']) ? $_SESSION['potId'] : null;

    $sql = "INSERT INTO feedback (user_id, rating, comment) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "iis", $userId, $rating, $comment);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location:test/thank.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    exit();
}
?>

<!-- MAIN CONTENT -->
<div class="main-content" style="background-color:#ffffff;">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <button id="feedbackBtn" class="au-btn au-btn-icon au-btn--blue">+ Feedback</button>
            <div id="feedbackForm" class="wrapper" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; display: none;">
                <h3>How do you feel about us?</h3>
                <form action="feedback.php" method="POST">
                    <div class="rating">
                        <input id="ratingInput" type="number" name="rating" hidden>
                        <i class='bx bx-star star' style="--i: 0;"></i>                  
                        <i class='bx bx-star star' style="--i: 1;"></i>
                        <i class='bx bx-star star' style="--i: 2;"></i>
                        <i class='bx bx-star star' style="--i: 3;"></i>
                        <i class='bx bx-star star' style="--i: 4;"></i>
                    </div>
                    <textarea id="opinion" name="opinion" cols="30" rows="5" placeholder="Your opinion..."></textarea>
                    <div class="btn-group">
                        <button type="submit" class="btn submit" disabled>Submit</button>
                        <button type="button" class="btn cancel" onclick="clearForm()">Cancel</button>
                    </div>
                </form>
            </div>
            
        </div>
        
    </div>
  
</div>

<!-- END MAIN CONTENT -->
  <!-- Display feedback -->
  <section id="testimonials">
    <div class="testimonial-box-container">
        <?php
        $sql = "SELECT f.rating, f.comment, u.usersName, u.usersEmail FROM feedback f JOIN users_details u ON f.user_id = u.potId ORDER BY f.created_at DESC";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="testimonial-box">';
            echo '<div class="box-top">';
            echo '<div class="profile">';
            echo '<div class="profile-img"><img src="images/icon/user.png" /></div>';
            echo '<div class="name-user"><strong>' . $row['usersName'] . '</strong><span>' . $row['usersEmail'] . '</span></div>';
            echo '</div>';
            echo '<div class="reviews">';
            for ($i = 0; $i < 5; $i++) {
                if ($i < $row['rating']) {
                    echo '<i class="fas fa-star"></i>';
                } else {
                    echo '<i class="far fa-star"></i>';
                }
            }
            echo '</div>';
            echo '</div>';
            echo '<div class="client-comment"><p>' . $row['comment'] . '</p></div>';
            echo '</div>';
        }
        ?>
    </div>
</section>


<!-- Jquery JS-->
<script src="vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JS-->
<script src="vendor/bootstrap-4.1/popper.min.js"></script>
<script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS-->
<script src="vendor/slick/slick.min.js"></script>
<script src="vendor/wow/wow.min.js"></script>
<script src="vendor/animsition/animsition.min.js"></script>
<script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<script src="vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="vendor/counter-up/jquery.counterup.min.js"></script>
<script src="vendor/circle-progress/circle-progress.min.js"></script>
<script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="vendor/chartjs/Chart.bundle.min.js"></script>
<script src="vendor/select2/select2.min.js"></script>

<!-- Main JS-->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const opinionInput = document.getElementById("opinion");
        const ratingInputs = document.querySelectorAll('.rating .star');
        const submitBtn = document.querySelector(".submit");

        // Function to check if the form is valid for submission
        function checkFormValidity() {
            let ratingGiven = false;
            ratingInputs.forEach(input => {
                if (input.classList.contains('bxs-star')) {
                    ratingGiven = true;
                }
            });

            if (opinionInput.value.trim() !== "" && ratingGiven) {
                submitBtn.removeAttribute("disabled");
            } else {
                submitBtn.setAttribute("disabled", "disabled");
            }
        }

        // Listen for input events on the textarea and rating inputs
        opinionInput.addEventListener("input", checkFormValidity);
        ratingInputs.forEach(input => {
            input.addEventListener("click", checkFormValidity);
        });
    });
</script>



<script>
    function clearForm() {
        document.getElementById("opinion").value = ""; // Clear the text area
        document.getElementById("ratingInput").value = ""; // Reset the rating
        const allStar = document.querySelectorAll('.rating .star');
        allStar.forEach((item) => {
            item.classList.remove('bxs-star');
            item.classList.remove('active');
            item.classList.add('bx-star');
        });
    }
</script>
<script>
    // Toggle feedback form visibility
    $(document).ready(function(){
        $("#feedbackBtn").click(function(){
            $("#feedbackForm").toggle();
            //$(this).toggle(); // Hide the button when showing the form
        });
    });
</script>
<script>
    // Create a new link element
    const link = document.createElement('link');
    
    // Set the attributes for the link element
    link.rel = 'stylesheet';
    link.type = 'text/css';
    link.href = 'css/feedback.css';  // Path to your CSS file
    
    // Append the link element to the body
    document.body.appendChild(link);
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const allStar = document.querySelectorAll('.rating .star');
        const ratingValue = document.querySelector('.rating input');

        allStar.forEach((item, idx) => {
            item.addEventListener('click', function() {
                let click = 0;
                ratingValue.value = idx + 1;

                allStar.forEach(i => {
                    i.classList.replace('bxs-star', 'bx-star');
                    i.classList.remove('active');
                });
                for(let i = 0; i < allStar.length; i++) {
                    if(i <= idx) {
                        allStar[i].classList.replace('bx-star', 'bxs-star');
                        allStar[i].classList.add('active');
                    } else {
                        allStar[i].style.setProperty('--i', click);
                        click++;
                    }
                }
            });
        });
    });
</script>

<?php include_once 'footer.php'; ?>
<!-- end document-->
