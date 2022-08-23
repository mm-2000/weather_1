<?php
namespace App\Service;

class WeatherService
{
    public function getWeather($lat, $lng, $weatherApiKey): Array
    {
        $data = json_decode(file_get_contents($this->createAdress($lat, $lng, $weatherApiKey)));

        return $this->prepareWeatherData($data);
    }

    private function prepareWeatherData($data): Array
    {
        $result = array(
            'coord' => array('lat' => $data->coord->lat, 'lon' => $data->coord->lon),
            'temp_min' => $data->main->temp_min,
            'temp_max' => $data->main->temp_max,
            'temp' => $data->main->temp,
            'description' => $data->weather[0]->description,
            'wind_speed' => $data->wind->speed,
            'clouds' => $data->clouds->all,
            'name' => $data->name,
        );

        return $result;
    }

    private function createAdress($lat, $lng, $weatherApiKey): String
    {
        return "https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lng&appid=$weatherApiKey";
    }
}