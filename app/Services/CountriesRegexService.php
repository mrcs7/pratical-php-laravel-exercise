<?php


namespace App\Services;


use App\Repositories\Contracts\CountryRepositoryInterface;

class CountriesRegexService
{
    /**
     * @var CountryRepositoryInterface
     */
    public CountryRepositoryInterface $countryRepository;

    /**
     * CountriesRegexService constructor.
     * @param CountryRepositoryInterface $countryRepository
     */
    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * @param $phoneNumber
     * @return array
     */
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

    /**
     * @param $phoneNumber
     * @param $countryRegex
     * @return false|int
     */
    public function validateNumber($phoneNumber,$countryRegex)
    {
        $countryRegex="/".$countryRegex."/";
        return preg_match($countryRegex,$phoneNumber);
    }

}
