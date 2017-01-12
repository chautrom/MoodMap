<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Zone;

class ZoneController extends Controller
{

	/**
     * @Route("/getZones")
     */
    public function getZonesAction()
    {
		//DataBase tools
		$entityManager 		= $this->getDoctrine()->getManager();
		$userRepository 	= $entityManager->getRepository('AppBundle:User');
		$voteRepository 	= $entityManager->getRepository('AppBundle:Vote');
		$criteriaRepository = $entityManager->getRepository('AppBundle:Criteria');
		
		
		//Récupération des données de la requête HTTP
		$inputData = json_decode($this->get("request")->getContent(), true);
		
		//Contrôle des données en entrée
		if(!isset($inputData['x']) or !isset($inputData['y'])){
			return ZoneController::generateErrorResponse($NO_COORDINATES_MESSAGE);
		}
		
		//Vérfications préalables
		//Existence de l'utilisateur
		
		$user = $userRepository->findOneBy(array('id' => $inputData['userId']));

        $zones = $this->getDoctrine()
			->getRepository('AppBundle:Zone')
			->findAll();
		
		//echo print_r($users, true);
		
		$data = array();
		
		/*foreach ($users as $item) {
			$i = array(
				'id' => $item->getId(),
				'username' => $item->getUsername(),
				'email' => $item->getEmail(),
				'activated' => $item->getActivated()
			);

			array_push($data, $i);
		}*/
		
		return new Response(json_encode($data));
    }

    public static function generateErrorResponse($message){
		$jsonErrorMessage =  '{"erreur":true,"message":'. $message . '}';
		return new Response($jsonErrorMessage);
	}
}
