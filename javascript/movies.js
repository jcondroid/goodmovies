get_movies();

function send_to_api(action) {
    // console.log("send_to_api");
    let url = "./api.php?action=" + action;

    // var fetch_request = new Request(url, {
    //     method: "GET",
    //     headers: {
    //         "Accept": "application/json",
    //         "Content-Type": "application/json"
    //     }
    // });

    fetch(url)
        .then((response) => response.json())
        .then(function (data) {
            // console.log(data);
            results = data.data;
            let parent = document.getElementById("movies_container");
            
            // Width of each element is 180px

            for(var i = 0; i < 20; i++) {
                var movie_info_div = document.createElement("div");
                movie_info_div.className = "movie_info";

                var poster_link_div = document.createElement("div");
                poster_link_div.style.backgroundImage = "url(\"" + results[i][1] + "\")";
                poster_link_div.className = "poster_link";

                var title_div = document.createElement("a");
                title_div.style.fontWeight = "bold";
                title_div.style.fontSize = "1.17em";
                var linkText = document.createTextNode(results[i][2]);
                title_div.appendChild(linkText);
                title_div.title = results[i][2];
                title_div.href = "./movie.php?movie_id=" + results[i][0];
                title_div.innerHTML = results[i][2];

                var description_div = document.createElement("div");
                description_div.innerHTML = results[i][7];

                
                movie_info_div.appendChild(poster_link_div);
                movie_info_div.appendChild(title_div);
                movie_info_div.appendChild(description_div);
                
                parent.appendChild(movie_info_div);
                
                // document.getElementById("poster_link")
                // document.getElementById("movie_title")
            }
            // document.getElementById("poster_link").style.backgroundImage = "url(\"" + results[0][1] + "\")";
            // document.getElementById("movie_title").innerHTML = results[0][2];
        });
}

function get_movies() {
    send_to_api("getmovies");
}