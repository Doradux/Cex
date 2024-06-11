<div class="postChanelUtility-shield">
    <div id="postChanelUtility">
        <input type="hidden" name="chanelGroupIdToPost" id="chanelGroupIdToPost" value="">
        <input class="inputPostChanel" type="text" placeholder="Chanel name" name="chanelNameToPost" id="chanelNameToPost">
        <input class="inputPostChanel" type="text" placeholder="Chanel description" name="chanelDescriptionToPost" id="chanelDescriptionToPost">
        <p style="color: white;" class="big aux">CHANEL TYPE</p>
        <div name="chanelTypeToPost" id="chanelTypeToPost">
            <div id="typeHider">
                <div id="typeEmoji"><img class="chanel-type-icon" src="../../assets/icons/text-chanel.svg" alt=""></div>
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

    .postChanelUtility-shield {
        width: 100vw;
        height: 100vh;
        top: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.7);
        display: none;
        justify-content: center;
        align-items: center;
        position: fixed;
        backdrop-filter: blur(5px);
    }

    #postChanelUtility {
        background-color: rgb(50, 50, 50);
        width: 400px;
        display: flex;
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
        width: 170px;
        position: absolute;
        background-color: white;
        border-radius: 10px;
        transform: translateX(80px);
        /* left: 37px; */
        /* left: 184px; */
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.5s ease;
    }

    #typeEmoji {
        transition: transform 0.5s ease;
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

    .chanel-type-icon {
        height: 25px;
    }
</style>