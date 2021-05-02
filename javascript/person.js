$("#update_profile").submit(function (e) {
    e.preventDefault();
});

function send(that) {
    let person_id = that.person_id.value;
    let firstName = that.first_name.value;
    let lastName = that.last_name.value;
    let gender = that.gender.value;

    let url = "./api.php?action=updateperson&person_id=" + person_id
        + "&first_name=" + firstName
        + "&last_name=" + lastName
        + "&gender=" + gender;

    fetch(url)
        .then(function (response) {
            console.log(response);
            $("#update_successful").css("display", "inline-block");
        });
}

// console.log("triggered0");

// document.onload
function show_body(show_boolean) {
    console.log("triggered1");
    if (show_boolean) {
        
        document.body.style.display = "block"; // So it doesn't show elements moving
    }
}