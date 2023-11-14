<?php
    abstract class Controller {
        public function loadModel(string $model) {
            require_once(ROOT."src/models/".$model.".php");

            return $this->$model = new $model();
 
        }

        public function render(string $file, array $data = []): void {
            extract($data);

            ob_start();

            include(ROOT."/src/views/".strtolower(str_replace('Controller', '', get_class($this)))."/".$file.".php");

            $content = ob_get_clean();

            require_once(ROOT.'src/views/layout/default.php');
        }
    }
?>