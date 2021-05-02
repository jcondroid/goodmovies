<?php
include_once("header_page.php");
?>

<?php
    if(isset($_SESSION['person_id'])) { // Session Person id must exists
        $_SESSION['person_id'] ? $person_id = $_SESSION['person_id'] : $person_id = 0; // set $person_id
        $person = get_person_by_person_id($person_id); // get and set $person data
        
        $person_array = array(
            'person_id' => $person[0], 'first_name' => $person[1], 'last_name' => $person[2], 'gender' => $person[3], 'email' => $person[4]
        );

        isset($person_array['first_name']) ? $first_name = $person_array['first_name'] : $first_name = '';
        isset($person_array['last_name']) ? $last_name = $person_array['last_name'] : $last_name = '';
        isset($person_array['gender']) ? $gender = $person_array['gender'] : $gender = '';
?>
    <div class="title_container">
        <div id="profile_title" class="movie_title">Edit Profile</div>
        <hr style="width: 85%;">
    </div>
    
    <div id="edit_person_<?=$person_id?>" class="profile_container" style="width: 100%; height: 50%;">
        <form id="update_profile" onsubmit="send(this)" method="post" class="profile_container" style="height: 100%; width: 100%;">
            <div id="person_container_<?=$person_id?>" class="person_container">
                <div id="person_info">
                    <div class="profile_input_container">
                            <div>First Name*</div>
                            <input id="first_name_<?=$first_name?>" placeholder="First Name" name="first_name" type="text" value="<?=$first_name?>"></input>
                            </br></br>
                            <div>Last Name*</div>
                            <input placeholder="Last Name" name="last_name" type="text" value="<?=$last_name?>"></input>
                            </br></br>
                            <div>Gender</div>
                            <select name="gender">
                                <?php
                                // If gender is set then show that gender as the selected option
                                switch($gender) {
                                    case "1":
                                        echo "<option value=\"1\" selected>Male</option>";
                                        echo "<option value=\"2\"> Female</option>";
                                        echo "<option value=\"3\">Non-Binary</option>";
                                        break;
                                    case "2":
                                        echo "<option value=\"1\">Male</option>";
                                        echo "<option value=\"2\" selected> Female</option>";
                                        echo "<option value=\"3\">Non-Binary</option>";
                                        break;
                                    case "3":
                                        echo "<option value=\"1\">Male</option>";
                                        echo "<option value=\"2\"> Female</option>";
                                        echo "<option value=\"3\" selected>Non-Binary</option>";
                                        break;
                                    default:
                                        echo "<option value=\"0\">Select</option>";
                                        echo "<option value=\"1\">Male</option>";
                                        echo "<option value=\"2\"> Female</option>";
                                        echo "<option value=\"3\">Non-Binary</option>";
                                    break;
                                }
                                ?>
                            </select>
                            </br></br>
                            <div>
                                <button input-type="submit">Save</button>
                                <p id="update_successful" class="alert-success" style="display: none; margin: 0;">saved</p>
                            </div>
                    </div>
                </div>
            </div>
            <div id="photo_container_<?=$person_id?>" class="person_container">
                <div id="person_info">
                    <div class="profile_input_container">
                            <input name="person_id" value="<?=$person_id?>" type="hidden"></input>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
<?php
    } else { // No Session person id? Then navigate to the index page
        header("location: index.php");
    }
?>

<?php include 'footer.php'; ?>