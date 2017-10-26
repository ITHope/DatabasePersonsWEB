<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 22.10.2017
 * Time: 23:35
 */

namespace DBPersonPHP;


class Person
{

    var $id;
    function set_id($new_id) {
        $this->id = $new_id;
    }

    function get_id() {
        return $this->id;
    }


    var $name;
    function set_name($new_name) {
        $this->name = $new_name;
    }

    function get_name() {
        return $this->name;
    }

    var $last_name;
    function set_last_name($new_last_name) {
        $this->last_name = $new_last_name;
    }

    function get_last_name() {
        return $this->last_name;
    }


    var $age;
    function set_age($new_age) {
        $this->age = $new_age;
    }

    function get_age() {
        return $this->age;
    }


    function Person($id, $name, $last_name, $age) {
        $this->id = $id;
        $this->name = $name;
        $this->last_name = $last_name;
        $this->age = $age;
    }

}