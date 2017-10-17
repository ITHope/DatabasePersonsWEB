
function AddEnd() {
    var table = document.getElementById("Persons");
    var row = table.insertRow(Persons.rows.Length);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    cell1.innerHTML = document.getElementById("idp").value;
    cell2.innerHTML = document.getElementById("fn").value;
    cell3.innerHTML = document.getElementById("ln").value;
    cell4.innerHTML = document.getElementById("age").value;
}

function AddStart() {
    var table = document.getElementById("Persons");
    var row = table.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    cell1.innerHTML = document.getElementById("idp").value;
    cell2.innerHTML = document.getElementById("fn").value;
    cell3.innerHTML = document.getElementById("ln").value;
    cell4.innerHTML = document.getElementById("age").value;
} 

function AddMid() {
    var table = document.getElementById("Persons");
    var len = table.rows.length+1;
    var row = table.insertRow(len / 2);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    cell1.innerHTML = document.getElementById("idp").value;
    cell2.innerHTML = document.getElementById("fn").value;
    cell3.innerHTML = document.getElementById("ln").value;
    cell4.innerHTML = document.getElementById("age").value;
}

function DelStart() {
    var table = document.getElementById("Persons");
    table.deleteRow(1);
}

function DelMid() {
    var table = document.getElementById("Persons");
    var len = table.rows.length;
    if (table.rows.length > 1)
        table.deleteRow(len / 2);
}

function DelEnd() {
    var table = document.getElementById("Persons");
    if (table.rows.length > 1)
        table.deleteRow(table.rows.length - 1);
}

function Clear() {
    var table = document.getElementById("Persons");
    var rows = table.rows;
    var i = rows.length;
    while (--i) {
        rows[i].parentNode.removeChild(rows[i]);
    }
}

var Person = function (id, firstname, lastname, age) {
    this.idp = idp;
    this.firstName = firstname;
    this.lastName = lastname;
    this.age = age;

    this.setAge = function (age) {
        this.age = age;
    };

}

var saveData = JSON.parse(localStorage.saveData || null) || {};

function Save() {
    
    var table = document.getElementById("Persons");
    var arr = new Array();
    var rows = table.rows;
    var i = rows.length;
    while (--i) {
        var idp = rows[i].namedItem("idp").value;
        var fn = rows[i].namedItem("fn").value;
        var ln = rows[i].namedItem("ln").value;
        var age = rows[i].namedItem("age").value;
        arr.push(new Person(id, fn,ln,age));
    }
    localStorage.setItem("persons", JSON.stringify(arr));
}

function Load() {

    var datacount = localStorage.length;
    if (datacount > 0) {
        var render = "";
        for (i = 0; i < datacount; i++) {
            var key = localStorage.key(i);
            var applicant = localStorage.getItem(key);
            var data = JSON.parse(applicant);
            render += "<tr>";
            render += "<td>" + data.idp + "</td>";
            render += "<td>" + data.fn + "</td>";
            render += "<td>" + data.ln + "</td>";
            render += "<td>" + data.age + "</td>";
        }

        render += "</tr>";
        newTable.innerHTML = render;

        var newTable = document.getElementById("Persons");
        var row = table.insertRow(Persons.rows.Length);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        cell1.innerHTML = data.idp;
        cell2.innerHTML = data.fn;
        cell3.innerHTML = data.ln;
        cell4.innerHTML = data.age;


        
    }
}