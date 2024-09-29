<?php
namespace app\Controllers;
class TestController{
    public function test()
    {
        return("HELLO");
    }

    public function test2()
    {
        return("WORLD");
    }

    public function testWildCard($id){
        return($id);
    }
    public function testWildCard2($id, $id2){
        return([$id, $id2]);
    }

    public function stringResponse()
    {
        return 'Hello World';
    }

    public function jsonResponse()
    {
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA',
        ]);
    }

    public function customResponse()
    {
        return response('Custom Response', 200)
            ->header('Content-Type', 'text/plain');
    }

    public function assocArrayResponse()
    {
        return [
            'name' => 'John',
            'age' => 30,
        ];
    }

    public function arrayResponse()
    {
        return [
            'John',
            30,
        ];
    }

    public function modelResponse()
    {
        $user = new \stdClass();
        $user->name = 'John Doe';
        $user->email = 'john@example.com';
        return $user;
    }
}