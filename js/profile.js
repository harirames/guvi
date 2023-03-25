function profile() {
    if (localStorage.getItem("email")) {
        $(document).ready(function () {
            $.ajax
                ({
                    url: 'http://localhost/Guvi/php/profile.php',
                    type: "POST",
                    data: {
                        email: localStorage.getItem("email"),
                    },
                    success: function (data, status) {
                        var da = jQuery.parseJSON(data);
                        document.getElementById("sname").innerHTML = "Hi," + da.name;
                        document.getElementById("sage").innerHTML = "Age:" + da.age;
                        document.getElementById("smail").innerHTML = "Email:" + da.email;
                        document.getElementById("smob").innerHTML = "Mobile:" + da.mobile;
                    }
                });
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
