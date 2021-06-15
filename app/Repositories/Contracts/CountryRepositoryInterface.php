<?php


namespace App\Repositories\Contracts;


interface CountryRepositoryInterface
{
    /**
     * @return array
     */
    public function listAll() : array;

    /**
     * @param $countryCode
     * @return array
     */
    public function findCountryByPhoneCode($countryCode) : array;

    /**
     * @param $regularExpression
     * @return array
     */
    public function findCountryByRegularExpression($regularExpression) : array;

    /**
     * @param $regularExpression
     * @return array
     */
    public function findCountryByName($regularExpression) : array;

    /**
     * @return array
     */
    public function listCountries() : array;

    /**
     * @return array
     */
    public function listAllCountriesRegex() : array;

    /**
     * @param $regularExpression
     * @return array
     */
    public function findCountryByCodeRegularExpression($regularExpression): array;

    /**
     * @return array
     */
    public function listCountryCodes() : array;
}
