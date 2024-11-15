<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    //
    public function fetchCurrency()
    {
        $client = new Client();
        $url = 'https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/usd.json';
        try {
            $response = $client->request('GET', $url);

            $body = $response->getBody()->getContents();

            $data = json_decode($body, true);
            $row = Currency::where('date', $data["date"])->first();
            $data_insert = $data["usd"];
            $data_insert['date'] = $data["date"];
            if(!$row){
                $currency = Currency::create($data_insert);
            }else{
                $currency = Currency::where("date", $data["date"])->update($data_insert);
            }
            return response()->json(["response_code" => "200", 'response_message' => "Berhasil Fetch Currency!"], 200);
        } catch (\Exception $th) {
            return response()->json(["response_code" => "500",'response_message' => $th->getMessage()], 500);
        }
    }
    public function getCurrency()
    {
        try {
            $now = Carbon::now()->toDateString();
            $row = Currency::where('date', $now )->first();
            return response()->json(["response_code" => "200", 'response_message' => "Berhasil Mendapatkan Currency!", "data"=>$row], 200);
        } catch (\Exception $th) {
            return response()->json(["response_code" => "500",'response_message' => $th->getMessage()], 500);
        }
    }
}
