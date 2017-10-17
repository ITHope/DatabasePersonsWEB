
var Person = function (firstname, lastname, age) {
    this.firstName = firstname;
    this.lastName = lastname;
    this.age = age;

    this.setAge = function (age) {
        this.age = age;
    };

}