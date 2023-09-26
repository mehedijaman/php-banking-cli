<?php namespace App\Models;

use App\Database\FileDB;
class Transfer{
    
    public function store(string $fromAccount, string $toAccount, int $amount){
        $data = [
            'fromAccount' => $fromAccount,
            'toAccount' => $toAccount,
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
}