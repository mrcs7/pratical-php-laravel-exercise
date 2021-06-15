<?php


namespace App\Repositories\Contracts;


interface CustomerRepositoryInterface
{
    /**
     * @param array $params
     * @return mixed
     */
    public function listCustomers(array $params);
}
