<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Vote;
use AppBundle\Entity\Zone;
use AppBundle\Entity\Datazone;
use AppBundle\Utils\Utils;


class VoteController extends Controller
{
	
	/**
     * @Route("/createVote")
	 * Si le vote existe avec un score différent, il est mis à jour. Rejet s'il existe avec le même score
     */
    public function createVoteAction()
    {

		//DataBase tools
		$entityManager 		= $this->getDoctrine()->getManager();
		$userRepository 	= $entityManager->getRepository('AppBundle:User');
		$voteRepository 	= $entityManager->getRepository('AppBundle:Vote');
		$criteriaRepository = $entityManager->getRepository('AppBundle:Criteria');
		$datazoneRepository	= $entityManager->getRepository('AppBundle:Datazone');
		$zoneRepository		= $entityManager->getRepository('AppBundle:Zone');
		
        //Messages d'erreur
		$NO_USERID_ERROR_MESSAGE 		= 'Data required : userId';
		$NO_COORDINATES_MESSAGE 		= 'Data required : coordinates x & y';
		$NO_CRITERA_MESSAGE				= 'Data required : idCriteria';
		$WRONG_DATA_SCORE				= 'Data out of bounds : score';
		$INEXISTANT_USER_MESSAGE		= 'Specified user does not exist';
		$INEXISTANT_CRITERIA_MESSAGE	= 'Specified criteria does not exist';
		$INEXISTANT_ZONE_MESSAGE 		= 'Specified zone does not exist';
		$INEXISTANT_DATAZONE_MESSAGE 	= 'Specified datazone does not exist';
		$DUPPLICATE_VOTE_MESSAGE		= 'Vote already exists';
		
		//Récupération des données de la requête HTTP
		$inputData = json_decode($this->get("request")->getContent(), true);		
		//Contrôle des données en entrée
		if(!isset($inputData['userId'])){
			return VoteController::generateErrorResponse($NO_USERID_ERROR_MESSAGE);
		}
		if(!isset($inputData['x']) or !isset($inputData['y'])){
			return VoteController::generateErrorResponse($NO_COORDINATES_MESSAGE);
		}
		if(!isset($inputData['idCriteria'])){
			return VoteController::generateErrorResponse($NO_CRITERA_MESSAGE);
		}
		if(!isset($inputData['score'])){
			return VoteController::generateErrorResponse($NO_SCORE_MESSAGE);
		}
		else{
			if(!is_numeric($inputData['score'])	 or $inputData['score'] < 0 or $inputData['score'] > 5){
				return VoteController::generateErrorResponse($WRONG_DATA_SCORE);
			}
		}
		
		//Vérfications préalables
		//Existence de l'utilisateur
		
		$user = $userRepository->findOneBy(array('id' => $inputData['userId']));
		//var_dump($user);
		if (!$user) {
			return VoteController::generateErrorResponse($INEXISTANT_USER_MESSAGE);
		}
		
		//Existence du critère		
		$criteria = $criteriaRepository->findOneBy(array('id' => $inputData['idCriteria']));
		//var_dump($criteria);
		if (!$criteria) {
			return VoteController::generateErrorResponse($INEXISTANT_CRITERIA_MESSAGE);
		}
		//Existence de la zone
		$zone = $zoneRepository->findOneBy(array("x" => $inputData['x'], "y" => $inputData['y']));
		if (!isset($zone)) {
			//Creation de la zone
			$zone = new Zone();
			$zone->setName("CreatedZone");	
			$zone->setX($inputData['x']);
			$zone->setY($inputData['y']);	
			$zone->setR(0);	
			
			$entityManager->persist($zone);
			$res = $entityManager->flush();
			
			//Creation de la datazone correspondante
			$datazone = new Datazone();
			$datazone->setIdZone($zone->getId());
			$datazone->setIdCriteria($inputData['idCriteria']);
			$datazone->setScore(0);
			$datazone->setScore(0);
			
			$entityManager->persist($datazone);
			$res = $entityManager->flush();
		}
		//Existence de la datazone
		$datazone = $datazoneRepository->findOneBy(array('idZone' => $zone->getId(), 'idCriteria' => $inputData['idCriteria']));
		//var_dump($datazone);
		if (!isset($datazone)) {
			//Creation de la datazone (ne devrait pas passer par ici)
			$datazone = new Datazone();
			$datazone->setIdZone($zone->getId());
			$datazone->setIdCriteria($inputData['idCriteria']);
			$datazone->setScore($inputData['score']);
			
			$entityManager->persist($datazone);
			$res = $entityManager->flush();
		}	
		//Verifier qu'un enregistrement identique (sauf score) n'existe pas déjà dans la table vote
		$vote="";
		$vote = $voteRepository->findOneBy(array('idUser' => $inputData['userId'],'idCriteria' => $inputData['idCriteria'],'idDatazone' => $datazone->getId()));
		//var_dump($vote);
		if (isset($vote)) {
			if($vote->getScore() != $inputData['score'])
			{
				//Mise à jour du vote sur la zone et le critère donné s'il existe avec un score différent
				$vote->setScore($inputData['score']);
				$entityManager->flush();
				$jsonReturnObject = '{"id":' . $vote->getId() . ',"idUser":' . $vote->getIdUser() . ',"idCriteria":' . $vote->getIdCriteria() . ',"idDatazone":' . $vote->getIdDatazone() . ',"score":' . $vote->getScore() . '}';
				//Reponse par défaut
				return new Response('{"erreur":false,"content-type":"Vote","content":"' . $jsonReturnObject . '"}');
			}
			//Si le vote existe avec le même score, erreur
			return VoteController::generateErrorResponse($DUPPLICATE_VOTE_MESSAGE);
		}
		
		//Insertion du Vote
		$vote = new Vote();
		$vote->setIdUser($inputData['userId']);
		$vote->setIdCriteria($inputData['idCriteria']);
		$vote->setIdDataZone($datazone->getId());
		$vote->setScore($inputData['score']);
		
		$entityManager->persist($vote);
		$res = $entityManager->flush();
		//Mise à jour du score moyen de la dataZone
		//Récupération de tous les votes liées à la zone
		$allVotes = $voteRepository->findBy(array('idDatazone' => $vote->getIdDatazone(), 'idCriteria' => $vote->getIdCriteria()));
		//var_dump($allVotes);
		
		//calcul de la moyenne
		$moy = 0;
		foreach($allVotes as $aVote){
			$moy += $aVote->getScore();
		}
		$moy = $moy/count($allVotes);
		
		//Mise à jour de la datazone
		$datazone->setScore($moy);
		$entityManager->flush();
		
		
		$jsonReturnObject = '{"id":' . $vote->getId() . ',"idUser":' . $vote->getIdUser() . ',"idCriteria":' . $vote->getIdCriteria() . ',"idDatazone":' . $vote->getIdDatazone() . ',"score":' . $vote->getScore() . '}';
		//Reponse par défaut
		$jsonResponseMessage =  '{"erreur":false,"content-type":"Vote","content":"' . $jsonReturnObject . '"}';
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
		//A NE PAS APPELER
		$jsonResponse =  '{"erreur":false,"content-type":"Text","message":"This method has not yet been implemented: no treatment was performed."}';
		return new Response($jsonResponse);
    }
	
	
	/**
     * @Route("/getAllVotesFromUser")
     */
    public function getAllVotesFromUserAction()
    {
		//DataBase tools
		$entityManager 		= $this->getDoctrine()->getManager();
		$userRepository 	= $entityManager->getRepository('AppBundle:User');
		$voteRepository		= $entityManager->getRepository('AppBundle:Vote');
		$datazoneRepository	= $entityManager->getRepository('AppBundle:Datazone');
		$zoneRepository		= $entityManager->getRepository('AppBundle:Zone');
		
        //Messages d'erreur
		$NO_USERID_ERROR_MESSAGE 		= 'Data required : userId';
		$INEXISTANT_USER_MESSAGE		= 'Specified user does not exist';
		
		//Récupération des données de la requête HTTP
		$inputData = json_decode($this->get("request")->getContent(), true);		
		//Contrôle des données en entrée
		if(!isset($inputData['userId'])){
			return VoteController::generateErrorResponse($NO_USERID_ERROR_MESSAGE);
		}
		
		//Vérfications préalables
		//Existence de l'utilisateur
		
		$user = $userRepository->findOneBy(array('id' => $inputData['userId']));
		if (!$user) {
			return VoteController::generateErrorResponse($INEXISTANT_USER_MESSAGE);
		}
		
		$allVotes = $entityManager->createQuery('SELECT v.id as ID, c.id as ID_CRITERE,c.name as NAME, v.score as SCORE, z.x as LONGITUDE, z.y AS LATITUDE FROM AppBundle:Vote v, AppBundle:Datazone d, AppBundle:Zone z, AppBundle:Criteria c WHERE v.idUser =' . $inputData['userId'] . 'AND v.idDatazone = d.id AND d.idZone = z.id AND c.id = d.idCriteria')->getResult();
		
		$jsonResponseMessage =  '{"erreur":false,"content-type": "Liste de Vote","content":' . json_encode($allVotes) . '}';
		return new Response($jsonResponseMessage);
    }
	
	
	public static function generateErrorResponse($message){
		$jsonErrorMessage =  '{"erreur":true,"message":"'. $message . '"}';
		return new Response($jsonErrorMessage);
	}


}
