<?php

if (session_status() == PHP_SESSION_NONE) session_start();
if (isset($_GET['join']) && isset($_SESSION['currentUser']['username'])) {
?>

    <script>
        var serverId = "<?= $_GET['join'] ?>";
        console.log("received join id: <?= $_GET['join'] ?>");

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);
                if (response.status == "success") {
                    window.location = "./home.php"
                    console.log(response);
                } else {
                    console.error(response);
                    alert("Something bad happend: check console")
                }
            }
        };

        xhttp.open("POST", "../controller/jsToPhp/joinServer.php", true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var params = "serverId=" + encodeURIComponent(serverId);
        xhttp.send(params);
    </script>

<?php
} else if (isset($_SESSION['currentUser']['username']) && !isset($_GET['join'])) {
    header('Location: ./home.php');
}
include './controller/index.php';
