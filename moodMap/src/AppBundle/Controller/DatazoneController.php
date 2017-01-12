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
		
		
		
		$jsonResponse = '{"erreur":false, "content-type":"List of Datazone", "content":' . json_encode($data) . '}';
		return new Response($jsonResponse);
    }
	

	
	/**
     * @Route("/getInfoZones")
     */
    public function getInfoZonesAction()
    {
		$qb = $this->getDoctrine()->getManager()->createQuery(
		'SELECT z.x,z.y,d.score,d.idCriteria FROM AppBundle:Zone z JOIN AppBundle:Datazone d WHERE z.id = d.idZone');
		$data=$qb->getResult();
		
		$jsonResponse = '{"erreur":false, "content-type":"List of Datazone", "content":' . json_encode($data) . '}';
		
		$jsonResponse = '{"erreur":false, "content-type":"List of Datazone", "content":' . json_encode($data) . '}';
		return new Response($jsonResponse);
    }

}
