<?php

/*
 * (c) Nils Bohrs
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * controller for the v2 api calls (navi)
 */
class NaviController extends Controller {
	
	/**
	 * @Route("/api/v2/navi/", name="v2navihome")
	 */
	public function indexAction(Request $request) {
		
	    // get all entries level 0 (parent == NULL)
	    $repositoryNavi = $this->getDoctrine()->getRepository('AppBundle:Navi');
	    $naviEntries = $repositoryNavi->findBy(
	        array(
	            'parent' => null,
	            'valid' => true,
	            'show' => true
	        ),
	        array('position' => 'ASC')
        );
	    
	    // walk through entries and get tree
	    $naviTree = array();
	    foreach($naviEntries as $entry) {
	        // exclude "homepage"
	        if($entry->getId() != 1) {
	            $naviTree[] = $entry->getNaviTree(2, 1);
	        }
	    }
        
	    var_dump($naviTree);
	    
		return $this->render('default/index.html.twig');
	}
}
