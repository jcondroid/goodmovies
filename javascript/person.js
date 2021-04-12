function send_to_api(action, email, password, person_id) {
    console.log("send_to_api");
    let url = "./api.php?action=" + action + "&person_id=" + person_id;

    var data_payload = JSON.stringify({
        "email": email,
        "pass_word": password
    });

    var fetch_request = new Request(url, {
        method: "POST",
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json"
        }, 
        body: data_payload
    });

    fetch(fetch_request)
        .then((response) => response.json())
        .then(function(data) {
            console.log(data);
        });
}

