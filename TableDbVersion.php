<?php namespace RedBeanPHP; ?>
<?php include("php/Person.php"); ?>



<?php

$id = 0;
$fn = "";
$ln = "";
$age = 0;

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $the_request = &$_GET;
        break;
    case 'POST':
        $the_request = &$_POST;
        break;
}

if (isset($the_request['id'])) {
    $id = $the_request['id'] + 0;
}
if (isset($the_request['fn'])) {
    $id = $the_request['fn'];
}
if (isset($the_request['ln'])) {
    $id = $the_request['ln'];
}
if (isset($the_request['age'])) {
    $id = $the_request['age'] + 0;
}

$persons_arr = array();
?>

<script>

    var persons = [];

    function Person(id, fn, ln, age) {
        this.id = id;
        this.fn = fn;
        this.ln = ln;
        this.age = age;
        return this;
    }

    function getPerson() {
        var id = document.getElementById('id').value;
        var fn = document.getElementById('fn').value;
        var ln = document.getElementById('ln').value;
        var age = document.getElementById('age').value;
        return new Person(id,fn,ln,age);
    }

    function getXmlHttp(){
        var xmlhttp;
        try {
            xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (E) {
                xmlhttp = false;
            }
        }
        if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
            xmlhttp = new XMLHttpRequest();
        }
        return xmlhttp;
    }

	function addPerson() {

        persons.push(getPerson());


        var id = document.getElementById('id').value;
        var fn = document.getElementById('fn').value;
        var ln = document.getElementById('ln').value;
        var age = document.getElementById('age').value;

        <?php

        $pers = new Person($id, $fn, $ln, $age);
        array_push($persons_arr, $pers);

        ?>

        var ajaxRequest = getXmlHttp();
        var req = "id="+id+"&fn="+fn+"&ln="+ln+"&age="+age;
        ajaxRequest.open('GET', 'php/addPerson.php?'+req, false);
        ajaxRequest.send(null);
        return ajaxRequest.responseText;

	}

	function delPerson() {

        persons.pop();

        var id = document.getElementById('id').value;


        <?php

        $item = null;
        foreach($persons_arr as $struct) {
            if ($id == $struct->id) {
                $item = $struct;
                break;
            }
        }

        $index = array_search($item, $persons_arr);
        unset( $persons_arr[$index] );

        ?>

        var xmlhttp = getXmlHttp()
        var req = "id="+id;
        xmlhttp.open('GET', 'php/delPerson.php?'+req, false);
        xmlhttp.send(null);
        if(xmlhttp.status == 200) {
            var result = xmlhttp.responseText;
            alert(result);
            return result;
        }
	}

	function updPerson() {
        var id = document.getElementById('id').value;
        var fn = document.getElementById('fn').value;
        var ln = document.getElementById('ln').value;
        var age = document.getElementById('age').value;

        <?php

        $item = null;
        foreach($persons_arr as $struct) {
            if ($id == $struct->id) {
                $item = $struct;
                break;
            }
        }

        $index = array_search($item, $persons_arr);
        if (isset($the_request['fn'])) {
            $persons_arr[$index]->fn = $fn;
        }
        if (isset($the_request['ln'])) {
            $persons_arr[$index]->ln = $fn;
        }
        if (isset($the_request['age'])) {
            $persons_arr[$index]->age = $fn;
        }

        ?>

        var xmlhttp = getXmlHttp()
        var req = "id="+id+"&fn="+fn+"&ln="+ln+"&age="+age;
        xmlhttp.open('GET', 'php/updPerson.php?'+req, false);
        xmlhttp.send(null);
        if(xmlhttp.status == 200) {
            var result = xmlhttp.responseText;
            alert(result);
            return result;
        }
	}


	function ShowPersons() {


        var tableRef = document.getElementById('persons').getElementsByTagName('tbody')[0];
        tableRef.innerHTML = "";


        <?php


        foreach($persons_arr as $struct) {
            echo $struct;
        }

        $parser = ParserFactory::GetParser( "HTML" );
        $parser->Parse();

        ?>


        persons.forEach(function(item) {
            var tableRef = document.getElementById('persons').getElementsByTagName('tbody')[0];
            // Insert a row in the table at the first row
            var newRow   = tableRef.insertRow(tableRef.rows.length);
            // Insert a cell in the row at index 0
            var cellId  = newRow.insertCell(0);
            var cellFn = newRow.insertCell(1);
            var cellLn = newRow.insertCell(2);
            var cellAge = newRow.insertCell(3);
            // Append a text node to the cell
            cellId.appendChild(document.createTextNode(item.id));
            cellFn.appendChild(document.createTextNode(item.fn));
            cellLn.appendChild(document.createTextNode(item.ln));
            cellAge.appendChild(document.createTextNode(item.age));
        });



        var div = document.createElement('div');
        div.className = 'row';

        var xmlhttp = getXmlHttp()
        var req = "format=HTML";
        xmlhttp.open('GET', 'php/Parser_Bridge.php?'+req, false);
        xmlhttp.send(null);
        if(xmlhttp.status == 200) {
            var result = xmlhttp.responseText;
            //alert(result);
            div.innerHTML = result;
        }
        document.getElementById('content').innerHTML = "";
        document.getElementById('content').appendChild(div);
	}

    function ShowPersonsXML() {

        <?php


        foreach($persons_arr as $struct) {
            echo $struct;
        }
        ?>


        var div = document.createElement('div');
        div.className = 'row';

        var xmlhttp = getXmlHttp();
        var req = "format=XML";
        xmlhttp.open('GET', 'php/Parser_Bridge.php?'+req, false);
        xmlhttp.send(null);
        if(xmlhttp.status == 200) {
            var result = xmlhttp.responseText;
            //alert(result);
            div.innerHTML = result;
        }
        document.getElementById('content').innerHTML = "";
        document.getElementById('content').appendChild(div);
    }

    function ShowPersonsXMLXSLT() {

        <?php


        foreach($persons_arr as $struct) {
            echo $struct;
        }

        $parser = ParserFactory::GetParser( "XSLT" );
        $parser->Parse();

        ?>

        var div = document.createElement('div');
        div.className = 'row';

        var xmlhttp = getXmlHttp()
        var req = "format=XSLT";
        xmlhttp.open('GET', 'php/Parser_Bridge.php?'+req, false);
        xmlhttp.send(null);
        if(xmlhttp.status == 200) {
            var result = xmlhttp.responseText;
            //alert(result);
            div.innerHTML = result;
        }
        document.getElementById('content').innerHTML = "";
        document.getElementById('content').appendChild(div);
    }

    function ShowPersonsJSON() {

        <?php


        foreach($persons_arr as $struct) {
            echo $struct;
        }

        $parser = ParserFactory::GetParser( "JSON" );
        $parser->Parse();

        ?>


        localStorage.setItem("persons", JSON.stringify(persons));
        persons = JSON.parse(localStorage.getItem("persons"));

        var div = document.createElement('div');
        div.className = 'row';

        var xmlhttp = getXmlHttp()
        var req = "format=JSON";
        xmlhttp.open('GET', 'php/Parser_Bridge.php?'+req, false);
        xmlhttp.send(null);
        if(xmlhttp.status == 200) {
            //var result = JSON.parse(xmlhttp.responseText);
            div.innerHTML = xmlhttp.responseText;
        }
        document.getElementById('content').innerHTML = "";
        document.getElementById('content').appendChild(div);
    }
</script>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

Id: <input type="text" id="id" name="id" value = "<?php echo $id; ?>"><br>
Fn: <input type="text" id="fn" name="fn" value = "<?php echo $fn; ?>"><br>
Ln: <input type="text" id="ln" name="ln"value = "<?php echo $ln; ?>"><br>
Age: <input type="text" id="age" name="age"value = "<?php echo $age; ?>"><br>
<button type="submit" onclick="addPerson()">Add</button>
<button type="submit" onclick="delPerson()">Delete</button>
<button type="submit" onclick="updPerson()">Update</button><br/>
<button type="submit" onclick="ShowPersons()">Read to HTML</button>
<button type="submit" onclick="ShowPersonsXML()">Read to XML</button>
<button type="submit" onclick="ShowPersonsJSON()">Read to JSON</button>
<button type="submit" onclick="ShowPersonsXMLXSLT()">Read to XML XSLT</button><br/><br/>

</form>

<div id="content">

</div>