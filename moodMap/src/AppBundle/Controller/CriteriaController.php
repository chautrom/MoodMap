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
		
        $criterias = $this->getDoctrine()
			->getRepository('AppBundle:Criteria')
			->findAll();
		
		
		/** creation d'un tableau permettant de stocker les donnees**/
		$data = array();
		foreach ($criterias as $item) {
			$i = array(
				'id' => $item->getId(),
				'iconpath' => $item->getIconpath(),
				'name' => $item->getName(),
			);

			array_push($data, $i);
		}
		
		return new Response(json_encode($data));
    }

}
