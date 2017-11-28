function ola() {
    $(".menu").toggle();
    $(".acess").css("z-index","3");
}

function show(show, hide1, hide2) {
	$(show).css("background-color", "#BA55D3");
    $(hide1).css("background-color", "#FFFFFF");
    $(hide2).css("background-color", "#FFFFFF");
}

			function logout(){
			                    $.ajax({
                        type: "POST",
                        url: "login.php",
                        data: {functionName: "logout"},
                        success: function (data) {
							var url = 'login.html';
							window.location.href = url;
                        }
                    });
			}
