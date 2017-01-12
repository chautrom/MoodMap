<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Vote;

class VoteController extends Controller
{
	
	/**
     * @Route("/createVote")
     */
    public function createVoteAction()
    {
		//DataBase tools
		$entityManager 		= $this->getDoctrine()->getManager();
		$userRepository 	= $entityManager->getRepository('AppBundle:User');
		$voteRepository 	= $entityManager->getRepository('AppBundle:Vote');
		$criteriaRepository = $entityManager->getRepository('AppBundle:Criteria');
		
        //Messages d'erreur
		$NO_USERID_ERROR_MESSAGE 		= 'Data required : userId';
		$NO_COORDINATES_MESSAGE 		= 'Data required : coordinates x & y';
		$NO_CRITERA_MESSAGE				= 'Data required : idCriteria';
		$WRONG_DATA_SCORE				= 'Data out of bounds : score';
		$INEXISTANT_USER_MESSAGE		= 'Specified user does not exist';
		$INEXISTANT_CRITERIA_MESSAGE	= 'Specified criteria does not exist';
		$INEXISTANT_IDDATAZONE_MESSAGE 	= 'Specified id datazone does not exist';
		$DUPPLICATE_VOTE_MESSAGE		= 'Vote already exists';
		
		//Récupération des données de la requête HTTP
		$inputData = json_decode($this->get("request")->getContent(), true);
		//BOUCHON A SUPPRIMER APRES IMPLEMENTATION COMPLETE
		$idDataZone = 1;
		
		//Contrôle des données en entrée
		if(!isset($inputData['userId'])){
			return generateErrorResponse($NO_USERID_ERROR_MESSAGE);
		}
		if(!isset($inputData['x']) or !isset($inputData['y'])){
			return generateErrorResponse($NO_COORDINATES_MESSAGE);
		}
		if(!isset($inputData['idCriteria'])){
			return generateErrorResponse($NO_CRITERA_MESSAGE);
		}
		if(!isset($inputData['score'])){
			return generateErrorResponse($NO_SCORE_MESSAGE);
		}
		else{
			if(!is_numeric($inputData['score'])	 or $inputData['score'] < 0 or $inputData['score'] > 5){
				return generateErrorResponse($WRONG_DATA_SCORE);
			}
		}
		
		//Vérfications préalables
		//Existence de l'utilisateur
		
		$user = $userRepository->findOneBy(array('id' => $inputData['userId']));
		var_dump($user);
		if (!$user) {
			return generateErrorResponse($INEXISTANT_USER_MESSAGE);
		}
		
		//Existence du critère		
		$criteria = $criteriaRepository->findOneBy(array('id' => $inputData['idCriteria']));
		var_dump($criteria);
		if (!$criteria) {
			return generateErrorResponse($INEXISTANT_CRITERIA_MESSAGE);
		}
		
		//Existence de la dataZone
		//IMPLEMENTER LA REQUETE DES QUE POSSIBLE
		if (!isset($idDataZone)) {
			return generateErrorResponse($INEXISTANT_IDDATAZONE_MESSAGE);
		}
		
		//Verifier qu'un enregistrement identique (sauf score) n'existe pas déjà dans la table vote
		$vote="";
		$vote = $voteRepository->findOneBy(array('idUser' => $inputData['userId'],'idCriteria' => $inputData['idCriteria'],'idDatazone' => $idDataZone));
		var_dump($vote);
		if (isset($vote)) {
			if($vote->getScore() != $inputData['score'])
			{
				//Mise à jour du vote sur la zone et le critère donné s'il existe avec un score différent
				$vote->setScore($inputData['score']);
				$entityManager->flush();
				return new Response('{"erreur":false,"content":' . json_encode($vote) . ', "message":"Vote existed for input user, criteria and data zone: data updated"}');
			}
			//Si le vote existe avec le même score, erreur
			return generateErrorResponse($DUPPLICATE_VOTE_MESSAGE);
		}
		
		//Insertion du Vote
		$vote = new Vote();
		$vote->setIdUser($inputData['userId']);
		$vote->setIdCriteria($inputData['idCriteria']);
		$vote->setIdDataZone($idDataZone);
		$vote->setScore($inputData['score']);
		
		$entityManager->persist($vote);
		$res = $entityManager->flush();
		//Mise à jour du score moyen de la dataZone
		var_dump($res);
		$jsonResponseMessage =  '{"erreur":false,"message":"Everything was fine"}';
		return new Response($jsonResponseMessage);
    }
	
	/**
     * @Route("/updateVote")
     */
    public function updateVoteAction()
    {
        return $this->render('AppBundle:Vote:update_vote.html.php', array(
            // ...
        ));
    }
	
	/**
     * @Route("/getVotes")
     */
    public function getListeVotesAction()
    {
		
        $users = $this->getDoctrine()
			->getRepository('AppBundle:Vote')
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
	
	
	/**
     * @Route("/getAllVotesFromUser")
     */
    public function getAllVotesFromUserAction()
    {
        return $this->render('AppBundle:Vote:get_all_votes_from_user.html.php', array(
            // ...
        ));
    }


}

//A METTRE AILLEURS
function generateErrorResponse($message){
	$jsonErrorMessage =  '{"erreur":true,"message":'. $message . '}';
	return new Response($jsonErrorMessage);
}
