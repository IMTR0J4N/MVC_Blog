<?php

namespace Blog\Controllers;

use Blog\App\Controller;
use Blog\Validator;

use PDOException;

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

                    header('Location:/blog/posts/show.php');
                }
            } catch (PDOException $e) {
                header('Location:/blog/posts/register.php?error');
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

            $this->render('auth/login');
        }

        public function doLogin(): void {
            $this->loadModel('User');

            $validator = new Validator($_POST);

            $formUsername = $_POST['username'];
            $formPassword = $_POST['password'];

            $validator->validate([
                "username" => ["min:2", "max:20"]
            ]);

            if(isset($this->User)) $user = $this->User->findByUsernameAndPassword($formUsername, $formPassword);

            if (isset($user) && isset($_POST['redirect'])) {

                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                header("Location:".$_POST["redirect"]);
            } else if (isset($user)) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                header("Location:/");
            } else {
                $redirect = $_POST['redirect'];
                $redirect ? header("Location:/auth/login?error?redirect=$redirect") : header("Location:/auth/login?error");
            }
        }

        public function disconnect(): void {
            session_reset();
            $this->render('login');
        }
    }
?>