<?php
namespace Controllers;
class TestController{
    public function test()
    {
        dd("HELLO");
    }

    public function test2()
    {
        dd("WORLD");
    }

    public function testWildCard($id){
        dd($id);
    }
    public function testWildCard2($id, $id2){
        dd([$id, $id2]);
    }
}