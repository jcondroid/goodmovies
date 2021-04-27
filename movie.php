<?php
$loadMovie = true;
isset($_GET['movie_id']) ? $movie_id = $_GET['movie_id'] : $movie_id = "";
include_once("header_page.php");
?>

<?php
    if($movie_id > 0) {
?>
    <div class="title_container">
        <div id="movie_title_<?=$movie_id?>" class="movie_title"></div>
        <hr style="width: 85%;">
    </div>
    <div id="movie_container_<?=$movie_id?>" class="movie_container">
        <div class="movie_info">
            <div id="poster_link_<?=$movie_id?>" class="poster_link"></div>
            <div class="movie_rating_container">
                My Rating: 
                <div class="background-stars">
                    <div class="unselected_stars">
                        <i id="rating1" class="fa fa-star" aria-hidden="true" style="cursor: pointer;" onclick="give_rating(<?=$movie_id?>, 1)"></i>
                        <i id="rating2" class="fa fa-star" aria-hidden="true" style="cursor: pointer;" onclick="give_rating(<?=$movie_id?>, 2)"></i>
                        <i id="rating3" class="fa fa-star" aria-hidden="true" style="cursor: pointer;" onclick="give_rating(<?=$movie_id?>, 3)"></i>
                        <i id="rating4" class="fa fa-star" aria-hidden="true" style="cursor: pointer;" onclick="give_rating(<?=$movie_id?>, 4)"></i>
                        <i id="rating5" class="fa fa-star" aria-hidden="true" style="cursor: pointer;" onclick="give_rating(<?=$movie_id?>, 5)"></i>
                    </div>
                </div>
            </div>
            <!-- <input type="number" value="0" max="5" min="1"><span class="percent">%</span> -->
            <div class="gm_average_movie_rating">
                Genre: <span id="genre_<?=$movie_id?>"></span>
            </div>
            <?php if(false) { ?>
            <div class="gm_average_movie_rating">
                Average Rating: 
            </div>
            <div class="tomato_average_movie_rating">
                TomatoMeter: 
            </div>
            <?php } ?>
        </div>
    </div>
<?php
    } else {
        header("location: index.php");
    }
// } else { // End isset person_id
//     header("location: index.php");
// }
?>

<script src="./javascript/person.js"></script>
<script src="./javascript/movie.js"></script>
</body>

