<?php

namespace Blog\App;

class Route {
    private string $path;
    private string $callable;
    private array $matches;
    private array $params;

    public function __construct(string $path, string $callable) {
        $this->setPath(trim($path, '/'));
        $this->setCallable($callable);
    }

    public function getPath(): string {
        return $this->path;
    }

    public function setPath(string $path): void {
        $this->path = $path;
    }

    public function getCallable(): string {
        return $this->callable;
    }

    public function setCallable($callable): void {
        $this->callable = $callable;
    }

    public function getMatches(): array {
        return $this->matches;
    }

    public function setMatches(array $matches): void {
        $this->matches = $matches;
    }

    public function match(string $url): bool {
        $url = trim($url, '/');
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->getPath());
        $regex = "#^$path$#i";

        if(!preg_match($regex, $url, $matches)) return false;

        array_shift($matches);

        $this->setMatches($matches);

        return true;
    }

    public function call(): mixed {
        $rep = explode("@", $this->getCallable());
        $controller = "Blog\\Controllers\\".$rep[0];

        $controller = new $controller();

        return call_user_func_array([$controller, $rep[1]], $this->getMatches());
    }
}