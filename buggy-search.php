<?php include_once 'header.php';
?>

<div class="search-main-container">
    <div class="search-container">
        <h1 class="hello-user">Hello <?php
            if(isset($_SESSION["username"])){
                echo $_SESSION["username"] . '!';
            } else {
                echo 'User!';
            }
            ?>
        </h1>

        <h1 class="head-buggy">Give us your HTML/CSS bug</h1>
        <input type="text" id="searchInput" placeholder="Enter bug or issue...">
        <button class="search-button" onclick="searchBug()">Search</button>
        <div id="suggestions"></div>
        <div id="answer"></div>
    </div>
</div>
</div>


<script src="script.js"></script>

<script src="hideShow.js"></script>
<!-- Main JS-->



<?php include_once 'footer.php';
?>
<!-- end document-->
