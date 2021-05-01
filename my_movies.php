<?php
include_once("header_page.php");
?>

<?php
    if(isset($_SESSION['person_id'])) {
        $_SESSION['person_id'] ? $person_id = $_SESSION['person_id'] : $person_id = 0;
        $person_movies = get_person_movie_by_person_id($person_id);

        $movies_array = array();
        for($i = 0; $i < sizeof($person_movies); $i++) {
            $temp_array = array();
            $temp_array['movie_id'] = $person_movies[$i][2];
            $temp_array['rating'] = $person_movies[$i][3];
            // echo "</br>\$i = $i";
            // echo $person_movies[$i][2] . " - ";
            // echo $person_movies[$i][3];
            array_push($movies_array, $temp_array);
        }

        // print_r($movies_array);
        $movies_data_array = array();
        for($j = 0; $j < sizeof($movies_array); $j++) {
            $movies_data_array[$j] = get_movie_by_movie_id($movies_array[$j]['movie_id']);
        }

        // print_r($movies_data_array);
        
        // $person_array = array(
            // 'person_id' => $person[0], 'first_name' => $person[1], 'last_name' => $person[2], 'gender' => $person[3], 'email' => $person[4]
        // );
        // print_r($person_array);
        // isset($person_array['first_name']) ? $first_name = $person_array['first_name'] : $first_name = '';
        // isset($person_array['last_name']) ? $last_name = $person_array['last_name'] : $last_name = '';
        // isset($person_array['gender']) ? $gender = $person_array['gender'] : $gender = '';
?>
    <div class="title_container">
        <div id="profile_title" class="movie_title">My Movies</div>
        <hr style="width: 85%;">
    </div>
    
    <div class="person_movie_container" style="width: 100%; height: 50%;">
    <table class="my_movies_table">
            <tr>
                <th>cover</th>
                <th>title</th>
                <th>director</th>
                <!-- <th>avg rating</th> -->
                <th>my rating</th>
                <!-- <th>queue</th> -->
                <!-- <th>date watched</th> -->
            </tr>
            <?php
                for($i = 0; $i < sizeof($movies_data_array); $i++) {
                    echo "<tr>";
                    echo "<td><img src=\"".$movies_data_array[$i][1]."\" style=\"width: 100px;\"></td>";
                    echo "<td>".$movies_data_array[$i][2]."</td>";
                    echo "<td>".$movies_data_array[$i][8]."</td>";
                    // echo "<td>avg</td>";
                    echo "<td>".$movies_array[$i]['rating']."</td>";
                    // echo "<td>queue</td>";
                    // echo "<td>date watched</td>";
                    // $movies_data_array[$j] = get_movie_by_movie_id($movies_array[$j]['movie_id']);
                    echo "</tr>";
                }

            ?>
            <!-- <tr>
                <td>cover</td>
                <td>title</td>
                <td>director</td>
                <td>avg rating</td>
                <td>my rating</td>
                <td>queue</td>
                <td>date watched</td>
            </tr> -->
    </table>
    </div>
    
<?php
    } else {
        header("location: index.php");
    }
?>

<!-- <script src="./javascript/person.js"></script> -->
<!-- </body> -->
<?php include 'footer.php'; ?>