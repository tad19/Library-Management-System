function Loginbtn(e){

    let username = document.getElementById("usernameInput").value;
    let password = document.getElementById("passwordInput").value;
    let error = document.getElementById("loginError");

    if(username === "" || password === ""){
        
        e.preventDefault();

        error.textContent = "Please fill both username and password.";
    }
}