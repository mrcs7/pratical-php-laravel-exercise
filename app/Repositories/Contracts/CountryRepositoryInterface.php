<?php


namespace App\Repositories\Contracts;


interface CountryRepositoryInterface
{
    public function listAll() : array;
    public function findCountryByPhoneCode($countryCode) : array;
    public function findCountryByRegularExpression($regularExpression) : array;
    public function findCountryByName($regularExpression) : array;
    public function listCountries() : array;
    public function listAllCountriesRegex() : array;
    public function findCountryByCodeRegularExpression($regularExpression): array;
    public function listCountryCodes() : array;
}
