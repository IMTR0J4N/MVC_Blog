<?php 
    class ArticlesController extends Controller {

        public function index(): void {

            session_start();

            $this->loadModel("Article");

            if (isset($this->Article)) $articles = $this->Article->getAll();

            $this->render('index', compact('articles'));
        }

        public function read(string $id): void {
            $this->loadModel('Article');

            if (isset($this->Article)) $article = $this->Article->findById($id);

            $this->render('index', compact('article'));
        }

        public function create() {

        }

        public function store(array $data) {
            $this->loadModel('Article');
        }
    }
?>