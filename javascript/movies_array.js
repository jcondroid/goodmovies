get_movies_array();

function get_movies_array() {
    console.log("get_movies_array");
    let url = "./api.php?action=getmoviesarray";

    fetch(url)
        .then((response) => response.json())
        .then(function (data) {
            // console.log(data);
            results = data.data;
            console.log(results);
            // Constructing the suggestion engine
            // var Bloodhound = require('bloodhound-js');
            var movies = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: cars
            });
            // let parent = document.getElementById("movies_container");
            
            // Width of each element is 180px

            // for(var i = 0; i < 20; i++) {
            // }
            // document.getElementById("poster_link").style.backgroundImage = "url(\"" + results[0][1] + "\")";
            // document.getElementById("movie_title").innerHTML = results[0][2];
        });
}