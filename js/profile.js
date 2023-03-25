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
                        console.log(da.name);
                        document.getElementById("sname").innerHTML = da.name;
                        document.getElementById("sage").innerHTML = da.age;
                        document.getElementById("smail").innerHTML = da.email;
                        document.getElementById("smob").innerHTML = da.mobile;
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

function updateuser() {
    //var edemail = document.getElementsByName("email")[0].value;
    var edage = document.getElementsByName("age")[0].value;
    var eddob = document.getElementsByName("dob")[0].value;
    var edmobileno = document.getElementsByName("mobile")[0].value;
    var edname = document.getElementsByName("name")[0].value;
    const emaiPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;


    $(document).ready(function () {
        $.ajax({
            url: 'http://localhost/Guvi/php/profile.php',
            type: "POST",
            data: {
                name: edname,
                mobile: edmobileno,
                dob: eddob,
                age: edage,
                oldem: localStorage.getItem("email"),
                isup: true
            },
            success: function (data, status) {
                var da = jQuery.parseJSON(data);
                console.log(da.name);
                document.getElementById("sname").innerHTML = da.name;
                document.getElementById("sage").innerHTML = da.age;
                document.getElementById("smail").innerHTML = da.email;
                document.getElementById("smob").innerHTML = da.mobile;
                if (status == "success") {
                    alert("Updated Successfully")
                }
                else if (status == "failed") {
                    alert("Updated Failed");
                    window.location.replace("http://localhost/Guvi/profile.html");
                }
            }
        });
    });

}