<?php namespace App\Database;

use App\Database\Database;

class FileDB implements Database{
    public function save(string $model, array $data): void
    {
        file_put_contents($this->getStoragePath($model),serialize($data), FILE_APPEND);
    }

    public function fetch(string $model): array
    {
        return [];
    }

    public function getStoragePath(string $model): string
    {
        return 'storage/'.$model.'.txt';
    }
}