<?php
include_once("header_page.php");
?>

<?php
    if(isset($_SESSION['person_id'])) {
        $_SESSION['person_id'] ? $person_id = $_SESSION['person_id'] : $person_id = 0;
        isset($_SESSION['first_name']) ? $first_name = $_SESSION['first_name'] : $first_name = '';
        isset($_SESSION['last_name']) ? $last_name = $_SESSION['last_name'] : $last_name = '';
        isset($_SESSION['last_name']) ? $last_name = $_SESSION['last_name'] : $last_name = '';
?>
    <div class="title_container">
        <div id="profile_title" class="movie_title">Edit Profile</div>
        <hr style="width: 85%;">
    </div>
    <div id="edit_person_<?=$person_id?>" class="profile_container">
        <div id="person_container_<?=$person_id?>" class="person_container">
            <div id="person_info">
                <div class="profile_container">
                    <form method="post" action="person.php">
                        <div>First Name*</div>
                        <input placeholder="First Name" value="<?=$first_name?>"></input>
                        </br></br>
                        <div>Last Name*</div>
                        <input placeholder="Last Name" value="<?=$last_name?>"></input>
                        </br></br>
                        <div>Gender</div>
                        <select>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Non-Binary</option>
                        </select>
                        </br></br>
                        <div><button>Save</button></div>
                    </form>
                </div>
            </div>
        </div>
        <div id="photo_container_<?=$person_id?>" class="person_container">
            <div id="person_info">
                <div class="profile_container">
                    <form method="post" action="person.php">
                        <div></div>
                        </br></br>
                        <div><button>Upload Photo</button></div>
                        <div><a href="delete_account.php">delete account</a></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
    } else {
        header("location: index.php");
    }
?>

<!-- <script src="./javascript/person.js"></script> -->
<!-- </body> -->
<?php include 'footer.php'; ?>

