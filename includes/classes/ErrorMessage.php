<?php
class ErrorMessage
{
    public static function show($text) {
        exit ("<span class='callout-danger'>$text</span>");
    }
}
