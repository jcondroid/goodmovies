<?php
include_once("header_page.php");
?>

<?php
    if(isset($_SESSION['person_id'])) { // Session person id must exist
        $_SESSION['person_id'] ? $person_id = $_SESSION['person_id'] : $person_id = 0;
        $person_movies = get_person_movie_by_person_id($person_id);

        // Make an array of arrays for each movie the person has rated
        $movies_array = array();
        for($i = 0; $i < sizeof($person_movies); $i++) {
            $temp_array = array();
            $temp_array['movie_id'] = $person_movies[$i][2];
            $temp_array['rating'] = $person_movies[$i][3];
            array_push($movies_array, $temp_array);
        }

        $movies_data_array = array();
        for($j = 0; $j < sizeof($movies_array); $j++) {
            $movies_data_array[$j] = get_movie_by_movie_id($movies_array[$j]['movie_id']);
        }
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
                // Display a row for each movie the person has rated
                for($i = 0; $i < sizeof($movies_data_array); $i++) {
                    echo "<tr>";
                    echo "<td><a href=\"./movie.php?movie_id=".$movies_data_array[$i][0]."\">"
                    ."<img src=\"".$movies_data_array[$i][1]."\" style=\"width: 100px;\"></a></td>"; // Photo
                    echo "<td><a href=\"./movie.php?movie_id=".$movies_data_array[$i][0]."\">".$movies_data_array[$i][2]."</a></td>"; // Title
                    echo "<td>".$movies_data_array[$i][8]."</td>"; // Director
                    // echo "<td>avg</td>";
                    echo "<td>".$movies_array[$i]['rating']."</td>"; // My rating
                    // echo "<td>queue</td>";
                    // echo "<td>date watched</td>";
                    // $movies_data_array[$j] = get_movie_by_movie_id($movies_array[$j]['movie_id']);
                    echo "</tr>";
                }

            ?>
    </table>
    </div>
    
<?php
    } else { // No Session person id? Then navigate to index.php
        header("location: index.php");
    }
?>

<?php include 'footer.php'; ?>