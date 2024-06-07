<div class="addGroup">
    <p>Add group</p>
    <input type="text" id="addGroup-input" placeholder="Group name">
    <div class="addGroup-btns">
        <button id="addGroup-create">CREATE</button>
        <button id="addGroup-cancel">CANCEL</button>
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

    .addGroup {
        color: white;
        position: absolute;
        top: 35%;
        right: 40%;
        background-color: rgb(50, 50, 50);
        display: none;
        flex-direction: column;
        padding: 10px;
        width: 300px;
        border-radius: 10px;
        gap: 20px;
    }

    button {
        min-width: 70px;
        background-color: greenyellow;
        border: none;
        border-radius: 5px;
        box-shadow: 0 1px 2px 0 rgb(88, 88, 88);
        font-family: "poppins_bold";
        color: black;
        cursor: pointer;
        text-align: center;
        font-size: 0.9rem;
        padding: 5px;
        transition: all 0.3s ease;
    }

    button:hover {
        background-color: green;
        color: white;
    }

    #addGroup-cancel {
        background-color: crimson;
    }

    #addGroup-cancel:hover {
        background-color: darkred;
    }

    input {
        border: none;
        background-color: rgba(0, 0, 0, 0.5);
        padding: 10px 5px 10px 5px;
        font-size: 1rem;
        color: white;
        border-radius: 4px;
    }

    input:focus {
        outline: none;
    }

    .addGroup-btns {
        display: flex;
        gap: 10px;
        justify-content: end;
    }
</style>