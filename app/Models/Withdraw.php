<?php namespace App\Models;

use App\Database\FileDB;
class Withdraw{
    
    public function store($email, $amount){
        $data = [
            'email' => $email,
            'data' => date('Y-m-d H:i:s'),
            'amount' => $amount
        ];

        try {
            $fileDB = new FileDB();
            $classParts = explode('\\',static::class);
            $className = end($classParts);
            $fileDB->save($className, $data);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function fetch(string $email): array {
        return [];
    }

    public static function total(string $email): int {
        return 0;
    }
}