<?php namespace App\Models;
use App\Database\FileDB;

class Customer{
    private string $name;
    private string $email;
    private string $password;
    private FileDB $fileDB;

    public function set(array $data): void{
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = $data['password'];
    }

    public function validateEmail($email){

    }

    public function register(): bool{
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

    public function login(string $email, string $password){
        $classParts = explode('\\',static::class);
        $className = end($classParts);
        $database = new FileDB();
        $data = $database->fetch($className);
        

        return true;
    }

    public function deposit($email, $amount){
        $data = [
            'email' => $email,
            'amount' => $amount
        ];

        try {
            $this->fileDB->save('Deposit', $data);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }


}