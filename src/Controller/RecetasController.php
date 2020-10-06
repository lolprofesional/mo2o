<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RecetasController extends AbstractController
{
    /**
     * @Route("/recetas", name="recetas")
     */
    public function index()
    {
	
       return $this->json([]);
    }

    /**
     * @Route("/buscar/{food}", name="buscar")
     */
    public function buscar($food)
    {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.punkapi.com/v2/beers/$food");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json')); // Assuming you're requesting JSON
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$response = curl_exec($ch);
	// If using JSON...
	$data = json_decode($response)[0];
	 //id, nombre y descripción.

        return $this->json(["id" => $data->id,
							"nombre" => $data->name,
							"descripcion" => $data->description]);
	}
	
    /**
     * @Route("/busqueda_completa/{food}", name="busqueda_completa")
     */
    public function busqueda_completa($food)
    {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.punkapi.com/v2/beers/$food");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json')); // Assuming you're requesting JSON
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$response = curl_exec($ch);
		// If using JSON...
		$data = json_decode($response)[0];
		 //id, nombre y descripción. imagen, slogan (tagline) y cuando fue fabricada (first_brewed).
		 	return $this->render('recetas.html.twig',["id" => $data->id,
							"nombre" => $data->name,
							"descripcion" => $data->description,
							"image" => $data->image_url,
							"slogan" => $data->tagline,
							"fabricada" => $data->first_brewed
							]);

	}
}
