<?php


namespace App\Repositories;


use App\Model\Customer;
use App\Repositories\Contracts\CountryRepositoryInterface;

class CustomerEloquentRepository implements Contracts\CustomerRepositoryInterface
{
    private Customer $model;
    private CountryRepositoryInterface $countryRepository;

    public function __construct(Customer $customer,CountryRepositoryInterface $countryRepository)
    {
        $this->model = $customer;
        $this->countryRepository = $countryRepository;
    }

    public function listCustomers(array $params)
    {
        $query = $this->model->newQuery();
        if(!empty($params['country'])){
            $country = $this->countryRepository->findCountryByName($params['country']);
            $query->where('phone', 'REGEXP', $country[0]['code_regex']);
            if(!empty($params['valid']) && $params['valid'] == 'yes'){
                $query->where('phone', 'REGEXP', $country[0]['regex']);
            }
            if(!empty($params['valid']) && $params['valid'] == 'no'){
                $query->whereRaw('phone NOT REGEXP "'.$country[0]['regex'].'"');
            }
        }
        if(empty($params['country'])){
            $countries = $this->countryRepository->listAll();
            foreach ($countries as $country)
            {
                $query->orWhere('phone', 'REGEXP', $country['code_regex']);
                if(!empty($params['valid']) && $params['valid'] == 'yes'){
                    $query->where('phone', 'REGEXP', $country['regex']);
                }
                if(!empty($params['valid']) && $params['valid'] == 'no'){
                    $query->whereRaw('phone NOT REGEXP "'.$country['regex'].'"');
                }
            }
        }

        return $query->get();
    }
}
