<?php
include_once("header_page.php");
?>

<?php
    if(isset($_SESSION['person_id'])) {
        isset($_SESSION['first_name']) ? $first_name = $_SESSION['first_name'] : $first_name = '';
        isset($_SESSION['last_name']) ? $last_name = $_SESSION['last_name'] : $last_name = '';
?>
    <div class="title_container">
        <div id="profile_title" class="movie_title">Edit Profile</div>
        <hr style="width: 85%;">
    </div>
    <div id="person_container_<?=$SESSION['person_id']?>" class="movie_container">
        <div id="person_info">
            <div class="profile_container">
                First Name* </br>
                <input placeholder="First Name" value="<?=$first_name?>"></input>
                </br>
                Last Name* </br>
                <input placeholder="Last Name" value="<?=$last_name?>"></input>
                </br>
                Gender
                <select>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Non-Binary</option>
                </select>
                </br>
                <button>Save</button>
            </div>
        </div>
    </div>
<?php
    } else {
        header("location: index.php");
    }
?>

<script src="./javascript/person.js"></script>
</body>

