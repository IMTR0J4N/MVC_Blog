<?php 
    class ArticlesController extends Controller {

        public function index(): void {
            $this->loadModel("Article");

            if (isset($this->Article)) $articles = $this->Article->getAll();

            $this->render('index', compact('articles'));
        }

        public function read(string $id): void {
            $this->loadModel('Article');

            if (isset($this->Article)) $article = $this->Article->findById($id);

            $this->render('index', compact('article'));
        }

        public function create(array $data) {
            $this->loadModel('Article');


        }
    }
?>