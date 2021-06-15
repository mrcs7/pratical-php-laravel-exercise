<?php


namespace App\Repositories;


use App\Repositories\Contracts\CountryRepositoryInterface;

class CountryJsonRepository implements CountryRepositoryInterface
{
    private $data;

    public function __construct()
    {
        $this->data = json_decode(file_get_contents(base_path() . "/database/countries.json"),true);
    }

    public function listAll(): array
    {
        return $this->data;
    }

    public function findCountryByPhoneCode($countryCode): array
    {
        return array_values(array_filter($this->data, function ($value) use ($countryCode) {

            return ($value["code"] == $countryCode);

        }));
    }

    public function findCountryByRegularExpression($regularExpression): array
    {
        return array_values(array_filter($this->data, function ($value) use ($regularExpression) {

            return ($value["regex"] == $regularExpression);

        }));
    }

    public function findCountryByName($name): array
    {
        return array_values(array_filter($this->data, function ($value) use ($name) {

            return ($value["name"] == $name);

        }));
    }

    public function listCountries(): array
    {
        return array_column($this->data,'name');
    }

    public function listAllCountriesRegex(): array
    {
        return array_column($this->data,'code_regex');
    }

    public function findCountryByCodeRegularExpression($regularExpression): array
    {
        return array_values(array_filter($this->data, function ($value) use ($regularExpression) {

            return ($value["code_regex"] == $regularExpression);

        }));
    }

    public function listCountryCodes(): array
    {
        return array_column($this->data,'code');

    }
}
