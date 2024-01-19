<?php session_start(); ?>
<?php require "db-connect.php"; ?>


<!DOCTYPE html>
<html lang="ja">

<head>
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Login</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            margin-top: 100px;
            max-width: 400px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .login-heading {
            text-align: center;
            color: #007bff;
        }

        .login-form {
            margin-top: 20px;
        }

        .login-button {
            width: 100%;
        }

        .signup-link {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 login-container">
            <h2 class="login-heading">ログイン</h2>

            <form action="login-output.php" method="post" class="login-form">
                <div class="form-group">
                    <input type="text" class="form-control" name="team_name" placeholder="チーム名を入力" value="aso"  required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="パスワードを入力" value="aso" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary login-button">ログイン</button>
                </div>
            </form>

            <div class="signup-link">
                <p><a href="team_touroku-input.php">チーム登録の方はこちらから</a></p>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
