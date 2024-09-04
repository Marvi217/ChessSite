<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Powiadomienia</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/alert.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.alert').forEach(function(alertDiv) {
               const status = alertDiv.getAttribute('data-status');
               const acceptButton = alertDiv.querySelector('.alert-accept');
               const rejectButton = alertDiv.querySelector('.alert-reject');
                
                if (status === 'accept') {
                    acceptButton.addEventListener('click', function(event) {
                        event.preventDefault();})
                    acceptButton.textContent = 'Zaakceptowano';
                    acceptButton.classList.add('alert-accepted');
                    rejectButton.style.display = 'none';
                } else if (status === 'reject') {
                    rejectButton.textContent = 'Odrzucono';
                    rejectButton.classList.add('alert-rejected');
                    acceptButton.style.display = 'none';
                }

                if ($("#acceptButton").length && status === '') {
                    $("#acceptButton").on("click", function(event) {
                        event.preventDefault();
                        $.post(this.href, { status: "accept" }, function(data) {
                            $(".alert-accept").text("Zaakceptowano");
                            $(".alert-accept").addClass("alert-accepted");
                            $(".alert-reject").addClass("hidden");
                        });
                    });
                }

                if ($("#rejectButton").length && status === '') {
                    $("#rejectButton").on("click", function(event) {
                        event.preventDefault();
                        $.post(this.href, { status: "reject" }, function(data) {
                            $(".alert-reject").text("Odrzucono");
                            $(".alert-reject").addClass("alert-rejected");
                            $(".alert-accept").addClass("hidden");
                        });
                    });
                }
            });
        });
    </script>
</head>
<body>
    <?php
    require("menu.php");
    ?>
    <div class="panel">
        <?php
        require("sidePanel.php");
        ?>
        <div class="main_panel">
            <div class="alertBox">
                <form method="post" action="process_alerts.php">
                    <?php
                    $id = $_SESSION['idUzytkownika'];

                    $sql = "SELECT * FROM alert WHERE idUzytkownika = $id";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='alert' data-id='" . $row['id'] . "' data-status='" . ($row['status'] ? $row['status'] : 'pending') . "'>";
                            echo "<input type='checkbox' name='alerts[]' value='" . $row['id'] . "' class='alert-checkbox'>";
                            echo "<div class='alert_content'>";
                            echo "<div class='alert-message'><p>" . $row['tresc'] . "</p></div>";
                            echo "<div class='alert-date'><p>" . $row['data_utworzenia'] . "</p></div>";
                            echo "</div>";
                            
                            if ($row['temat'] === "Zaproszenie"){
                                echo "<div class='alert_request'>";
                                echo "<a href='accept_invitation.php?id=" . $row['idFriend'] . "' class='alert-accept'>Akceptuj</a>";
                                echo "<a href='reject_invitation.php?id=" . $row['idFriend'] . "' class='alert-reject'>Odrzuć</a>";
                                echo "</div>";
                            }
                            if ($row['temat'] === "Challenge"){
                                echo "<div class='alert_request'>";
                                echo "<a href='accept_chellenge.php?id=" . $row['idFriend'] . "' class='alert-accept'>Akceptuj</a>";
                                echo "<a href='reject_chellenge.php?id=" . $row['idFriend'] . "' class='alert-reject'>Odrzuć</a>";
                                echo "</div>";
                            }
                            
                            echo "</div>";
                        }
                    } else {
                        echo "<p class='no-alerts'>Brak nowych powiadomień.</p>";
                    }

                    $conn->close();
                    ?>
                </form>
            </div>
            <?php       
            require("footer.php");
            ?>
        </div>
    </div>
</body>
</html>
