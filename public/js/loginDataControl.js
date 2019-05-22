$loginUser = $("#txtUser");
$loginPass = $("#txtPassword");
$email = $("#txtEmail");
$user = $("#txtUserCad");
$pass = $("#txtPasswordCad");
$passRpt = $("#txtPasswordRepeat");

$login = $("#btnLogin");
$signup = $("#btnSingup");

$login.click(function (e) {
    e.preventDefault();

    invalid($loginUser, false);
    invalid($loginPass, false);

    $.ajax({
        method: 'POST',
        url: _URI_ + '/user/login',
        data: {
            user: $loginUser.val(),
            password: $loginPass.val()
        },
        error: function (e) {
            console.log(e);
        },
        statusCode: {
            401: function (e) {
                invalid($loginUser, true);
                invalid($loginPass, true);

            },
            200: function (e) {
                invalid($loginUser, false);
                invalid($loginPass, false);

                if (e == 1)
                    window.location = "/admin";
                else
                    window.location = "/client";
            }
        }
    });
});
