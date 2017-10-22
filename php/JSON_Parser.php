<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 22.10.2017
 * Time: 23:25
 */

namespace RedBeanPHP;
require_once 'rb.php';

class JSON_Parser extends Parser
{
    public function Parse()
    {
        try {
            R::setup('mysql:host=localhost;
        dbname=persons','root','');

            R::setAutoResolve(TRUE);

            $rows = R::getAll( 'select * from persons' );


            foreach($rows as $myObj) {
                $myJSON = json_encode($myObj);
                echo $myJSON;
            }

            return $myJSON;
        }

        catch(Exception $ex) {
            echo $ex->getMessage();
        }
    }
}