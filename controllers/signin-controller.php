<?php
require("./controllers/base-controller.php");
require("./entities/user.php");
class SignupController extends BaseController
{
    public function main()
    {
        if (!empty($_POST['add-user'])) {
            $user = new User($_POST);

            $check_params = [];
            $check_params[':username'] = $user->username;
            $check_params[':password'] = $user->password;

            $check_sql = "SELECT * FROM user WHERE username = :username AND password = :password";
            $check_stmt = $this->db->prepare($check_sql);
            $check_stmt->execute($check_params);
            $check_answer = $check_stmt->fetch(PDO::FETCH_ASSOC);

            if ($check_answer) {
                header("Location: ./create.php");
                exit;
            } else {
                $this->errors[] = 'ユーザー名またはパスワードが違います';
            }
        } else {
            $user = new User();
        }

        require("./views/signup.view.php");
    }
}
