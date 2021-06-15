<?php


namespace App\Http\Controllers;


use App\Http\Requests\CustomerListRequest;
use App\Http\Resources\CustomerListResource;
use App\Http\Resources\PaginationCollection;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Services\CountriesRegexService;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    /**
     * @var CustomerRepositoryInterface
     */
    private CustomerRepositoryInterface $customerRepository;

    /**
     * CustomerController constructor.
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @return mixed
     */
    public function index(CustomerListRequest $request)
    {
        $params = $request->all();
        return new JsonResponse(CustomerListResource::collection($this->customerRepository->listCustomers($params)),200);
    }

}
