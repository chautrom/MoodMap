<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;

class UserController extends Controller
{
	/**
     * @Route("/createUser")
     */
    public function createUserAction()
    {
		//DataBase tools
		$entityManager 		= $this->getDoctrine()->getManager();
		$userRepository 	= $entityManager->getRepository('AppBundle:User');
		
        //Messages d'erreur
		$NO_USERNAME_ERROR_MESSAGE 		= 'Data required : username';
		$NO_EMAIL_MESSAGE				= 'Data required : email';
		$NO_HASH_PW_MESSAGE 			= 'Data required : hash password';
		$USER_ALREADY_EXISTS_USERNAME 	= 'User already exists for this username';
		$USER_ALREADY_EXISTS_EMAIL 		= 'User already exists for this email';
		
		//Récupération des données de la requête HTTP
		$inputData = json_decode($this->get("request")->getContent(), true);
		
		//Contrôle des données en entrée
		var_dump($inputData);
		if(!isset($inputData['name'])){
			return UserController::generateErrorResponse($NO_USERNAME_ERROR_MESSAGE);
		}
		if(!isset($inputData['email'])){
			return UserController::generateErrorResponse($NO_EMAIL_MESSAGE);
		}
		if(!isset($inputData['hashPassword'])){
			return UserController::generateErrorResponse($NO_HASH_PW_MESSAGE);
		}
		
		
		//Vérfications préalables
		//Non existence de l'utilisateur par username
		$user = $userRepository->findOneBy(array('username' => $inputData['name']));
		var_dump($user);
		if ($user) {
			return UserController::generateErrorResponse($USER_ALREADY_EXISTS_USERNAME. ': ' . $inputData['name']);
		}
		
		//Non existence de l'utilisateur par email
		$user = $userRepository->findOneBy(array('email' => $inputData['email']));
		var_dump($user);
		if ($user) {
			return UserController::generateErrorResponse($USER_ALREADY_EXISTS_EMAIL . ': ' . $inputData['email']);
		}
		
		
		//Génération du challenge aléatoire
		$randomChallenge = random_bytes(10);
		
		//Insertion du Vote
		$user = new user();
		$user->setUsername($inputData['name']);
		$user->setEmail($inputData['email']);
		$user->setPassword(md5($inputData['hashPassword']));
		$user->setActivated(false);
		$user->setChallenge($randomChallenge);
		
		$entityManager->persist($user);
		$res = $entityManager->flush();
		//Mise à jour du score moyen de la dataZone
		
		$jsonResponseMessage =  '{"erreur":false,"message":"Everything was fine"}';
		return new Response($jsonResponseMessage);
    }

	/**
     * @Route("/getUsers")
     */
    public function getListeUsersAction()
    {
        $users = $this->getDoctrine()
			->getRepository('AppBundle:User')
			->findAll();
		
		//echo print_r($users, true);
		
		$data = array();
		foreach ($users as $item) {
			$i = array(
				'id' => $item->getId(),
				'username' => $item->getUsername(),
				'email' => $item->getEmail(),
				'activated' => $item->getActivated()
			);

			array_push($data, $i);
		}
		
		return new Response(json_encode($data));
    }

	public static function generateErrorResponse($message){
		$jsonErrorMessage =  '{"erreur":true,"message":'. $message . '}';
		return new Response($jsonErrorMessage);
	}
	
}
