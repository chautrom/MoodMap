<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use Symfony\Component\HttpKernel\Kernel;

class UserController extends Controller
{
    /**
     * @Route("/createUser")
     */
    public function createUserAction()
    {
		//DataBase tools
		$entityManager 				= $this->getDoctrine()->getManager();
		$userRepository 			= $entityManager->getRepository('AppBundle:User');		
        	//Messages d'erreur
		$NO_USERNAME_ERROR_MESSAGE 		= 'Data required : username';
		$NO_EMAIL_MESSAGE			= 'Data required : email';
		$NO_PASSWORD_MESSAGE 			= 'Data required : password';
		$USER_ALREADY_EXISTS_USERNAME 	= 'User already exists for this username';
		$USER_ALREADY_EXISTS_EMAIL 		= 'User already exists for this email';
		
		//Récupération des données de la requête HTTP
		$inputData = json_decode($this->get("request")->getContent(), true);

		
		//Contrôle des données en entrée
		if(!isset($inputData['name'])){
			return UserController::generateErrorResponse($NO_USERNAME_ERROR_MESSAGE);
		}
		if(!isset($inputData['email'])){
			return UserController::generateErrorResponse($NO_EMAIL_MESSAGE);
		}
		if(!isset($inputData['password'])){
			return UserController::generateErrorResponse($NO_PASSWORD_MESSAGE);
		}
		
		
		//Vérfications préalables
		//Non existence de l'utilisateur par username
		$user = $userRepository->findOneBy(array('username' => $inputData['name']));
		if ($user) {
			return UserController::generateErrorResponse($USER_ALREADY_EXISTS_USERNAME . ': '. $inputData['name']);
			//return UserController::generateErrorResponse($USER_ALREADY_EXISTS_USERNAME. ': ' . $inputData['name']);
		}
		
		//Non existence de l'utilisateur par email
		$user = $userRepository->findOneBy(array('email' => $inputData['email']));
		if ($user) {
			return UserController::generateErrorResponse($USER_ALREADY_EXISTS_EMAIL . ': '. $inputData['email']);
			//return UserController::generateErrorResponse($USER_ALREADY_EXISTS_EMAIL . ': ' . $email);
		}			
		//Génération du challenge aléatoire
		$randomChallenge = md5(random_bytes(10));
		
		//Insertion du Vote
		$user = new user();
		$user->setUsername($inputData['name']);
		$user->setEmail($inputData['email']);
		$user->setPassword(md5($inputData['password']));
		$user->setActivated(false);
		$user->setChallenge($randomChallenge);
		
		$entityManager->persist($user);
		$res = $entityManager->flush();

		/* send message to user*/

		$message = \Swift_Message::newInstance();
        	$message->setSubject("Confirmation de la création du compte");
		$message->setFrom('teammoodmap@gmail.com');
        	$message->setTo($inputData['email']);
        	// pour envoyer le message en HTML
        	$message->setBody('<html>
<head>
<title>Hello World!</title>
</head>
<body>
<b>Merci de cliquer sur le lien suivant pour activer votre compte :</b></br>
<a href="http://192.168.12.25:8000/confirmUser?username='.$username.'&challenge='.$randomChallenge.'">Ici</a>
</body>
</html> <html><body></body></html>','text/html'); 
        	//envoi du message
        	$result = $this->get('mailer')->send($message);		
		$jsonResponseMessage =  '{"erreur":false,"content-type": "User","content": "{"id":"'. $user->getId().'","username":"'.$user->getUsername() .'"}"}';
		return new Response($jsonResponseMessage);
	/*$jsonResponseMessage =  '{"status":false,"content-type": "User","content": "{"id":"'. $user->getId().'","username":"'.$user->getUsername() .'"}"}';
	return new Response($jsonResponseMessage);*/
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
		
		$jsonResponseMessage =  '{"erreur":false,"content-type": "List de User","content":' . json_encode($data) . '}';
		return new Response($jsonResponseMessage);
    }
  
   /**
     * @Route("/connectUser")
     */
  public  function connectUser()
  {
	//Récupération des données de la requête HTTP
	$inputData = json_decode($this->get("request")->getContent(), true);
	$entityManager 		= $this->getDoctrine()->getManager();
	$userRepository 	= $entityManager->getRepository('AppBundle:User');
	//Messages d'erreur
	$NO_USERNAME_ERROR_MESSAGE 		= 'Data required : username';
	$NO_EMAIL_MESSAGE				= 'Data required : email';
	$NO_PASSWORD_MESSAGE 			= 'Data required : password';
	$INCORRECT_PASSWORD				= 'Incorrect password';
	$USER_DOESNT_EXIST_MESSAGE		= 'Specified user does not exist';

	//Contrôle des données en entrée
	if(!isset($inputData['name'])){
	  	return UserController::generateErrorResponse($NO_USERNAME_ERROR_MESSAGE);
	}
	if(!isset($inputData['password'])){
		return UserController::generateErrorResponse($NO_PASSWORD_MESSAGE);
	}

	$user = $userRepository->findOneBy(array('username' => $inputData['name']));	
	if( !$user )
	{
		return UserController::generateErrorResponse($USER_DOESNT_EXIST_MESSAGE);
	}
        if( !$user->getActivated() )
	{
		$jsonResponseMessage =  '{"status": "failure", "message":"Please activate your account first"}';
		return new Response($jsonResponseMessage);
	}
	
	$HashPassword =  md5($inputData['password']);
	if ( $HashPassword == $user->getPassword() ){
		$user->setActivated(true);
		$entityManager->persist($user);
		$res = $entityManager->flush();		
		$jsonResponseMessage =  '{"erreur":false,"content-type": "User","content":{"id":"'. $user->getId().'","username":"'.$user->getUsername() .'"}}';
		return new Response($jsonResponseMessage);
	}

	return UserController::generateErrorResponse($INCORRECT_PASSWORD);	
  }


	/**
     * @Route("/confirmUser")
     */
	public  function confirmUser()
	{
		$NO_ACCESS_MESSAGE 		= 'You don\'t have the permission to access on this server -_-';
		$ATTACK_SERVER_MESSAGE	= 'Don\'t try to attack our server -_- ';
		$username  = $_GET['username'];
		$challenge = $_GET['challenge'];
	
		//DataBase tools
		$entityManager 	= $this->getDoctrine()->getManager();
		$userRepository = $entityManager->getRepository('AppBundle:User');
	
		$user = $userRepository->findOneBy(array('username' => $username));
		if(!$user){
			return UserController::generateErrorResponse($NO_ACCESS_MESSAGE);
		}
		
		if( $challenge == $user->getChallenge() )
		{
			$user->setActivated(true);
			$entityManager->persist($user);
			$res = $entityManager->flush();
				return new Response("Welcome to our application, Moodmap :). You can now acces the server.");
			}
	
		return UserController::generateErrorResponse($ATTACK_SERVER_MESSAGE);
				
	}
	
	public static function generateErrorResponse($message){
		$jsonErrorMessage =  '{"erreur":true,"message":"'. $message . '"}';
		return new Response($jsonErrorMessage);
	}

	
}
