<?php
session_start();
include('functions.php');
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
$applicant = $table->getApplicants($_SESSION['partnerid']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Dashboard - Application</title>
    <link rel="icon" href="android-icon-36x36.png">
    <link rel="stylesheet" href="style-dashboard.css">
    <script src="https://kit.fontawesome.com/6ee19359d3.js" crossorigin="anonymous"></script>
</head>
<body>
    
    <input type="checkbox"  id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <a href="listing.php"><h2><span class="fab fa-forumbee"></span><span>BeeHouse</span></h2></a>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="dashboard-partner-dashboard.php" ><span class="fas fa-tachometer-alt"></span>
                    <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="dashboard-partner-tenants.php"><span class="fas fa-users"></span>
                    <span>Tenants</span></a>
                </li>
                <li>
                    <a href="dashboard-partner-property.php"><span class="fas fa-home"></span>
                    <span>Property</span></a>
                </li>
                <li>
                    <a href="dashboard-partner-rooms.php"><span class="fas fa-door-open"></span>
                    <span>Rooms</span></a>
                </li>
                <li>
                    <a href="dashboard-partner-applicants.php" class="active"><span class="fas fa-file-alt"></span>
                    <span>Applicants</span></a>
                </li>
                <li>
                    <a href="listing.php"><span class="fas fa-user-circle"></span>
                    <span>Home</span></a>
                </li>
                <li>
                    <a href="logout.php"><span class="fas fa-sign-out-alt"></span>
                    <span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">
                    <span class="fas fa-bars"></span>
                </label>
                Applicants

                
            </h2>

            <div class="search-wrapper">
                <span class="fas fa-search"></span>
                <input type="search" placeholder="Search here">
            </div>

            <div class="user-wrapper">
                <img src="images/user.png" width="30px" height="30px" alt="">
                <div>
                    <h4><?php echo htmlspecialchars($_SESSION["username"]);?></h4>
                    <small>Super admin</small>
                </div>
            </div>
        </header>

        <main>
            <div class="units-grid">
                <div class="units-wrapper">
                    <div class="projects">
                        <div class="card">
                            <div class="card-header">
                                <h3>Applications</h3>
                                <button>See all <span class=""fas fa-arrow-right></span></button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table width="100%">
                                        <thead>
                                            <tr>
                                                <td>Name</td>
                                                <td>Gender</td>
                                                <td>Contact number</td>
                                                <td>Unit name</td>
                                                <td>Room number</td>
                                                <td>Status</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                            <?php foreach($applicant as $applicants){ ?>
                                            <tbody>
                                                <td class="td-app2"><?php echo $applicants['first_name'] ?> <?php echo $applicants['last_name'] ?></td>
                                                <td class="td-app2"><?php if($applicants['gender'] == 1){
                                                    echo "Male";
                                                }else{
                                                    echo "Female";
                                                } ?></td>
                                                <td class="td-app2"><?php echo $applicants['phone'] ?></td>
                                                <td class="td-app2"><?php echo $applicants['property_name'] ?></td>
                                                <td class="td-app2"><?php echo $applicants['room_number'] ?></td>
                                                <?php if($applicants['status'] == 0): ?>
                                                <td class="text-center td-app2"><span class="badge badge-success"><span class="status orange"></span>Pending</span></td>
                                                <?php else: ?>
                                                <td class="text-center td-app2"><span class="badge badge-default"><span class="status green"></span>Approved</span></td>
                                                <?php endif; ?>
                                                <form action="include/delete-applicants-inc.php" method="post">
                                                    <td class="text-center td-app2">
                                                        <input type="hidden" name="application_id" value=<?php echo $applicants['applicants_id'] ?>>
                                                        <button class="cd-popup-trigger action button-approve" type="button">Approve</button>
                                                        <button class="action button-cancel" name="submit" type="submit">Reject</button>
                                                    </td>
                                                </form>
                                                <td><?php  ?></td>
                                            </tbody>
                                            <form action="include/add-tenant-inc.php" method="post">
                                                <div class="cd-popup" role="alert">
                                                    <div class="cd-popup-container">
                                                        <p>Are you sure you want to accept?</p>
                                                        <ul class="cd-buttons" style="list-style: none;">
                                                            <input type="hidden" name="application_id" value=<?php echo $applicants['applicants_id'] ?>>
                                                            <input type="hidden" name="room_id" value=<?php echo $applicants['room_id'] ?>>
                                                            <input type="hidden" name="user_id" value=<?php echo $applicants['user_id'] ?>>
                                                            <li><input name="submit" type="submit" class="cd-button-yes" value="Yes"></input></li>
                                                            <li><input type="button" class="cd-button-no" value="No"></input></li>
                                                        </ul>
                                                        <a href="#0" class="cd-popup-close img-replace">Close</a>
                                                    </div>
                                                </div>
                                            </form>
                                            <?php } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="popup.js"></script>
</body>
</html>
