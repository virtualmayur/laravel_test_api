<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\CountryService;

class CountryController extends BaseController
{
    private CountryService $countryService;

    public function __construct()
    {
        $this->countryService = new CountryService();
    }

    /**
     * Get All countries function
     *
     * @return void
     */
    public function index()
    {
        $result = $this->countryService->getCountries();

        return $this->generateResponse($result['status'], $result['data'], $result['message']);
    }

    /**
     * Add new country function
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $result = $this->countryService->addCountry($request->all());

        return $this->generateResponse($result['status'], $result['data'], $result['message']);
    }

    /**
     * Get Filtered Countries function
     *
     * @param Request $request
     * @return void
     */
    public function filter(Request $request)
    {
        $result = $this->countryService->getFilteredCountries($request->input());

        return $this->generateResponse($result['status'], $result['data'], $result['message']);
    }
}
