<?php
	namespace App\Controller;
	
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Doctrine\ORM\Tools\Setup;
	use Doctrine\ORM\EntityManager;
    
	use App\Entity\EngineStock;


	class HPCalcController extends Controller{

	    /**
	     * @Route("/", name="engine_list_home")
	     */
		public function index(){
			$engines= $this->getDoctrine()->getRepository(EngineStock::class)->findAll();
			
			if($engines){
    			foreach ( $engines as $engine){
    			    //add_default_engines($engine);
    			    echo "engine with id:".$engine->getId();
    			}
			}else{
			    //add_default_engines(array(""));
			}
			
			return $this->render('pages/index.html.twig', array('engines' => $engines));
		}
		
		/**
		 * @Route("/engine/{id}", name="engine_show")
		 */
		public function show($id){
		    $engine= $this->getDoctrine()->getRepository(EngineStock::class)->find($id);
		    
		    return $this->render('pages/show-engine.html.twig', array('engine' => $engine));
		}
		
		private function add_default_engines($engine){
		    
		    
		    $twojz = new EngineStock();
		    $twojz->setManufacturer("Toyota");
		    $twojz->setName("2jz");
		    $twojz->setProduction("1991-2007");
		    $twojz->setBlockAlloy("Cast Iron");
		    $twojz->setConfiguration("Straight-6");
		    $twojz->setVavlvetrain("DOHC - 4 valves per cylinder");
		    $twojz->setDisplacement("2997cc(3.0L)");
		    $twojz->setHp(325);
		    $twojz->setMaxHpAtRpm(5600);
		    $twojz->setTorque(440);
		    $twojz->setMaxTorqueAtRpm(4800);
		    $twojz->setRedline(6800);
		    $twojz->setLifespan(400000);
		    $twojz->setMaxHpStock(750);
		    
		    return new Response("New engine added with id:".$twojz->getId());
		}
	}