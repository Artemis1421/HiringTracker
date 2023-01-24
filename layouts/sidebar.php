<?php
    $find_approval_count_db = find_approval_count();
    foreach ($find_approval_count_db as $find_approval_count) {
        $approval_count = $find_approval_count['COUNT(iff_int_id)'];
    } 
?>

<body onload=display_ct7();>
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu overflow">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading text-center">
                        <span id='ct7' class="text-white"></span>
                    </div>
                    <div class="sb-sidenav-menu-heading">Dashboard</div>
                    <a class="nav-link" href="/HiringTracker/dashboard/index.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-gauge-high"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link justify-content-between" href="/HiringTracker/categories/iffApproval.php">
                        <div class="d-flex flex-row">
                            <div class='sb-nav-link-icon'><i class='fa-regular fa-id-card'></i></div>
                            Approval
                        </div>
                        <p class="m-0 text-center" style="font-size: 0.9rem;">               
                            <?php 
                                // if the approval request count is 0, do not display the red notification
                                if($approval_count == 0) echo ""; else {
                            ?>
                                <span class="badge text-bg-danger rounded-pill">
                                    <?php echo $approval_count ?>
                                </span>
                            <?php } ?>
                        </p>             
                    </a>
                    <div class="sb-sidenav-menu-heading">Tools</div>
                    <a class="nav-link" href="/HiringTracker/listOfCandidates/listOfCandidates.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                        List of Candidates
                    </a>
                    <a class="nav-link" href="/HiringTracker/interviewFeedbackForm/iff.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-comment-dots"></i></div>
                        Interview Feedback Form
                    </a>
                    <a class="nav-link" href="/HiringTracker/weeklyReport/report.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-file"></i></div>
                        Weekly Report
                    </a>
                    <a class="nav-link" href="/HiringTracker/auditLog/auditLog.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-clipboard-list"></i></div>
                        Audit Log
                    </a>
                    <div class="sb-sidenav-menu-heading">Categories</div>
                    <a class="nav-link" href="/HiringTracker/categories/department.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-building"></i></div>
                        Departments
                    </a>
                    <a class="nav-link" href="/HiringTracker/categories/interviewer.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-question"></i></div>
                        Interviewers
                    </a>
                    <a class="nav-link" href="/HiringTracker/categories/source.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-sitemap"></i></div>
                        Sources
                    </a>
                    <a class="nav-link" href="/HiringTracker/categories/position.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-location-pin"></i></div>
                        Positions
                    </a>
                  
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="d-inline-flex">
                    <a href="" class="text-light text-muted">Contact Us: <br> payreto.hiring.tracker <br>@gmail.com</a>
                </div>
            </div>
        </nav>
    </div>
</body>