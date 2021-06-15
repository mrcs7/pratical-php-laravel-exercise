<?php


namespace App\Repositories\Contracts;


interface CustomerRepositoryInterface
{
    public function listCustomers(array $params);
}
