<?php

$chatChanels = [];
foreach ($_SESSION['groups'] as $group) {
    $chanels = [];
    $sql = "SELECT * FROM `chanels` WHERE groupId = :groupId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':groupId', $group['id']);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $allchanels = array_merge($chanels, $result);

    foreach ($allchanels as $chanel) {
        if ($chanel['type'] == "chat") {
            $chatChanels[] = $chanel;
        }
    }
}

?>


<div class="welcome-chanel-shield">
    <div class="welcome-chanel-div">
        <p>Select welcome chanel</p>
        <div class="welcome-chanels-list">
            <?php
            foreach ($chatChanels as $chanel) {
            ?>
                <div class="chanel-list-element" chanelId="<?= $chanel['id'] ?>">
                    <p># </p>
                    <p class="chanel-name"><?= $chanel['name'] ?></p>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<style>
    .welcome-chanels-list {
        display: flex;
        flex-direction: column;
        gap: 5px;
        max-height: 200px;
        overflow: scroll;
        overflow-x: hidden;
        padding-right: 5px;
        background-color: rgb(70, 70, 70);
    }

    .chanel-list-element {
        display: flex;
        gap: 5px;
        padding: 3px 10px 3px 10px;
        background-color: rgb(50, 50, 50);
        border-radius: 5px;
        cursor: pointer;
    }

    .chanel-list-element:hover {
        background-color: rgb(40, 40, 40);
    }

    .welcome-chanels-list::-webkit-scrollbar {
        width: 10px;
    }

    .welcome-chanels-list::-webkit-scrollbar-track {
        border: none;
    }

    .welcome-chanels-list::-webkit-scrollbar-thumb {
        background-color: rgb(50, 50, 50);
        border-radius: 20px;
    }

    .welcome-chanel-shield {
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

    .welcome-chanel-div {
        color: white;
        position: absolute;
        top: 35%;
        right: 40%;
        display: flex;
        flex-direction: column;
        padding: 10px;
        width: 300px;
        border-radius: 10px;
        gap: 20px;
        background-color: rgb(70, 70, 70);
    }
</style>