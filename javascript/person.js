$("#update_profile").submit(function (e) {
    e.preventDefault();
});

/**
 * If user clicks Save on profile.php and "that" is all of the submitted form data
 * Use "that" form data to send a request to update person using api.php and fetch
 * @param {form} that 
 */
function send(that) {
    let person_id = that.person_id.value;
    let firstName = that.first_name.value;
    let lastName = that.last_name.value;
    let gender = that.gender.value;

    let url = "./api.php?action=updateperson&person_id=" + person_id
        + "&first_name=" + firstName
        + "&last_name=" + lastName
        + "&gender=" + gender;

    // TODO: If update fails then render an alert on the page the the update was not successful
    fetch(url)
        .then(function (response) {
            $("#update_successful").css("display", "inline-block");
        });
}

/**
 * This function was required because we want to use a different function to render the body for movie.js
 * This helps ensure elements are not moving around while the page is loading
 * @param {boolean} show_boolean 
 */
function show_body(show_boolean) {
    if (show_boolean) {
        
        document.body.style.display = "block"; // So it doesn't show elements moving
    }
}