<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>チケットをもらう</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
</head>

<body>
    <div class="wrapper">
        <div class="logo logo--get"><a href="./">myticket</a></div>
        <div class="login-title">
            <h1>チケットを作成するにはアカウントを作成してね！！</h1>
        </div>

        <div class="login-form">
            <h1>アカウント作成</h1>
            <?php if (!empty($_SESSION['msg'])) : ?>
                <p class="message"><?php $this->escape($_SESSION['msg']); ?></p>
                <?php unset($_SESSION['msg']); ?>
            <?php endif; ?>
            <!-- エラー表示 -->
            <?php if ($this->errors) : ?>
                <ul>
                    <?php foreach ($this->errors as $error) : ?>
                        <li class="error">※<?php $this->escape($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <form action="" method="post">

                <!-- ユーザー名 -->
                <div class="form-area">
                    <label for="username">ユーザー名<small>※ユーザー名は登録したあとに変更できません</small></label>
                    <input type="text" name="username" id="username" class="username" placeholder="myticket" value="<?php $this->escape($user->username); ?>">
                </div>

                <!-- パスワード -->
                <div class="form-area">
                    <label for="password">パスワード</label>
                    <input type="password" name="password" id="password" class="password" placeholder="パスワードを入力してね！" value="<?php $this->escape($user->password); ?>">
                </div>

                <div class="form-area form-area--btn">
                    <input type="submit" name="add-user" class="btn" value="新規作成">
                </div>
            </form>
        </div>

        <div class="signup-btn">
            <p>※アカウントをお持ちの方は</p>
            <a href="./login.php">ログインページ</a>
        </div>
    </div>

    <script src="../js/script.js"></script>
</body>

</html>
