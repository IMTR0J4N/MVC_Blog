<?php

namespace Blog\Controllers;

use Blog\App\Controller;
    class PostsController extends Controller {

        public function index(): void {
            $model = $this->loadModel("Post");

            if (isset($model)) $posts = $model->getAll();

            $this->render('posts/index', compact('posts'));
        }

        public function read(string $id): void {
            $this->loadModel('Post');

            if (isset($this->Post)) $post = $this->Post->findById($id);

            $this->render('posts/index', compact('post'));
        }

        public function create() {
            if(isset($_SESSION['id'])) {
                $this->render('posts/create');
            } else {
//                $this->redirectToLoginWithOldPath("/blog/posts/create");
            }
        }

        public function store(array $data) {
            $this->loadModel('Post');
        }
    }
?>