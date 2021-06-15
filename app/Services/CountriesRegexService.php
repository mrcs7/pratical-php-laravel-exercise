<?php


namespace App\Services;


use App\Repositories\Contracts\CountryRepositoryInterface;

class CountriesRegexService
{
    public CountryRepositoryInterface $countryRepository;

    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    public function getCountryByPhoneNumber($phoneNumber)
    {
        $codes = $this->countryRepository->listCountryCodes();
        foreach ($codes as $code){
            $regex = "/(".$code.")/";
            if(preg_match($regex,$phoneNumber))
            {
                return $this->countryRepository->findCountryByPhoneCode($code);
            }
        }
    }

    public function validateNumber($phoneNumber,$countryRegex)
    {
        $countryRegex="/".$countryRegex."/";
        return preg_match($countryRegex,$phoneNumber);
    }

}
