<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\WeatherService;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Weather;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @Route("/api/weather")
 */
class WeatherApiController extends AbstractController
{
    /**
     * @Route("/get", name="api_weather_get")
     */
    public function index(Request $request, WeatherService $weatherService, ManagerRegistry $doctrine): Response
    {
        $weatherApiKey = $this->getParameter('app.weatherapikey');
        $result = $weatherService->getWeather($request->request->get('lat'), $request->request->get('lng'), $weatherApiKey);
        $entityManager = $doctrine->getManager();
        $weather = new Weather();
        $weather->setCity($result['name']);
        $weather->setTemp($result['temp']);
        $weather->setTempMin($result['temp_min']);
        $weather->setTempMax($result['temp_max']);
        $weather->setWind($result['wind_speed']);
        $weather->setClouds($result['clouds']);
        $weather->setDescription($result['description']);
        $weather->setCreateTime(new \DateTime(date('Y-m-d H:i:s')));
        $entityManager->persist($weather);
        $entityManager->flush();
        return new JsonResponse($result);
    }  
}