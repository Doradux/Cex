<?php
session_start();
require_once '../Model/DBconection.php';

try {
    $conn = DBconection::connectDB();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['sender']) && isset($_POST['chanel']) && !empty($_POST['sender']) && !empty($_POST['chanel'])) {
            $sender = htmlspecialchars($_POST['sender'], ENT_QUOTES, 'UTF-8');
            $chanel = htmlspecialchars($_POST['chanel'], ENT_QUOTES, 'UTF-8');

            $sql = "SELECT * FROM `messages` WHERE chanelId = :chanelId";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":chanelId", $chanel);
            $stmt->execute();
            $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() > 0) {
                $lastDate = null;
                foreach ($messages as $message) {
                    $currentDate = date('d/m/Y', strtotime($message['time']));
                    if ($currentDate != $lastDate) {
                        echo "<div class='dateMsg'>
                                <div class='line'></div>
                                <p>$currentDate</p>
                                <div class='line'></div>
                              </div>";
                        $lastDate = $currentDate;
                    }

                    if ($message['userId'] == $_SESSION['currentUser']['id']) {
                        echo '<div class="out-msg-content msg" senderId="' . htmlspecialchars($message['userId'], ENT_QUOTES, 'UTF-8') . '" messageId="' . htmlspecialchars($message['id'], ENT_QUOTES, 'UTF-8') . '">';
                        echo '<p class="messageContent">' . htmlspecialchars($message['content'], ENT_QUOTES, 'UTF-8') . '</p>';
                        echo '<p class="in-time">' . ($message['modified'] == 1 ? 'Modified ' : '') . date('H:i', strtotime($message['time'])) . '</p>';
                        echo '</div>';
                    } elseif ($message['userId'] == 0) {
                        echo '<div class="in-msg centred">';
                        echo '<p class="messageContent">' . $message['content'] . '</p>';
                        echo '</div>';
                    } else {
                        $sqlUser = 'SELECT * FROM `users` WHERE id = :userId';
                        $stmtUser = $conn->prepare($sqlUser);
                        $stmtUser->bindParam(":userId", $message['userId']);
                        $stmtUser->execute();
                        $senderData = $stmtUser->fetch(PDO::FETCH_ASSOC);

                        if ($stmtUser->rowCount() > 0) {
                            $sqlImg = 'SELECT * FROM `user-image` WHERE id = :imageId';
                            $stmtImg = $conn->prepare($sqlImg);
                            $stmtImg->bindParam(":imageId", $senderData['imageId']);
                            $stmtImg->execute();
                            $senderImg = $stmtImg->fetch(PDO::FETCH_ASSOC);
                        } else {
                            $senderData['id'] = 0;
                            $senderImg['name'] = "default.jpg";
                            $senderData['username'] = '(Deleted user)';
                        }

                        echo '<div class="in-msg">';
                        echo '<div class="in-sender">';
                        echo '<div class="in-photo" style="background-image: url(\'../assets/images/userImage/' . htmlspecialchars($senderImg['name'], ENT_QUOTES, 'UTF-8') . '\');"></div>';

                        $found = false;
                        foreach ($_SESSION['serverUsers'] as $serUser) {
                            if ($serUser['id'] == $senderData['id']) {
                                $found = true;
                                $senderName = htmlspecialchars($serUser['name'], ENT_QUOTES, 'UTF-8');
                                break;
                            } else {
                                $senderName = "Deleted user";
                            }
                        }
                        if (!$found) {
                            $senderName = htmlspecialchars($senderData['username'], ENT_QUOTES, 'UTF-8');
                        }

                        echo '<p class="in-name">' . $senderName . '</p>';
                        echo '</div>';
                        echo '<div class="in-msg-content msg" senderId="' . htmlspecialchars($message['userId'], ENT_QUOTES, 'UTF-8') . '" messageId="' . htmlspecialchars($message['id'], ENT_QUOTES, 'UTF-8') . '">';
                        echo '<p class="messageContent">' . htmlspecialchars($message['content'], ENT_QUOTES, 'UTF-8') . '</p>';
                        echo '<p class="in-time">' . ($message['modified'] == 1 ? 'Modified ' : '') . date('H:i', strtotime($message['time'])) . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
            } else {
            }
        } else {
        }
    }
} catch (Exception $e) {
    echo '<div class="message">An error occurred: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</div>';
}
