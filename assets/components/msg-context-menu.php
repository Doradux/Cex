<div class="msg-context-menu-shield">
    <div class="msg-context-menu-div">
        <div id="modify-msg" class="msg-context-menu-option">MODIFY</div>
        <div id="del-msg" class="msg-context-menu-option del">DELETE</div>
    </div>
</div>

<style>
    @font-face {
        font-family: "poppins";
        src: url("../../assets/fonts/Poppins-Regular.ttf");
        font-weight: normal;
        font-style: normal;
    }

    @font-face {
        font-family: "poppins_bold";
        src: url("../../assets/fonts/Poppins-Bold.ttf");
        font-weight: normal;
        font-style: normal;
    }

    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        /* border: 1px solid black; */
        font-family: "poppins";
        cursor: default;
    }

    .msg-context-menu-shield {
        width: 100vw;
        height: 100vh;
        display: none;
        position: fixed;
        top: 0;
        left: 0;
    }

    .msg-context-menu-div {
        position: absolute;
        background-color: rgb(50, 50, 50);
        font-family: 'poppins_bold';
        font-size: 0.9;
        cursor: pointer;
        border-radius: 5px;
        overflow: hidden;
    }

    .msg-context-menu-option {
        padding: 5px 10px 5px 10px;
        text-align: center;
    }

    .msg-context-menu-option:hover {
        background-color: rgba(0, 180, 217, 1);
    }

    .del {
        color: crimson;
    }

    .del:hover {
        color: white;
        background-color: crimson;
    }
</style>