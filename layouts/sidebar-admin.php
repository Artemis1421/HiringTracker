<body onload=display_ct7();>

    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu overflow">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading text-center">
                        <span id='ct7' class="text-white"></span>
                    </div>
                    <a class="nav-link" href="/HiringTracker/dashboard/index.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-gauge-high"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Tools</div>
                    <a class="nav-link" href="/HiringTracker/dashboard/index.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-gauge-high"></i></div>
                        Audit Log
                    </a>
                    <!-- <div class="sb-sidenav-menu-heading">Main</div> -->
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon">
                            <i class="fa-solid fa-money-bill-wave"></i>
                        </div>
                        List of Candidates
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="/HiringTracker/trackers/load.php">Load</a>
                            <a class="nav-link" href="/HiringTracker/trackers/transportation.php">Transportation</a>
                            <a class="nav-link" href="/HiringTracker/trackers/delivery.php">Delivery</a>
                            <a class="nav-link" href="/HiringTracker/trackers/misc.php">Miscellaneous</a>
                            <a class="nav-link" href="/HiringTracker/trackers/petty_cash.php">Petty Cash</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReports" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-flag"></i></div>
                        Reports
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseReports" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="/HiringTracker/reports/petty_cash_form.php">Petty Cash Form</a>
                            <a class="nav-link" href="/HiringTracker/reports/cc_usage.php">CC Usage</a>
                            <a class="nav-link" href="/HiringTracker/reports/receipt.php">Receipt</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategories" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Categories
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseCategories" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="/HiringTracker/categories/people.php">People</a>
                            <a class="nav-link" href="/HiringTracker/categories/balance.php">Balance</a>
                            <a class="nav-link" href="/HiringTracker/categories/cost_center.php">Cost Center</a>
                            <a class="nav-link" href="/HiringTracker/categories/department.php">Department</a>
                            <a class="nav-link" href="/HiringTracker/categories/mode_of_payment.php">Mode of Payment</a>
                        </nav>
                    </div>
                    <!-- <div class="sb-sidenav-menu-heading">Miscellaneous</div> -->
                </div>

            </div>  
            <div class="sb-sidenav-footer">
                <div class="fw-bold text-muted mb-3">Team Leader:</div>
                <div class="d-inline-flex">
                <a href="" class="text-light text-muted">Boss Jae Sangalang</a>
                </div>
            </div>
        </nav>
    </div>
</body>