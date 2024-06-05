<!-- add chanel in selected group utility -->
<div id="postChanelUtility">
    <input type="hidden" name="chanelGroupIdToPost" id="chanelGroupIdToPost" value="">
    <input class="inputPostChanel" type="text" placeholder="Chanel name" name="chanelNameToPost" id="chanelNameToPost">
    <input class="inputPostChanel" type="text" placeholder="Chanel description" name="chanelDescriptionToPost" id="chanelDescriptionToPost">
    <p style="color: white;" class="big aux">CHANEL TYPE</p>
    <div name="chanelTypeToPost" id="chanelTypeToPost">
        <div id="typeHider">
            <p id="typeEmoji">📖</p>
        </div>
        <p value="text">Text chanel</p>
        <p value="voice">Voice chanel</p>
    </div>
    <div>
        <input type="hidden" name="groupId" id="groupId" value="none">
        <button class="confirm big" id="createChanelInGroup">CREATE</button>
        <button class="cancel big" id="CancelcreateChanelInGroup">CANCEL</button>
    </div>
</div>

<style>
    @font-face {
        font-family: "poppins";
        src: url("../assets/fonts/Poppins-Regular.ttf");
        font-weight: normal;
        font-style: normal;
    }

    @font-face {
        font-family: "poppins_bold";
        src: url("../assets/fonts/Poppins-Bold.ttf");
        font-weight: normal;
        font-style: normal;
    }

    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        /* border: 1px solid black; */
        font-family: "poppins";
    }

    #postChanelUtility {
        background-color: rgb(50, 50, 50);
        width: 400px;
        display: none;
        position: absolute;
        top: 35%;
        right: 40%;
        padding: 10px;
        flex-direction: column;
        border-radius: 10px;
        gap: 5px;
    }

    #postChanelUtility div {
        display: flex;
        gap: 5px;
    }

    #postChanelUtility div button {
        width: 100%;
    }

    #chanelTypeToPost {
        display: flex;
        justify-content: space-around;
        background-color: rgba(0, 0, 0, 0.5);
        width: 86%;
        margin: auto;
        border-radius: 12px;
        margin-top: 10px;
        margin-bottom: 20px;
        cursor: pointer;
        user-select: none;
        color: white;
    }

    #typeHider {
        width: 45%;
        position: absolute;
        background-color: white;
        border-radius: 10px;
        /* left: 37px; */
        left: 184px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.5s ease;
    }

    #typeEmoji {
        transition: transform 1s ease;
    }

    .confirm {
        border: none;
        border-radius: 4px;
        background-color: rgba(0, 180, 217, 1);
    }

    .confirm:hover {
        background-color: rgb(37, 212, 247);
    }

    .cancel {
        border: none;
        border-radius: 4px;
        background-color: crimson;
        color: white;
    }

    .cancel:hover {
        background-color: rgb(124, 11, 34);
        border: none;
    }

    .inputPostChanel {
        border: none;
        background-color: rgba(0, 0, 0, 0.5);
        padding: 10px 5px 10px 5px;
        color: white;
        border-radius: 4px;
    }

    .inputPostChanel:focus {
        outline: none;
    }

    .big {
        font-family: 'poppins_bold';
    }

    .aux {
        transform: translateY(12px);
        text-align: center;
    }
</style>

<script>
    var groupId = document.getElementById('groupId');
    //display chanel adder (server view)
    var addChanelUtility = document.getElementById("postChanelUtility");
    var chanelIdToPost = document.getElementById("chanelGroupIdToPost");
    var addChanelPerGroupPluses = document.querySelectorAll(".addServerInGroup");
    addChanelPerGroupPluses.forEach(function(plus) {
        plus.addEventListener("click", function() {
            event.preventDefault();
            addChanelUtility.style.display = "flex";
            chanelIdToPost.value = this.href;
            document.getElementById('CancelcreateChanelInGroup').addEventListener('click', function() {
                addChanelUtility.style.display = "none";
            });
        });
    });

    //display chanel adder (manage chanels)
    var addChanelUtility = document.getElementById("postChanelUtility");
    var addChanelBtns = document.querySelectorAll(".add-new-chanel-btn");
    addChanelBtns.forEach(function(btn) {
        btn.addEventListener("click", function() {
            addChanelUtility.style.display = "flex";
            groupId.value = btn.getAttribute('groupId')
            document.getElementById('CancelcreateChanelInGroup').addEventListener('click', function() {
                addChanelUtility.style.display = "none";
            });
        });
    });

    //select type
    var selectType = document.getElementById("chanelTypeToPost");
    var typeHider = document.getElementById("typeHider");
    var emoji = document.getElementById("typeEmoji");
    var type = 0;
    selectType.addEventListener("click", function() {
        if (type == 0) {
            typeHider.style.transform = "translateX(-148px)";
            emoji.textContent = "🔊";
            emoji.style.transform = "rotate(-360deg)";
            type = 1;
        } else if (type == 1) {
            typeHider.style.transform = "translateX(0)";
            emoji.textContent = "📖";
            emoji.style.transform = "rotate(0)";
            type = 0;
        }
    });

    //post chanel (manage chanels)
    var postChanel = document.getElementById('createChanelInGroup');
    postChanel.addEventListener('click', function() {
        var chanelName = document.getElementById('chanelNameToPost').value;
        var chanelDescription = document.getElementById('chanelDescriptionToPost').value;
        // alert('chanelName:' + chanelName + '; chanelDescription: ' + chanelDescription + '; type: ' + type + '; groupId: ' + groupId.value)

        //php request
        if (chanelName != '') {

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {}
            };
            xhttp.open("POST", "./jsToPhp/postChanel.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var params =
                "name=" + encodeURIComponent(chanelName) +
                "&description=" + encodeURIComponent(chanelDescription) +
                "&type=" + encodeURIComponent(type) +
                "&groupId=" + encodeURIComponent(groupId.value);
            xhttp.send(params);
        } else {
            alert("Chanel name can't be: null")
        }
    })
</script>