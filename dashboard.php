<?php include_once 'header.php'; ?>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">overview</h2>
                    </div>
                </div>
            </div>
            <div class="row m-t-25">
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c1">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>
                                <div class="text">
                                    <h2 id="totalSearchCount">0</h2>
                                    <span>Total Searches</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c3">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-calendar-note"></i>
                                </div>
                                <div class="text">
                                    <h2 id="weekSearchCount">0</h2>
                                    <span>This Week</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row row-categories">
                <button id="analyzeButton" class="au-btn au-btn-icon au-btn--blue">Analyze User History</button>
                <div id="analysisResults"></div>
            </div>
            <div class="row">
                <div class="dash-width" style="width:100% !important;">
                    <h2 class="title-1 m-b-25">User History</div></div></div>

        <div class="table-responsive table--no-card m-b-40">
            <table id="clickHistoryTable" class="table table-borderless table-striped table-earning">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Question</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be populated here via JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        fetch('fetch_click_history.php')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.querySelector('#clickHistoryTable tbody');
                data.forEach(click => {
                    const row = document.createElement('tr');
                    const questionCell = document.createElement('td');
                    const timeCell = document.createElement('td');

                    const questionText = click.question.replace(/<div.*?>|<\/div>/gi, '');
                    questionCell.textContent = questionText;

                    const clickDate = new Date(click.clickedAt);
                    if (!isNaN(clickDate.getTime())) {
                        timeCell.textContent = clickDate.toLocaleString();
                    } else {
                        timeCell.textContent = 'Invalid Date';
                    }
                    row.appendChild(timeCell);
                    row.appendChild(questionCell);

                    tableBody.appendChild(row);
                });
            })
            .catch(error => console.error('Error fetching click history:', error));

        // Fetch the search count and update the dashboard
        fetch('fetch_search_count.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById('totalSearchCount').textContent = data.total_search_count;
                document.getElementById('weekSearchCount').textContent = data.week_search_count;
            })
            .catch(error => console.error('Error fetching search count:', error));

        document.getElementById('analyzeButton').addEventListener('click', function() {
            fetch('fetch_click_history.php')
                .then(response => response.json())
                .then(data => {
                    return fetch('run_python.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    });
                })
                .then(response => response.text())
                .then(data => {
                    document.getElementById('analysisResults').innerHTML = data;
                })
                .catch(error => console.error('Error running Python script:', error));
        });
    });
</script>

<script src="js/dashboard.js"></script>
<script>
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.type = 'text/css';
    link.href = 'css/dashboard.css';
    document.body.appendChild(link);
</script>

<!-- Main JS-->
<script src="js/main.js"></script>

<?php include_once 'footer.php'; ?>
<!-- end document-->
