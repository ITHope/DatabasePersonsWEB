<?php

namespace DBPersonPHP;
include_once("Parser.php");
include_once("HTML_Parser.php");
include_once("XML_Parser.php");
include_once("XSLT_Parser.php");
include_once("JSON_Parser.php");

class ParserFactory
{
    static public function getParser($src)
    {
        $type = substr($src, 0, 4);

        $pattern = '%type_Parser';
        $className = str_replace('%type', $type, $pattern);
        //if (!class_exists($className)) {
        //    throw new InvalidArgumentException("Invalid parser $type");
        //}
        return new $className;
    }
}
?>