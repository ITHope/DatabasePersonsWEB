<?php

require_once 'rb.php';

try {
    R::setup('mysql:host=localhost;
        dbname=persons','root','');

    R::setAutoResolve(TRUE);

    $rows = R::getAll( 'select * from persons' );


    $xml = new XMLWriter();
    $xml->openMemory();
    $xml->startDocument('1.0', 'UTF-8');
    $xml->startElement('rows');


// simple one-dimensional array-traversal - depending on your array structure this can be much more complicated (e.g. recursion)
    foreach ($rows[0] as $key => $value) {

        $xml->writeElement($key, $value);
    }
    $xml->endElement();

    /*
     * $xml will look like
     * <array>
     *      <key1>value1</key1>
     *      <key2>value2</key2>
     *      <key3>value3</key3>
     * </array>
     */

// convert XMLWriter document into a DOM representation (can be skipped if XML is created with ext/DOM)
    $doc = DOMDocument::loadXML($xml->outputMemory());

// Load XSL stylesheet
    $xml_file = $xml->asXML('stylesheet.xsl');
    $xsl = DOMDocument::load('stylesheet.xsl');

// Fire-up XSLT processor
    $proc = new XSLTProcessor();
    $proc->importStyleSheet($xsl);

// Output transformation
    echo $doc->transformToXML($xml);

    return $doc;
}

catch(Exception $ex) {
    echo $ex->getMessage();
}



