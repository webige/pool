<?php
/**
 * Created by PhpStorm.
 * User: jedy
 * Date: 8/27/18
 * Time: 4:21 AM
 */

namespace App\Helpers\Request;


class BtcCalculator
{
    protected $afterDecimal = 14;

    protected $response;

    protected $hashrate;
    protected $rate;

    private function calculation(){
        $client = new \GuzzleHttp\Client();
        $this->hashrate =  $this->hashrate*1000000000000 ;
        $this->hashrate = sprintf('%f',$this->hashrate);
        $client = $client->get("https://alloscomp.com/bitcoin/calculator/json?hashrate=$this->hashrate&exchange_rate=$this->rate");
        $this->response = json_decode($client->getBody()->getContents());

    }

    public function calculate($hashrate, $rate)
    {
        $this->hashrate = $hashrate;
        $this->rate = $rate;
        $this->calculation();
        return $this->response;
    }

    public function calculateAnd($hashrate, $rate)
    {
        $this->hashrate = $hashrate;
        $this->rate = $rate;
        $this->calculation();
        return $this;
    }


    public function generify()
    {
        return [
            'coinsPerHour'=> number_format((float)$this->response->coins_per_hour , 10, '.', ''),
            'coinsPerDay'=> number_format((float)$this->response->coins_per_hour * 24, 10, '.', ''),
            'usdPerHour'=> number_format((float)$this->response->dollars_per_hour, 10, '.', ''),
            'usdPerDay' => number_format((float)$this->response->dollars_per_hour * 24, 10, '.', '')
        ];

    }
}