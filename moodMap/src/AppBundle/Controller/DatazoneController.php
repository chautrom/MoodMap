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
		
		
		
		$jsonResponse = '{"erreur":false, "content-type":"List of Datazone", "content":"' . json_encode($data) . '"}';
		return new Response($jsonResponse);
    }
	
	
	/**
     * @Route("/getInfoZones")
     */
    public function getInfoZonesAction()
    {
		
        /**$em = $this->getDoctrine()->getManager();
		
		$requete=$em->createQuery('SELECT * FROM CRMCoreBundle:Zone z JOIN CRMCoreBundle:Datazone d')
			->getResult();
		
		echo $requete;**/
		
		$datazones = $this->getDoctrine()
			->getRepository('AppBundle:Datazone')
			->findAll();
			
		$zones = $this->getDoctrine()
			->getRepository('AppBundle:Zone')
			->findAll();
		
		
		$data = array();
		foreach ($datazones as $itemDatazone) {
			$d = array(
				'idZone' => $itemDatazone->getIdZone(),
				'score' => $itemDatazone->getScore(),
				'idCriteria' => $itemDatazone->getIdCriteria()
			);
			foreach ($zones as $itemZone){
				$z = array(
					'id' => $itemZone->getId(),
					'x' => $itemZone->getX(),
					'y' => $itemZone->getY(),
				);
				if($d['idZone'] == $z['id']){
					$res = array(
						'x' => $itemZone->getX(),
						'y' => $itemZone->getY(),
						'score' => $itemDatazone->getScore(),
						'idCriteria' => $itemDatazone->getIdCriteria()
					);
					array_push($data, $res);
				};


			};
		};
		
		
		$jsonResponse = '{"erreur":false, "content-type":"List of Datazone", "content":"' . json_encode($data) . '"}';
		return new Response($jsonResponse);
    }

}
