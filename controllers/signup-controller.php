<?php
require("./controllers/base-controller.php");
require("./entities/user.php");
class SignupController extends BaseController
{
    public function main()
    {
        if (!empty($_POST['add-user'])) {
            $user = new User($_POST);

            $add_params = [];
            $add_params[':username'] = $user->username;
            $add_params[':password'] = password_hash($user->password, PASSWORD_DEFAULT);

            $this->db->beginTransaction();

            try {
                $add_sql = "INSERT INTO user (username, password) VALUES (:username, :password)";
                $add_stmt = $this->db->prepare($add_sql);
                $add_stmt->execute($add_params);
                $this->db->commit();

                $_SESSION['msg'] = '登録しました';
                $_SESSION['login'] = $user->username;
                header("Location: ./create.php");
                exit;
            } catch (Exception $e) {
                $this->db->rollBack();
                echo 'エラーです:' . $e;
                return false;
            }
        } else {
            $user = new User();
        }

        require("./views/signup.view.php");
    }
}
