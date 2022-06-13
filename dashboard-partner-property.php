<?php
// Initialize the session
session_start();
include('functions.php');

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

$property = $table->getProperty($_SESSION['partnerid']);
$category = $table->getCategory();



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Property</title>
    <link rel="stylesheet" href="style-dashboard.css">
    <link rel="icon" href="images/icon.png">
    <script src="https://kit.fontawesome.com/6ee19359d3.js" crossorigin="anonymous"></script>
    

    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
    
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
                    <a href="dashboard-partner-property.php" class="active"><span class="fas fa-home"></span>
                    <span>Property</span></a>
                </li>
                <li>
                    <a href="dashboard-partner-rooms.php"><span class="fas fa-door-open"></span>
                    <span>Rooms</span></a>
                </li>
                <li>
                    <a href="dashboard-partner-applicants.php"><span class="fas fa-file-alt"></span>
                    <span>Applicants</span></a>
                </li>
                <li>
                    <a href=""><span class="fas fa-user-circle"></span>
                    <span>Accounts</span></a>
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
                    Property
                </label>

                
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

                
                <!-- Add Unit -->
                <div class="units-wrapper">
                    <h2>Add Property</h2>
                    <form action="include/add-units-inc.php" id="postForm" method="post" enctype="multipart/form-data">
                        <div class="form-step form-step-active w3-animate-fading w3-animate-opacity">
                            <h1>Name and Type</h1>
                            <p class="p-med">What is the name of your property?</p>
                            <div class="input-group">
                                <label for="propertyName">Property name</label>
                                <input type="text" name="propertyName" id="propertyName">
                            </div>
                            <div class="input-group">
                                <label for="property_name">Property type</label>
                                <div class="select">
                                    <select name="categoryID" id="select_cat">
                                        <option selected disabled="">Choose unit type below</option>
                                        <?php
                                        foreach($category as $cat){
                                            echo "<option value='".$cat['id']."' >".$cat['category_name']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="">
                                <a href="#" class="btn btn-next width-50 ml-auto"><span>Continue</span></a>
                            </div>
                            <hr class="line">
                        </div>
                        <div class="form-step w3-animate-right w3-animate-opacity">
                            <h1>Location</h1>
                            <p class="p-med">Where is your property located?</p>
                            <div class="input-group">
                                <label>Region</label>
                                <input type="hidden" name="regionSelected"/>
                                <div class="select">
                                    <select name="region" id="region">
                                        <option selected disabled="">Choose below</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group">
                                <label>Province</label>
                                <input type="hidden" name="provinceSelected"/>
                                <div class="select">
                                    <select name="province" id="province">
                                        <option selected disabled="">Choose below</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group">
                                <label>City</label>
                                <input type="hidden" name="citySelected"/>
                                <div class="select">
                                    <select name="city" id="city">
                                        <option selected disabled="">Choose below</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group">
                                <label>Barangay</label>
                                <input type="hidden" name="barangaySelected"/>
                                <div class="select">
                                    <select name="barangay" id="barangay">
                                        <option selected disabled="">Choose below</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group">
                                <label>Postal Code</label>
                                <input type="text" name="postal">
                            </div>
                            <div class="btn-group">
                                <a href="#" class="btn btn-prev"><span>Back</span></a>
                                <a href="#" class="btn btn-next"><span>Continue</span></a>
                            </div>
                        </div>
                        <div class="form-step w3-animate-right">
                            <h1>Map</h1>
                            <p class="p-med">Set location on the map.</p>
                            <div class="input-group">
                                <label>Pinpoint your property</label>
                                <div id="googleMap" style="width:320px;height:450px;"></div>
                            </div>
                            <div class="btn-group">
                                <a href="#" class="btn btn-prev"><span>Back</span></a>
                                <a href="#" class="btn btn-next"><span>Continue</span></a>
                            </div>
                        </div>
                        <div class="form-step w3-animate-right">
                            <h1>Criteria</h1>
                            <p class="p-med">Who can lease here?</p>
                            <div class="input-group">
                                <label>Available for</label>
                                <div class="select">
                                    <select name="availableFor" id="select_cat">
                                    <option selected disabled="">Choose below</option>
                                        <option value=0>Female</option>
                                        <option value=1>Male</option>
                                        <option value=2>Both</option>
                                    </select>
                                </div>
                            </div>
                            <div class="btn-group">
                                <a href="#" class="btn btn-prev"><span>Back</span></a>
                                <button type="submit" name="submit" class="btn"><span>Add</span></button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Add Unit -->
                
                <!-- Added Units Table -->
                <div class="units-wrapper">
                    <div class="units">
                        <div class="card">
                            <div class="card-header">
                                <h3>Added Units</h3>
                                <button>See all <span class=""fas fa-arrow-right></span></button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table width="100%">
                                        <thead>
                                            <tr>
                                                <td>Unit Name</td>
                                                <td>Category Type</td>
                                                <td>Address</td>
                                                <td>Tenants</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Fetch category
                                            foreach($property as $properties){
                                            ?>
                                            <tr>
                                                <td class="text-center"><?php echo $properties['property_name']?></td>
                                                <td class="text-center"><?php echo $properties['category_name']?></td>
                                                <td class="text-center"><?php echo $properties['barangay'].", ".$properties['city'].", ".$properties['province']?></td>
                                                <td class="text-center"></td>
                                                <td class="text-center">
                                                    <button class="cd-popup-trigger-update action button-approve update-property" type="button" data-property_id="<?php echo $properties['property_id'] ?>" data-property_name="<?php echo $properties['property_name'] ?>" data-property_category="<?php echo $properties['category_id'] ?>" data-property_region="<?php echo $properties['region'] ?>" data-property_province="<?php echo $properties['province'] ?>" data-property_city="<?php echo $properties['city'] ?>" data-property_barangay="<?php echo $properties['barangay'] ?>" data-property_postal="<?php echo $properties['postal'] ?>" data-property_availablefor="<?php echo $properties['available_for'] ?>">Edit</button>
                                                    <button class="cd-popup-trigger action button-cancel" type="button">Delete</button>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <form class="popup-del" action="include/delete-property-inc.php" method="post">
                                                <div class="cd-popup" role="alert">
                                                    <div class="cd-popup-container">
                                                        <p>Are you sure you want to delete this property?</p>
                                                        <ul class="cd-buttons" style="list-style: none;">
                                                            <input type="hidden" name="property_id" value=<?php echo $properties['property_id'] ?>>
                                                            <li><input name="submit" type="submit" class="cd-button-yes" value="Yes"></input></li>
                                                            <li><input type="button" class="cd-button-no" value="No"></input></li>
                                                        </ul>
                                                        <a href="#0" class="cd-popup-close img-replace">Close</a>
                                                    </div>
                                                </div>
                                            </form>
                                            <form class="popup-update" action="include/update-property-inc.php" method="post" id="manage-property">
                                                <div class="cd-popup-update" role="alert">
                                                    <div class="cd-popup-container">
                                                        <p>Press update to save the changes.</p>
                                                        <input type="hidden" name="propertyID_updt" id="propertyID_updt">
                                                        <div class="input-group">
                                                            <label for="propertyName_updt">Property name</label>
                                                            <input type="text" name="propertyName_updt" id="propertyName_updt">
                                                        </div>
                                                        <div class="input-group">
                                                            <label for="categoryID_updt">Property type</label>
                                                            <div class="select">
                                                                <select name="categoryID_updt" id="categoryID_updt">
                                                                    <option selected disabled="">Choose unit type below</option>
                                                                    <?php
                                                                    foreach($category as $cat){
                                                                        echo "<option value='".$cat['id']."' >".$cat['category_name']."</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="input-group">
                                                            <label>Region</label>
                                                            <input type="text" name="region_updt" id="region_updt">
                                                        </div>
                                                        <div class="input-group">
                                                            <label>Province</label>
                                                            <input type="text" name="province_updt" id="province_updt">
                                                        </div>
                                                        <div class="input-group">
                                                            <label>City</label>
                                                            <input type="text" name="city_updt" id="city_updt">
                                                        </div>
                                                        <div class="input-group">
                                                            <label>Barangay</label>
                                                            <input type="text" name="barangay_updt" id="barangay_updt">
                                                        </div>
                                                        <div class="input-group">
                                                            <label>Postal Code</label>
                                                            <input type="text" name="postal_updt" id="postal_updt">
                                                        </div>
                                                        <div class="input-group">
                                                            <label>Available for</label>
                                                            <div class="select">
                                                                <select name="availableFor_updt" id="availableFor_updt">
                                                                    <option selected disabled value="">Choose below</option>
                                                                    <option value=0>Female</option>
                                                                    <option value=1>Male</option>
                                                                    <option value=2>Both</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <ul class="cd-buttons" style="list-style: none;">
                                                            <input type="hidden" name="property_id" value=<?php echo $properties['property_id'] ?>>
                                                            <li><input name="submit" type="submit" class="cd-button-yes" value="Update"></input></li>
                                                            <li><input type="button" class="cd-button-no" value="Cancel"></input></li>
                                                        </ul>
                                                        <a href="#0" class="cd-popup-close img-replace">Close</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Added Units Table -->


            </div>
        </main>
    </div>
<script type="text/javascript" src="jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="multi-step.js"></script>
<script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations-v1.0.0.js"></script>
<script src="popup.js"></script>

</body>
</html>
<script>
    function myMap() {
    var mapProp= {
    center:new google.maps.LatLng(13.425138, 123.416348),
    zoom:15,
    };
    var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
    }

    $(document).ready(function(){
        var my_handlers = {

        fill_provinces:  function(){

            var region_code = $(this).val();
            $('#province').ph_locations('fetch_list', [{"region_code": region_code}]);

            var selected_caption = $("#region option:selected").text();
            $('input[name=regionSelected]').val(selected_caption);
        },

        fill_cities: function(){

            var province_code = $(this).val();
            $('#city').ph_locations( 'fetch_list', [{"province_code": province_code}]);

            var selected_caption = $("#province option:selected").text();
            $('input[name=provinceSelected]').val(selected_caption);
        },


        fill_barangays: function(){

            var city_code = $(this).val();
            $('#barangay').ph_locations('fetch_list', [{"city_code": city_code}]);

            var selected_caption = $("#city option:selected").text();
            $('input[name=citySelected]').val(selected_caption);
        },

        fill: function(){

            var selected_caption = $("#barangay option:selected").text();
            $('input[name=barangaySelected]').val(selected_caption);
        }
        };

        $(function(){
            $('#region').on('change', my_handlers.fill_provinces);
            $('#province').on('change', my_handlers.fill_cities);
            $('#city').on('change', my_handlers.fill_barangays);
            $('#barangay').on('change', my_handlers.fill);

            $('#region').ph_locations({'location_type': 'regions'});
            $('#province').ph_locations({'location_type': 'provinces'});
            $('#city').ph_locations({'location_type': 'cities'});
            $('#barangay').ph_locations({'location_type': 'barangays'});

            $('#region').ph_locations('fetch_list');

            
        });

        

        

    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2sNcPDWAoQvjzAITWb0p4J03SBSNnGmA&callback=myMap"></script>
