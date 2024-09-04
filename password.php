<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zmiana Hasła</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/settings.css">
</head>
<body>
    <?php require("menu.php"); ?>
    
    <div class="panel">
        <?php require("sidePanel.php"); ?>
        <div class="main_panel_password">
            <div class="password_form">
                <form id="passwordForm">
                    <div class="Password">
                        <div id="general-error" class="error-message"></div>

                        <div class="password-field">
                            <label for="old-password">Stare hasło</label>
                            <input type="password" id="old-password" name="old_password" required>
                            <div id="old-password-error" class="error-message"></div>
                        </div>

                        <div class="password-field">
                            <label for="new-password">Nowe hasło</label>
                            <input type="password" id="new-password" name="new_password" required>
                            <div id="new-password-error" class="error-message"></div>
                        </div>

                        <div class="password-field">
                            <label for="confirm-new-password">Potwierdź nowe hasło</label>
                            <input type="password" id="confirm-new-password" name="confirm_new_password" required>
                            <div id="confirm-password-error" class="error-message"></div>
                        </div>

                        <div class="password-field">
                            <input type="submit" value="Zapisz hasło">
                        </div>
                        <div id="success-message" class="success-message"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <?php require("footer.php"); ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#passwordForm').on('submit', function(e) {
                e.preventDefault();

                $('.error-message').text('');
                $('#success-message').text('');

                const oldPassword = $('#old-password').val();
                const newPassword = $('#new-password').val();
                const confirmPassword = $('#confirm-new-password').val();

                $.post('updatePassword.php', {
                    old_password: oldPassword,
                    new_password: newPassword,
                    confirm_new_password: confirmPassword
                }, function(data) {
                    const responseParts = data.split('|');
                    const status = responseParts.shift().split('=')[1];
                    const errors = {};

                    responseParts.forEach(part => {
                        const [key, value] = part.split('=');
                        if (key && value) {
                            errors[key] = value;
                        }
                    });

                    if (status === "success") {
                        $('#success-message').text("Hasło zostało pomyślnie zaktualizowane.");
                        $('#passwordForm')[0].reset();
                    } else {
                        if (errors.old_password) {
                            $('#old-password-error').text(errors.old_password);
                        }
                        if (errors.new_password) {
                            $('#new-password-error').text(errors.new_password);
                        }
                        if (errors.general) {
                            $('#general-error').text(errors.general);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
