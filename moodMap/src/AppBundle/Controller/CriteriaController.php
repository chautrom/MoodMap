<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Criteria;

class CriteriaController extends Controller
{

	/**
     * @Route("/getCriterias")
     */
    public function getListeCriteriasAction()
    {
		
        $sriterias = $this->getDoctrine()
			->getRepository('AppBundle:Criteria')
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

}
