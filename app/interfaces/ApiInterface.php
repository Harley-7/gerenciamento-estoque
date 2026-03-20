<?php 

namespace app\interfaces;

interface ApiInterface
{
    public function getAll();
    public function getById();
    public function create();
    public function update();
    public function delete();
}

?>