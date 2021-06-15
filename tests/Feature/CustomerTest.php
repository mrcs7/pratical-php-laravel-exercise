<?php


namespace Tests\Feature;


use Illuminate\Http\Resources\Json\JsonResource;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    /** @test */
    public function it_should_return_all_phone_data_successfully()
    {
        $response = $this->get('/api/v1/customer/',
            [
                'Content-Type' => 'application/json'
            ]);
        $response->assertStatus(200);
    }

    /** @test */
    public function it_should_filter_by_country_successfully()
    {
        $response = $this->get('/api/v1/customer/?country=Morocco',
            [
                'Content-Type' => 'application/json'
            ]);
        $response->assertStatus(200);
        $this->assertCount(7,json_decode($response->getContent(),true));
    }

    /** @test */
    public function it_should_filter_by_country_and_valid_numbers_successfully()
    {
        $response = $this->get('/api/v1/customer/?country=Morocco&valid=yes',
            [
                'Content-Type' => 'application/json'
            ]);
        $response->assertStatus(200);
        $this->assertCount(4,json_decode($response->getContent(),true));
    }

    /** @test */
    public function it_should_filter_by_all_valid_numbers_successfully()
    {
        $response = $this->get('/api/v1/customer/?valid=yes',
            [
                'Content-Type' => 'application/json'
            ]);
        $response->assertStatus(200);
        $this->assertCount(27,json_decode($response->getContent(),true));
    }

    /** @test */
    public function it_should_filter_country_and_not_valid_numbers_successfully()
    {
        $response = $this->get('/api/v1/customer/?country=Morocco&valid=no',
            [
                'Content-Type' => 'application/json'
            ]);
        $response->assertStatus(200);
        $this->assertCount(3,json_decode($response->getContent(),true));
    }

    /** @test */
    public function it_should_filter_by_all_not_valid_numbers_successfully()
    {
        $response = $this->get('/api/v1/customer/?valid=no',
            [
                'Content-Type' => 'application/json'
            ]);
        $response->assertStatus(200);
        $this->assertCount(14,json_decode($response->getContent(),true));
    }

    /** @test */
    public function it_should_validate_countries_and_valid_values()
    {
        $response = $this->get('/api/v1/customer/?valid=ronaldo&country=usa',
            [
                'Content-Type' => 'application/json'
            ]);
        $response->assertStatus(422);
    }

}
