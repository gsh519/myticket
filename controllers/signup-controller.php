<?php
require("./controllers/base-controller.php");
require("./entities/user.php");
class SignupController extends BaseController
{
    public function main()
    {
        if (isset($_POST['add-user'])) {
            $user = new User($_POST);

            // ここでバリデーションする
            $this->errors = $this->validate($user);

            if (empty($this->errors)) {
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
            }
        } else {
            $user = new User();
        }

        require("./views/signup.view.php");
    }

    private function validate(object $data)
    {
        $errors = [];
        // ユーザー名のチェック
        // ・存在チェック
        $check = [];
        $check[':username'] = $data->username;
        $check_sql = "select count(id) as is_user from user where username = :username";
        $check_stmt = $this->db->prepare($check_sql);
        $check_stmt->execute($check);
        $is_user = $check_stmt->fetch(PDO::FETCH_ASSOC);
        if ($is_user['is_user'] > 0) {
            $errors[] = 'このユーザー名はすでに存在しています!';
        }

        // ・入力の値判定
        // $pattern = "//";
        // if (!preg_match($pattern, $data->username)) {
        //     $errors[] = 'ユーザー名は半角英数・記号のみ8〜100文字以内で入力してください!';
        // }

        //パスワードのチェック
        $pattern = "/\A[" . preg_quote("!#%&+-./:=?[]", "/") . "\w]{6,15}\z/";
        if (!preg_match($pattern, $data->username)) {
            $errors[] = 'ユーザー名は半角英数・記号のみ6〜15文字以内で入力してください!';
        }

        return $errors;
    }
}
