<?php namespace App\Models;
use App\Database\FileDB;

class Customer{
    private string $name;
    private string $email;
    private string $password;

    public function set(array $data): void{
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = $data['password'];
    }

    public function validateEmail($email){

    }

    public function register(){
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ];
        $classParts = explode('\\',static::class);
        $className = end($classParts);
        $database = new FileDB();
        $database->save($className, $data);
        return true;
    }


}