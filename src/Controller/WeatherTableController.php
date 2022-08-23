<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\WeatherRepository;

/**
 * @Route("/table")
 */
class WeatherTableController extends AbstractController
{
    /**
     * @Route("/", name="app_table")
     */
    public function index(WeatherRepository $weatherRepository): Response
    {
        return $this->render('table/table.html.twig', [
            'weathers' => $weatherRepository->findAll(),
            'tempMin' => $weatherRepository->findMinimalTemperature()[0]['tempX'],
            'tempMax' => $weatherRepository->findMaximalTemperature()[0]['tempX'],
            'tempAvg' => $weatherRepository->findAvgTemperature()[0]['tempX'],
            'topCity' => $weatherRepository->findTopCity()[0]['city'],
            'countRows' => $weatherRepository->findCountRows()[0]['summary'],  
        ]);
    }  
}