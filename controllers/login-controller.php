<?php
require("./controllers/base-controller.php");
require("./entities/user.php");
class LoginController extends BaseController
{
    public function main()
    {
        // ログインしている場合チケット作成画面へ遷移
        if (isset($_SESSION['login'])) {
            session_regenerate_id(true);
            header("Location: ./create.php");
            exit;
        }

        if (isset($_POST['add-user'])) {
            $user = new User($_POST);

            $check_params = [];
            $check_params[':username'] = $user->username;

            $check_sql = "SELECT * FROM user WHERE username = :username";
            $check_stmt = $this->db->prepare($check_sql);
            $check_stmt->execute($check_params);
            $check_answer = $check_stmt->fetch(PDO::FETCH_ASSOC);

            if ($check_answer) {
                if (!password_verify($user->password, $check_answer['password'])) {
                    $this->errors[] = 'ユーザー名またはパスワードが違います';
                } else {
                    session_regenerate_id(true);
                    $_SESSION['login'] = $user->username;
                    $_SESSION['login_success'] = 'ログインしました';
                    header("Location: ./create.php");
                    exit;
                }
            } else {
                $this->errors[] = 'ユーザー名またはパスワードが違います';
            }
        } else {
            $user = new User();
        }

        require("./views/login.view.php");
    }
}
