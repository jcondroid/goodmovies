$("#update_profile").submit(function(e) {
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

    // var data_payload = JSON.stringify({
    //     "first_name": firstName,
    //     "last_name": lastName,
    //     "gender": gender,
    // });

    // var fetch_request = new Request(url, {
    //     method: "POST",
    //     headers: {
    //         "Accept": "application/json",
    //         "Content-Type": "application/json"
    //     }, 
    //     body: data_payload
    // });

    fetch(url)
    // .then((response) => response.json())
    .then(function(response) {
        console.log(response);
        $("#update_successful").css("display", "inline-block");
    });
    // fetch(form.action, {method:'post', body: new FormData(form)});
    // alert("Data: " + firstName + ", " + lastName + ". " + gender);
    // await sleep(5000);
    // alert("Data: " + firstName + ", " + lastName + ". " + gender);
    // console.log('We send post asynchronously (AJAX)', form);
    // e.prthatDefault();
  }

// $('#update_profile').submit(function() { 
//     console.log($('#searchTerm').val());
//     return false;
// });

// function save(firstName, lastName, gender, person_id) {
//     console.log("send_to_api");
//     let url = "./api.php?action=" + action + "&person_id=" + person_id;

//     var data_payload = JSON.stringify({
//         "email": email,
//         "pass_word": password
//     });

    // var fetch_request = new Request(url, {
    //     method: "POST",
    //     headers: {
    //         "Accept": "application/json",
    //         "Content-Type": "application/json"
    //     }, 
    //     body: data_payload
    // });

    // fetch(fetch_request)
    //     .then((response) => response.json())
    //     .then(function(data) {
    //         console.log(data);
    //     });
// }

// $(document).ready(function(){
//     var $form = $('form');

//     $form.submit(function(){
//        $.post($(this).attr('action'), $(this).serialize(), function(response){
            // $("#update_successful").css("display", "inline-block");
//             alert("stop");
//        },'json');
//        return false;
//     });
//  });

// $('form').live('submit', function(){
//     $.post($(this).attr('action'), $(this).serialize(), function(response){
//           $("#update_successful").css("display", "inline-block");
//           alert("stop");
//     },'json');
//     return false;
//  });