<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 22.10.2017
 * Time: 23:26
 */

namespace RedBeanPHP;
require_once 'rb.php';

class XML_Parser extends Parser
{
    public function Parse()
    {
        try {
            R::setup('mysql:host=localhost;
        dbname=persons','root','');

            R::setAutoResolve(TRUE);

            $rows = R::getAll( 'select * from persons' );


            function array_to_xml($rows, &$xml_user_info) {
                foreach($rows as $key => $value) {
                    if(is_array($value)) {
                        if(!is_numeric($key)){
                            $subnode = $xml_user_info->addChild("$key");
                            array_to_xml($value, $subnode);
                        }else{
                            $subnode = $xml_user_info->addChild("$key");
                            array_to_xml($value, $subnode);
                        }
                    }else {
                        $xml_user_info->addChild("$key",htmlspecialchars("$value"));
                    }
                }
            }

//creating object of SimpleXMLElement
            $xml_user_info = new SimpleXMLElement("<?xml version=\"1.0\"?><user_info></user_info>");

//function call to convert array to xml
            array_to_xml($rows,$xml_user_info);

//saving generated xml file
            $xml_file = $xml_user_info->asXML('users.xml');

//success and error message based on xml creation
            if($xml_file){
                echo 'XML file have been generated successfully.';
            }else{
                echo 'XML file generation error.';
            }


            echo $xml_user_info->asXML();
            echo "<pre>\n";
            readfile('users.xml');
            echo "</pre>\n";

            return $xml_user_info->asXML();
        }

        catch(Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
