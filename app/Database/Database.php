<?php namespace App\Database;

interface Database{
    public function save(string $model, array $data): void;

    public function fetch(string $model): array;

    public function getStoragePath(string $model);
}