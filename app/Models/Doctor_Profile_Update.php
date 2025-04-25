<?php


class Doctor_Profile_Update {
    use Model;

    protected $table = "doctor_profile_update";

    protected $Allowedcolumns = [
        'doctor_id',
        'firstName',
        'lastName',
        'description',
        'experience',
        'certifications',
        'certification_path',
        'photo_path'
    ];


}