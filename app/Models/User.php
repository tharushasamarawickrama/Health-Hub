<?php


class User {
    use Model;

    protected $table = "users";

    protected $Allowedcolumns = [
        'Title',
        'FirstName',
        'LastName',
        'Email',
        'PhoneNumber',
        'Gender',
        'NIC',
        'Password',
        'Address',
        'Age'
    ];
}