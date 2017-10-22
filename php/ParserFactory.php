<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 22.10.2017
 * Time: 23:19
 */

namespace RedBeanPHP;


class ParserFactory
{
    static public function getParser($src)
    {
        // may want to change the following line, because it assumes your parser
        // type is always 7 characters long.
        $type = substr($src, 0, 10);

        $pattern = '%type_Parser';
        $className = str_replace('%type', $type, $pattern);
        if (!class_exists($className)) {
            throw new InvalidArgumentException("Invalid parser $type");

            return new $className;
        }
    }
}