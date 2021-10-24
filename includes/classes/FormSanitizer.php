<?php
/**
 * Sanitize fields by removing HTML tags, trim all leading and laging spaces, replace spaces between text with underscores, lower all letters and finally uppercase the first letter
 * 
 * @param string $inputString The input that needs to be sanitized
 * 
 * @return string $inputString The sanitized input string
 */

class FormSanitizer {

    public static function sanitizeFormString($inputText)
    {
        // Strip all HTML tags
        $inputText = strip_tags($inputText);
        // Strip all leading and laging spaces
        $inputText = trim($inputText);
        // replace spaces between the username with underscores 
        $inputText = str_replace(" ", "_", $inputText);
        // conevert to lowercase
        $inputText = strtolower($inputText);
        // Convert first letter to uppercase
        $inputText = ucfirst($inputText);
        // return the value
        return $inputText;
    }

    public static function sanitizeFormUsername($inputText)
    {
        // Strip all HTML tags
        $inputText = strip_tags($inputText);
        // Strip all leading and laging spaces
        $inputText = trim($inputText);
        // replace spaces between the username with underscores 
        $inputText = str_replace(" ", "_", $inputText);
        
        return $inputText;
    }

    public static function sanitizeFormPassword($inputText)
    {
        // Strip all HTML tags
        $inputText = strip_tags($inputText);
        
        return $inputText;
    }

    public static function sanitizeFormEmail($inputText)
    {
        // Change all to lowercase
        $inputText = strtolower($inputText);
        // Strip all HTML tags
        $inputText = strip_tags($inputText);
        // Strip all leading and laging spaces
        $inputText = trim($inputText);
        // replace spaces between the username with underscores 
        $inputText = str_replace(" ", "", $inputText);

        return $inputText;
    }

    public static function sanitizeLoginEmail($inputText) {
        // remove special characters
        $inputText = strip_tags($inputText);
        //  convert to lowercase
        $inputText = strtolower($inputText);
        // Return the value
        return $inputText;
    }
    
}