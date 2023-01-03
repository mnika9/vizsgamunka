<?php namespace App\admin\Model;

// CRUD definition


interface Icrud 
{

    public static function all();
    public static function save();
    public static function getById(int $id);
    public static function update();
    public static function delete();
    

}