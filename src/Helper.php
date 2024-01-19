<?php
namespace Blog;

class Helper {
    static function error($field) {
        return $_SESSION["error"][$field] ?? "";
    }

    static function old($field) {
        return $_SESSION["old"][$field] ?? "";
    }

    static function escape($data) {
        return stripslashes(trim(htmlspecialchars($data)));
    }

    static function slugify($str) {
        // replace non letter or digits by -
        $str = preg_replace('~[^\pL\d]+~u', '-', $str);
        // transliterate
        $str = iconv('utf-8', 'us-ascii//TRANSLIT', $str);
        // remove unwanted characters
        $str = preg_replace('~[^-\w]+~', '', $str);
        // trim
        $str = trim($str, '-');
        // remove duplicate -
        $str = preg_replace('~-+~', '-', $str);
        // lowercase
        $str = strtolower($str);
        if (empty($str)) {
            return 'n-a';
        }
        return $str;
    }
}
