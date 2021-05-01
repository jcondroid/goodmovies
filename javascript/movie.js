var person_id = null;
get_session();

function get_movie(movie_id) {
    send_to_api("getmovie", null, movie_id);
}

function give_rating(movie_id, rating) {
    // console.log("giving rating " + rating + " for " + movie_id);
    
    $(".fa-star").each(function(){ 
        $(this).css("color", "#b1b1b1c7");
    });

    for(var i = 1; i < rating + 1; i++) {
        document.getElementById("rating" + i).style.color = "#FFBC0B";
    }

    update_or_insert_rating(movie_id, rating);
}

function update_or_insert_rating(movie_id, rating) {
    let url = "./api.php?action=insertpersonmovie&person_id=" + person_id + "&movie_id=" + movie_id + "&rating=" + rating;

    fetch(url)
        .then(function(response) {
            // console.log("okd", response); 
        });
}

function get_person_movie(person_id, movie_id) {
    // console.log("person_id = ", person_id);
    send_to_api("getpersonmovie", person_id, movie_id);
}

function send_to_api(action, person_id, movie_id) {
    // console.log("send_to_api");
    // let url = "./api.php?action=" + action + "&movie_id=" + movie_id;
    let url = "./api.php?action=" + action + "&person_id=" + person_id + "&movie_id=" + movie_id;

    fetch(url)
        .then((response) => response.json())
        .then(function (data) {
            if(action === "getmovie") {
                display_page(movie_id, data);
            } else if(action === "getpersonmovie") {
                // console.log("hereeeeeeeeeeeeeeeeeeeeeeeeeee");
                // console.log("get_person_movie_api_call: ", data.data['rating']);
                display_rating(data.data['rating']);
            } else {

            }
        });
}

function display_page(movie_id, data) {
    // console.log(data);
    results = data.data;
    let parent = document.getElementById("movie_container_"+movie_id);
    let titleParent = document.getElementById("movie_title_"+movie_id);
    
    
    // Width of each element is 180px
    var movie_info_div = document.createElement("div");
    movie_info_div.className = "movie_info";

    // Image
    // var poster_link_div = document.createElement("div");
    // poster_link_div.style.backgroundImage = "url(\"" + results[1] + "\")";
    // poster_link_div.id = "poster_link";
    let poster_link_div = document.getElementById("poster_link_"+movie_id);
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
    

    // Rating
    // var myRating = document.createElement("div");
    // myRating.className = "movie_rating_container";
    // myRating.innerHTML = "My Rating: <img src=\"./resources/stars.png\">";

    // Average Rating
    var gmAvgRating = document.createElement("div");
    gmAvgRating.className = "gm_average_movie_rating";
    gmAvgRating.innerHTML = "Average Rating: ";

    // TomatoMeter
    /*
    var tomatoMeterRating = document.createElement("div");
    tomatoMeterRating.className = "tomato_average_movie_rating";
    tomatoMeterRating.innerHTML = "TomatoMeter: ";
    */
    // Description
    var description_div = document.createElement("div");
    description_div.className = "move_description";
    description_div.innerHTML = results[7];
    
    document.getElementById("genre_"+movie_id).innerHTML = results[6];

    
    get_person_movie(person_id, movie_id);

    
    titleParent.appendChild(title_div);
    // movie_info_div.appendChild(poster_link_div);
    // movie_info_div.appendChild(myRating);
    // movie_info_div.appendChild(gmAvgRating);
    // movie_info_div.appendChild(tomatoMeterRating);
    
    parent.appendChild(movie_info_div);
    parent.appendChild(description_div);
}

function display_rating(rating) {
    // console.log("display rating: ", rating);
    for(var i = 1; i < Number(rating) + 1; i++) {
        // console.log("i ", i);
        document.getElementById("rating" + i).style.color = "#FFBC0B";
    }
}

function get_session() {
    // console.log("get_session");
    let url = "./session.php";

    fetch(url)
        .then((response) => response.json())
        .then(function (data) {
            // console.log(data);
            // results = data.data;
            // console.log(results);
            person_id = data.data["person_id"];
        });
}