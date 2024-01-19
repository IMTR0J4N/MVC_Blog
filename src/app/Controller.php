<?php

namespace Blog\App;

    abstract class Controller {
        public function loadModel(string $model) {
            $modelPath = "Blog\Models\\".$model;

            return new $modelPath;
        }

        public function render(string $path, array $data = []): void {
            extract($data);

            ob_start();

            require "../src/Views/$path.php";

            $content = ob_get_clean();

            require_once '../src/Views/layout/default.php';
        }
    }
?>