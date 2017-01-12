<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Datazone;

class DatazoneController extends Controller
{

	/**
     * @Route("/getDatazones")
     */
    public function getListeDatazonesAction()
    {
		
        $datazones = $this->getDoctrine()
			->getRepository('AppBundle:Datazone')
			->findAll();
		
		
		$data = array();
		foreach ($datazones as $item) {
			$i = array(
				'id' => $item->getId(),
				'score' => $item->getScore(),
				'idZone' => $item->getIdZone(),
				'idCriteria' => $item->getIdCriteria()
			);

			array_push($data, $i);
		}
		
		return new Response(json_encode($data));
    }

}
