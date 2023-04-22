function validateReg() {
    let username = document.getElementById('username').value;
    let password = document.getElementById('password').value;
    let email = document.getElementById('email').value;

    if (username == "" || password == "" || email == "") {
        alert("Fill in all the blanks!");
        return false;
    } else if (password.length < 6) {
        alert("Password must be more than 6 letters and/or numbers!");
        return false;
    } else if (!email.includes("@")) {
        alert("Incorrect email!");
        return false;
    } else {
        return true;
    }
}

function validateImg() {
    if (isset($_FILES['profile_img']) && $_FILES['profile_img']['error'] == 0) {
        return true;
    } else {
        return false;
    }
}
