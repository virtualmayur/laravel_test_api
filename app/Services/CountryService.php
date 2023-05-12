<?php

namespace App\Services;

use App\Models\Country;
use Illuminate\Support\Facades\Validator;

class CountryService 
{

    /**
     * Get All Countries function
     *
     * @return array
     */
    public function getCountries(): array
    {
        $countries = Country::all();
        if ($countries->count() > 0) {
            return [
                'status' => 200,
                'data' => [$countries],
                'message' => $countries->count() . ' record found.',
            ];
        } else {
            return [
                'status' => 404,
                'data' => [],
                'message' => 'No Data Found',
            ];
        }
    }

    /**
     * Add Country function
     *
     * @param array $request
     * @return array
     */
    public function addCountry(array $request): array
    {
        $validator = Validator::make($request, [
            'country_code' => 'required|string|max:5',
            'country_name' => 'required|string|max:150',
            'dialing_code' => 'required|string|max:10',
        ]);

        if ($validator->fails()) {
            return [
                'status' => 422,
                'data' => [],
                'message' =>json_encode($validator->messages()),
            ];
        } else {
            if (Country::where('country_code', '=', $request['country_code'])
            ->orWhere('country_name', '=', $request['country_name'])
            ->orWhere('dialing_code', '=', $request['dialing_code'])
            ->exists()) {
                return [
                    'status' => 202,
                    'data' => [],
                    'message' => 'Record already exist with any of the input data',
                ];
            }

            $country = Country::create([
                'country_code' => $request['country_code'],
                'country_name' => $request['country_name'],
                'dialing_code' => $request['dialing_code'],
            ]);

            if ($country) {
                $response = [
                    'status' => 200,
                    'data' => [],
                    'message' => 'Country Dialing Code Added Successfully',
                ];
            } else {
                $response = [
                    'status' => 500,
                    'data' => [],
                    'message' => 'Something went wrong',
                ];
            }

            return $response;
        }
    }

    /**
     * Get Filtered Countries
     *
     * @param array $request
     * @return void
     */
    public function getFilteredCountries(array $request)
    {
        $query = Country::query();

        if (!empty($request['country_code'])) {
            $query->where('country_code', 'LIKE', '%' . $request['country_code'] . '%');
        }

        if (!empty($request['country_name'])) {
            $query->where('country_name', 'LIKE', '%' . $request['country_name'] . '%');
        }

        if (!empty($request['dialing_code'])) {
            $query->where('dialing_code', $request['dialing_code']);
        }

        $countries = $query->get();
        if ($countries->count() > 0) {
            return [
                'status' => 200,
                'data' => [$countries],
                'message' => $countries->count() . ' record found.',
            ];
        } else {
            return [
                'status' => 404,
                'data' => [],
                'message' => 'No Data Found',
            ];
        }
    }
}