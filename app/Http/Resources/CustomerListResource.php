<?php

namespace App\Http\Resources;

use App\Repositories\Contracts\CountryJsonRepository;
use App\Repositories\Contracts\CountryRepositoryInterface;
use App\Services\CountriesRegexService;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerListResource extends JsonResource
{
    private CountriesRegexService $countriesRegexService;

    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->countriesRegexService = new CountriesRegexService(new CountryJsonRepository());

    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $countryInfo = $this->countriesRegexService->getCountryByPhoneNumber($this->phone);
        $state = $this->countriesRegexService->validateNumber($this->phone,$countryInfo[0]['regex']);
        return [
            'country' => $countryInfo[0]['name'],
            'code' => $countryInfo[0]['code'],
            'state' => $state ? "OK" : "NOK",
            'phone' => $this->phone
        ];

    }
}
