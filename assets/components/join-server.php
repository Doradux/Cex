<div class="join-server-shield">
    <div class="join-server-div">
        <form action="">
            <label for="joinServerId">
                JOIN SERVER
            </label>
            <div>
                <input type="text" autocomplete="off" placeholder="Server link" name="joinServerId" id="joinServerId">
                <input id="joinS" type="submit" value="JOIN">
            </div>
        </form>
        <form action="">
            <label for="joinServerId">
                CREATE SERVER
            </label>
            <div>
                <input type="text" autocomplete="off" placeholder="Server name" name="createServerName" id="createServerName">
                <input id="createS" type="submit" value="CREATE!">
            </div>
        </form>
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

    .join-server-shield {
        position: fixed;
        height: 100vh;
        width: 100vw;
        top: 0;
        left: 0;
        display: none;
        justify-content: center;
        align-items: center;
        background-color: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(5px);
    }

    .join-server-div {
        background-color: rgb(50, 50, 50);
        padding: 20px;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        gap: 30px;

        & input {
            background-color: rgb(30, 30, 30);
            padding: 10px;
            border: none;
            border-radius: 8px;
        }
    }

    input:focus {
        outline: none;
    }

    label {
        font-family: 'poppins_bold';
        font-size: 0.9rem;

    }

    #joinS,
    #createS {
        font-family: 'poppins_bold';
        background-color: darkseagreen;
        color: black;
        width: 80px;
    }

    #createS {
        background-color: darkcyan;
    }

    form div {
        display: flex;
        gap: 10px;
    }
</style>