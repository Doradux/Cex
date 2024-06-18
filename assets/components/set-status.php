<div class="status-shield">
    <div class="status">
        <p>Set custom status</p>
        <textarea placeholder="Custom status here" id="status-value"><?= $_SESSION['currentUser']['status'] ?></textarea>
        <div class="status-btns">
            <button id="set-status">SET STATUS</button>
            <button id="cancel-status">CANCEL</button>
        </div>
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
        color: white;
    }

    .status-shield {
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.7);
        display: none;
        justify-content: center;
        align-items: center;
        position: fixed;
        top: 0;
        left: 0;
        backdrop-filter: blur(5px);
    }

    .status {
        color: white;
        position: absolute;
        top: 40%;
        left: calc(50% - 200px);
        display: flex;
        flex-direction: column;
        padding: 10px;
        width: 400px;
        border-radius: 10px;
        gap: 20px;
        background-color: rgb(70, 70, 70);
    }

    textarea {
        border: none;
        background-color: rgb(50, 50, 50);
        width: 100%;
        height: 100px;
        resize: none;
        color: white;
        padding: 10px;
        border-radius: 10px;
    }

    textarea::-webkit-scrollbar {
        width: 10px;
    }

    textarea::-webkit-scrollbar-track {
        border: none;
    }

    textarea::-webkit-scrollbar-thumb {
        background-color: rgb(30, 30, 30);
        border-radius: 20px;
    }

    textarea:focus {
        outline: none;
    }

    .status-btns {
        display: flex;
        gap: 10px;
        justify-content: end;
    }

    button {
        padding: 5px;
        font-family: 'poppins_bold';
        border: none;
        border-radius: 5px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    #set-status {
        background-color: darkcyan;
    }

    #cancel-status {
        background-color: crimson;
    }
</style>