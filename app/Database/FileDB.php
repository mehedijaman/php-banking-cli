<?php namespace App\Database;

use App\Database\Database;

class FileDB implements Database{
    public function save(string $model, array $data): void
    {
        file_put_contents($this->getStoragePath($model),serialize($data), FILE_APPEND);
    }

    public function fetch(string $model): array
    {
        if(file_exists($this->getStoragePath($model))){
            $serializeData = file_get_contents($this->getStoragePath($model));
            $unserializeData = unserialize($serializeData);
            // ERROR:: it returns only the first array.have to fix this 
            // foreach($unserializeData as $data){
            //     var_dump($data);
            // }
            $data = unserialize(file_get_contents($this->getStoragePath($model)));
        }

        if(!is_array($data)){
            return [];
        }

        return $data;
    }

    public function getStoragePath(string $model): string
    {
        return 'storage/'.$model.'.db';
    }
}