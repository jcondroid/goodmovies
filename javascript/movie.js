var person_id = null;
get_session();

/**
 * Gets movie details by movie_id to render the appropriate movie content.
 * Uses api.php and fetch to render the page
 * @param {int} movie_id 
 */
function get_movie(movie_id) {
    send_to_api("getmovie", null, movie_id);
}

/**
 * Leverages the api.php call to update or insert a new person_movie record and updates the ui
 * @param {int} movie_id 
 * @param {int} rating 
 */
function give_rating(movie_id, rating) {
    $(".fa-star").each(function () {
        $(this).css("color", "#b1b1b1c7");
    });

    for (var i = 1; i < rating + 1; i++) {
        document.getElementById("rating" + i).style.color = "#FFBC0B";
    }

    update_or_insert_rating(movie_id, rating);
}

/**
 * Uses api.php to send a request to either update or insert a record for person_movie. It will try to update first before inserting
 * @param {int} movie_id 
 * @param {int} rating 
 */
function update_or_insert_rating(movie_id, rating) {
    let url = "./api.php?action=insertpersonmovie&person_id=" + person_id + "&movie_id=" + movie_id + "&rating=" + rating;

    fetch(url)
        .then(function (response) {
        });
}

/**
 * Uses api.php and fetch to grab that person's person_movie record for a specified movie_id
 * @param {int} person_id 
 * @param {int} movie_id 
 */
function get_person_movie(person_id, movie_id) {
    send_to_api("getpersonmovie", person_id, movie_id);
}

/**
 * Main call to api.php using fetch
 * @param {string} action 
 * @param {int} person_id 
 * @param {int} movie_id 
 */
function send_to_api(action, person_id, movie_id) {
    let url = "./api.php?action=" + action + "&person_id=" + person_id + "&movie_id=" + movie_id;

    // I use fetch to grab all the data I need before I render the page
    fetch(url)
        .then((response) => response.json())
        .then(function (data) {
            if (action === "getmovie") {
                display_page(movie_id, data);
            } else if (action === "getpersonmovie") {
                console.log(data.data);
                if(data.data !== "") {
                    display_rating(data.data['rating']);
                } else {
                    display_rating();
                }
            } else {

            }
        });
}

/**
 * Uses json response from fetch to render the movie.php page
 * @param {int} movie_id 
 * @param {json} data 
 */
function display_page(movie_id, data) {
    results = data.data;
    let parent = document.getElementById("movie_container_" + movie_id);
    let titleParent = document.getElementById("movie_title_" + movie_id);

    // Width of each element is 180px
    var movie_info_div = document.createElement("div");
    movie_info_div.className = "movie_info";

    // Image
    let poster_link_div = document.getElementById("poster_link_" + movie_id);
    poster_link_div.style.backgroundImage = "url(\"" + results[1] + "\")";

    // Title
    var title_div = document.createElement("a");
    title_div.style.fontWeight = "bold";
    title_div.style.fontSize = "1.17em";

    var linkText = document.createTextNode(results[2]);
    title_div.appendChild(linkText);
    title_div.title = results[2];
    title_div.href = "./movie.php?movie_id=" + results[0];
    title_div.innerHTML = results[2];

    // Average Rating
    // var gmAvgRating = document.createElement("div");
    // gmAvgRating.className = "gm_average_movie_rating";
    // gmAvgRating.innerHTML = "Average Rating: ";

    // TomatoMeter
    // var tomatoMeterRating = document.createElement("div");
    // tomatoMeterRating.className = "tomato_average_movie_rating";
    // tomatoMeterRating.innerHTML = "TomatoMeter: ";

    // Description
    var description_div = document.createElement("div");
    description_div.className = "movie_description";
    description_div.innerHTML = "<div><b>Synopsis: </b>" + results[7] + "</div>";

    // Key Actors
    var key_actors_div = document.createElement("div");
    key_actors_div.className = "movie_key_actors";
    let actors = "";

    for(var i = 9; i < 13; i++) {
        if(i == 9) {
            actors = actors + results[i];
        } else {
            actors = actors + ", " + results[i];
        }
    }
    
    key_actors_div.innerHTML = "<div><b>Stars: </b>" + actors + "</div>";

    // Year
    var year_div = document.createElement("div");
    year_div.className = "movie_year";
    year_div.innerHTML = "<div><b>Release Year: </b>" + results[3] + "</div>";

    // Movie Length
    var duration_div = document.createElement("div");
    duration_div.className = "movie_duration";
    duration_div.innerHTML = "<div><b>Duration: </b>" + results[5] + "</div>";

    // Director
    var director_div = document.createElement("div");
    director_div.className = "movie_director";
    director_div.innerHTML = "<div><b>Director: </b>" + results[8] + "</div>";

    // See all the data that is available
    console.log("results: ", results);

    document.getElementById("genre_" + movie_id).innerHTML = results[6];
    get_person_movie(person_id, movie_id);
    titleParent.appendChild(title_div);
    director_div.appendChild(key_actors_div);
    director_div.appendChild(year_div);
    director_div.appendChild(duration_div);
    director_div.appendChild(description_div);
    parent.appendChild(director_div);
}

/**
 * Renders the person's rating by updating the star's color
 * @param {int} rating 
 */
function display_rating(rating) {
    for (var i = 1; i < Number(rating) + 1; i++) {
        document.getElementById("rating" + i).style.color = "#FFBC0B";
    }
    document.body.style.display = "block";
}

/**
 * We require that the session's person_id be set. Update person_id for all functions to use
 */
function get_session() {
    let url = "./session.php";

    fetch(url)
        .then((response) => response.json())
        .then(function (data) {
            person_id = data.data["person_id"];
        });
}