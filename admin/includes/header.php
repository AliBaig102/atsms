<header class="border-bottom bg-dark">
    <div class="d-flex align-items-center p-3">
        <div class="d-flex align-items-center">
            <h5 class="mb-0 me-4"><img src="images/ridehub-transparent.png" width="180" alt="RideHub Logo"></h5>
        </div>

        <div class="d-flex flex-grow-1 mx-4">
            <form class="input-group" name="search" action="search-autoortaxi.php" method="post">
                <input type="text" class="form-control" name="searchdata" id="searchdata"
                    placeholder="Search by name or mobile number..." aria-label="Search" />
                <button class="btn btn-outline-secondary bg-dark text-white" type="submit" name="search">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

        <div class="d-flex align-items-center">
            <div class="dropdown">
                <button class="btn d-flex align-items-center" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2"
                        style="width: 32px; height: 32px;">
                        <?php
                        $adminid = $_SESSION['atsmsaid'];
                        $ret = mysqli_query($con, "SELECT AdminName FROM tbladmin WHERE ID='$adminid'");
                        $row = mysqli_fetch_array($ret);
                        ?>
                        <span class="text-muted"><?=substr($row['AdminName'], 0, 1)?></span>
                    </div>
                    <span class="me-1 text-white">
                        <?php
                        echo $row['AdminName'];
                        ?>
                    </span>
                    <i class="bi bi-chevron-down text-white"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="admin-profile.php"><i class="fas fa-user me-2"></i> Admin
                            Profile</a></li>
                    <li><a class="dropdown-item" href="change-password.php"><i class="fas fa-key me-2"></i> Change
                            Password</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>
                            Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>