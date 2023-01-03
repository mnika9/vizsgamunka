<?php namespace App\admin\Controller;


interface Icrudcontroller{

public function list();
public function add();
public function save();
public function delete();
public function update();
public function deleteById(int $id);
public function editById(int $id);


}