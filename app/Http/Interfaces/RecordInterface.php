<?php

namespace App\Http\Interfaces;

/**
 * This interface will be defining the method that will be use by
 * the repositories that will implement this interface
 */
interface RecordInterface
{
    public function isExist($code);
    public function save($records);
    public function update($records, $key);
    public function getDetailByCode($code);
}