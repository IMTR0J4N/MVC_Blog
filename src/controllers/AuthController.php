<?php
    Class AuthController extends Controller {
        public function createUser(string $username, string $password): void {
            try {
                $stmt = $this->_connexion->prepare('SELECT username FROM users WHERE username = :username');
                $stmt->execute(array('username'=> $username));

                if($res = $stmt->fetch()) {
                    header('Location:/blog/auth/register.php?username_taken');
                } else {
                    session_start();

                    $stmt = db->prepare('INSERT INTO users (id, username, password) VALUES (:id, :username, :password)');

                    $id = uniqid();
                    $specialUsername = htmlspecialchars($username);
                    $hashedPassword = hash('md5', $password);

                    $stmt->execute(array('id' => $id, 'username' => $specialUsername, 'password' => $hashedPassword));

                    $_SESSION['id'] = $id;
                    $_SESSION['username'] = $username;

                    header('Location:/blog/articles/show.php');
                }
            } catch (PDOException $e) {
                header('Location:/blog/articles/register.php?error');
            }
        }

        public function deleteUser(string $id): void{
            try {
                $stmt = db->prepare('DELETE FROM users WHERE id = :id');
                $stmt->execute(array('id'=> $id));

                session_destroy();

                header('Location:/blog/auth/login.php?user_deleted');
            } catch (PDOException $e) {
                echo $e;
            }
        }

        public function login(): void {

            if(isset($_SESSION['id']) || isset($_SESSION['username'])) session_destroy();

            $this->render('login');
        }

        public function doLogin(): void {
            session_start();
            $this->loadModel('User');

            $formUsername = $_POST['username'];
            $formPassword = $_POST['password'];

            if(isset($this->User)) $user = $this->User->findByUsernameAndPassword($formUsername, $formPassword);

            if ($user && isset($_POST['old_path'])) {

                $old_path = $_POST['old_path'];

                var_dump($user);

                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                header("Location:$old_path");
            } else if ($user) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                header("Location:/blog/articles");
            } else {
                $old_path = $_POST['old_path'];
                $old_path ? header("Location:/blog/auth/login?error?old_path=$old_path") : header("Location:/blog/auth/login?error");
            }
        }

        static function isLoggedIn () {
            return isset($_SESSION['id']);
        }
    }
?>