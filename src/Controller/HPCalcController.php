<?php
	namespace App\Controller;
	
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    
	use App\Entity\EngineStock;


	class HPCalcController extends Controller{

	    /**
	     * @Route("/")
	     */
		public function index(){
			//return new Response('<html><body>Hello!</body></html>');
			
			return $this->render('pages/index.html.twig');
		}

		/**
		 * @Route("/engine/add")
		 */
		public function add(){
		    $entityManager = $this->getDoctrine()->getManager();
		    
		    $engine = new EngineStock();
		    $engine->setManufacturer("Toyota");
		    $engine->setName("2JZ");
		    $engine->setProduction("1991-2007");
		    $engine->setBlockAlloy("Cast Iron");
		    $engine->setConfiguration("Straight-6");
		    $engine->setVavlvetrain("DOHC - 4 valves per cylinder");
		    $engine->setDisplacement("2997cc(3.0L)");
		    $engine->setHp(325);
		    $engine->setMaxHpAtRpm(5600);
		    $engine->setTorque(440);
		    $engine->setMaxTorqueAtRpm(4800);
		    $engine->setRedline(6800);
		    $engine->setLifespan(400000);
		    $engine->setMaxHpStock(750);
		    
		    $entityManager->persist($engine);
		    
		    $entityManager->flush();
		    
		    return new Response("New engine added with id:".$engine->getId());
		}
	}