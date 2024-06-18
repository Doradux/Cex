<div class="serverOptions">
    <?= ($role == 'admin') ? '<a id="server-settings" href="">Server settings</a>' : '' ?>
    <a id="show-members-page">Members</a>
    <a id="invite-ppl">Copy server link</a>
    <a id="leaveServer">Leave server</a>
</div>

<style>
    .serverOptions {
        background-color: rgb(20, 20, 20);

        & a {
            cursor: pointer;
        }
    }
</style>

<script>
    var invitePpl = document.getElementById("invite-ppl");
    invitePpl.addEventListener("click", function() {
        var link = "https://driving-oralle-cex-1b62d5bf.koyeb.app/?join=<?= $_SESSION['currentServer']['dinamicId'] ?>";
        navigator.clipboard.writeText(link);
    });
</script>