function profile() {
    if (localStorage.getItem("email")) {
        $(document).ready(function () {
            $.post('http://localhost/Guvi/php/profile.php',
                {
                    email: localStorage.getItem("email"),
                },
                function (data, status) {
                    console.log(data["name"]);
                    var obj = jQuery.parseJSON(data["name"]);
                    console.log(obj);
                    document.getElementById("name").innerHTML = obj.name;
                    document.getElementById("age").innerHTML = obj.age;
                    document.getElementById("email").innerHTML = obj.email;
                    document.getElementById("mobile").innerHTML = obj.mobile;
                }
            );
        })
    }
    else {
        window.location.replace("http://localhost/Guvi/login.html");
    }

}
function logout() {
    localStorage.removeItem("email");
    window.location.replace("http://localhost/Guvi/login.html");

}