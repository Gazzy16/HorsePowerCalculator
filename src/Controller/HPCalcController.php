<?php
	namespace App\Controller;
	
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Doctrine\ORM\Tools\Setup;
	use Doctrine\ORM\EntityManager;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\Extension\Core\Type\TextareaType;
	use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
	use Symfony\Component\Form\Extension\Core\Type\IntegerType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\Form\Forms;
	use App\Entity\EngineStock;
	use App\Entity\User;
	use App\Entity\Upgrade;
    use App\Form\LoginFormType;
	use App\Form\RegisterFormType;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\RedirectResponse;                        
use App\Entity\EngineTuned;
                
    class HPCalcController extends AbstractController{

	    /**
	     * @Route("/", name="engine_list_home")
	     */
		public function index(){
			$engines= $this->getDoctrine()->getRepository(EngineStock::class)->findAll();
			$tuned_engines = $this->getDoctrine()->getRepository(EngineTuned::class)->findAll();
			
			return $this->render('pages/index.html.twig', array('engines' => $engines, 'tuned' => $tuned_engines));
		}
		
		/**
		 * @Route("/profile", name="profile")
		 */
		public function profile(){
		    $id = $this->get('session')->get('id');
		    if(null){
		        return $this->redirectToRoute('login');
		    }else{
		        $engines= $this->getDoctrine()->getRepository(EngineStock::class)->findAllByUserId($id);
		        $tuned_engines = $this->getDoctrine()->getRepository(EngineTuned::class)->findAll($id);
		    }
		    
		    return $this->render('pages/profile.html.twig', array('engines' => $engines, 'tuned_engines' => $tuned_engines));
		}
		
		/**
		 * @Route("/stock/engine/add", name="new_engine") 
		 * @Method({"GET", "POST"})
		 */
		public function new_engine(Request $request){
		    $id = $this->get('session')->get('id');
		    
		    if($id == NULL){
		         return $this->redirectToRoute('login');
		    }else{
		        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
    		    $engine = new EngineStock();
    		    $form = $this->createFormBuilder($engine)
    		    ->add('manufacturer', TextType::class, array('attr' => array('class' => 'form-control form-control-sm')))
    		    ->add('name', TextType::class, array('attr' => array('class' => 'form-control form-control-sm')))
    		    ->add('block_alloy', ChoiceType::class, ['choices'  => ['Cast Iron (default)' => 'cast iron', 'Aluminium alloy' => 'aluminium alloy'],], array('attr' => array('class' => 'form-control form-control-sm')))
    		    ->add('configuration', ChoiceType::class, ['choices'  => ['Inline (default)' => 'Inline', 'V-shaped' => 'V-shaped', 'W-shaped' => 'W-shaped'],], array('attr' => array('class' => 'form-control form-control-sm')))    		    
    		    ->add('piston_stroke', IntegerType::class, array('attr' => array('class' => 'form-control form-control-sm')))
    		    ->add('cylinder_bore', IntegerType::class, array('attr' => array('class' => 'form-control form-control-sm')))
    		    ->add('number_of_cylinders', IntegerType::class, array('attr' => array('class' => 'form-control form-control-sm')))
    		    ->add('valves_per_cylinder', ChoiceType::class, ['choices'  => ['3 valves per cylinder' => '3', '4 vlves per cylinder (default)' => '4', '5 valves per cylinder' => '5'],], array('attr' => array('class' => 'form-control form-control-sm')))
    		    ->add('displacement', IntegerType::class, array('attr' => array('class' => 'form-control form-control-sm')))
    		    ->add('hp', IntegerType::class, array('attr' => array('class' => 'form-control form-control-sm')))
    		    ->add('torque', IntegerType::class, array('attr' => array('class' => 'form-control form-control-sm')))
    		    ->add('redline', IntegerType::class, array('attr' => array('class' => 'form-control form-control-sm')))
    		    ->add('save', SubmitType::class, array('label' => 'Add Engine', 'attr' => array('class' => 'btn btn-secondary')))
    		    ->getForm();
    		    $form->handleRequest($request);
    		    if($form->isSubmitted() && $form->isValid()){
    		        $engine = $form->getData();
    		        $engine->setUserStockId($user);
    		        $set_max_hp = $engine->getHp() / 3;
    		        $set_max_hp += $engine->getHp();
    		        $engine->setMaxHpStock($set_max_hp);
    		        $entityManager = $this->getDoctrine()->getManager();
    		        $entityManager->persist($engine);
    		        $entityManager->flush();
    		        
    		        return $this->redirectToRoute('engine_show', array('id' => $engine->getId()));
    		    }
		    }
		    return $this->render('pages/engine_new.html.twig', array('form' => $form->createView()));
		 }
		
		/**
		 * @Route("/engine/{id}", name="engine_show")
		 * @Method({"GET", "POST"})
		 */
		public function show($id){
		    $engine = $this->getDoctrine()->getRepository(EngineStock::class)->find($id);
		    
		    return $this->render('pages/show_engine.html.twig', array('engine' => $engine));
		}
		
		/**
		 * @Route("/stock/engine/default", name="default_engines")
		 * @Method({"GET", "POST"})
		 */
		public function default(){
		    
		    $twojz = new EngineStock();
		    $twojz->setManufacturer("Toyota");
		    $twojz->setName("2jz");
		    $twojz->setBlockAlloy("Cast Iron");
		    $twojz->setConfiguration("Straight-6");
		    $twojz->setValvetrain("DOHC - 4 valves per cylinder");
		    $twojz->setDisplacement(2997);
		    $twojz->setHp(325);
		    $twojz->setMaxHpAtRpm(5600);
		    $twojz->setTorque(440);
		    $twojz->setMaxTorqueAtRpm(4800);
		    $twojz->setRedline(6800);
		    $twojz->setLifespan(400000);
		    $twojz->setMaxHpStock(750);
		
		    $entityManager = $this->getDoctrine()->getManager();
		    $entityManager->persist($twojz);
		    $entityManager->flush();
		    
		    return $this->redirectToRoute('engine_show', array('id' => $twojz->getId()));
		}
		
		/**
		 * @Route("/engine/{id}/upgrade", name="engine_upgrade")
		 * @Method({"GET", "POST"})
		 */
		public function upgrade_engine($id, Request $request){
		    $user_id = $this->get('session')->get('id');
		    if($user_id == NULL){
		        return $this->redirectToRoute('engine_list_home');
		    }else{
		      $user = $this->getDoctrine()->getRepository(User::class)->find($user_id);
		      $engine = $this->getDoctrine()->getRepository(EngineStock::class)->find($id);  
		      $upgrade = new Upgrade();
		      
		      $form = $this->createFormBuilder($upgrade)
		      ->add('forced_induction', ChoiceType::class, ['choices'  => ['None' => 'none', 'Turbocharger' => 'turbo', 'Supercharger' => 'supercharger'],], array('attr' => array('class' => 'form-control form-control-sm')))
		      ->add('psi', IntegerType::class, array('attr' => array('class' => 'form-control form-control-sm')))
		      ->add('intake', ChoiceType::class, ['choices'  => ['Stock' => 'stock', 'Street' => 'street', 'Sport' => 'sport', 'Deleted' => 'deleted'],], array('attr' => array('class' => 'form-control form-control-sm')))
		      ->add('ecu', ChoiceType::class, ['choices'  => ['Stock' => 'stock', 'Street' => 'street', 'Sport' => 'sport', 'Type R' => 'type r'],], array('attr' => array('class' => 'form-control form-control-sm')))
		      ->add('pistons', ChoiceType::class, ['choices'  => ['Stock' => 'stock', 'Street' => 'street', 'Sport' => 'sport', 'Type R' => 'type r'],], array('attr' => array('class' => 'form-control form-control-sm')))
		      ->add('intercooler', ChoiceType::class, ['choices'  => ['Stock' => 'stock', 'Street' => 'street', 'Sport' => 'sport', 'Type R' => 'type r'],], array('attr' => array('class' => 'form-control form-control-sm')))
		      ->add('exhaust', ChoiceType::class, ['choices'  => ['Stock' => 'stock', 'Street' => 'street', 'Sport' => 'sport', 'Type R' => 'type r'],], array('attr' => array('class' => 'form-control form-control-sm')))
		      ->add('save', SubmitType::class, array('label' => 'Apply Upgrades', 'attr' => array('class' => 'btn btn-secondary')))
		      ->getForm();
		      
		      $form->handleRequest($request);
		    
		      if($form->isSubmitted() && $form->isValid()){
		          $upgrade = $form->getData();
		          $upgrade->setStockUpgradeId($engine);
		          
		          $entityManager = $this->getDoctrine()->getManager();
		          $entityManager->persist($upgrade);
		          $entityManager->flush();
		          
		          $hp = $engine->getHp();
		          $torque = $engine->getTorque();
		          $rpm = $engine->getRedline();
		          $noc = $engine->getNumberOfCylinders();
		          $bore = $engine->getCylinderBore();
		          $s = $engine->getPistonStroke();
		          
		          $hpstock = $hp;
		          
		          //crankshaft angular velocity
		          $cav = 2*3.14*$rpm;
		          $cav = $cav/60;
		          
		          
		          //mean piston speed
		          $mps = 2*$s*$rpm;
		          $mps = $mps/60;
		          
		          
		          //total bore area
		          $tba = $noc*3.14*$bore*$bore;
		          $tba = $tba/4;
		          
		          //theoritical volumetric flow rate
		          $tvfr = $mps*$tba;
		          $tvfr = $tvfr/4;
		          
		          //volumetric efficiency
		          $ve = 90;
		          
		          //volumetric flow rate
		          $vfr = $ve*$tvfr;
		          
		          //brake mean effective differential pressure
		          $bmep = $hp/$vfr;
		          
		          if($upgrade->getForcedInduction() != 'none'){
		              $psi = $upgrade->getPsi();
		              $k = $psi/14.7;
		              $k = $k + 1;
		              $boost = pow($k, 0.588235294);
		              $ve = $ve*$boost;
		              $vfr = $ve*$tvfr;
		              $hp = $bmep*$vfr;
		          }else{
		              $psi = 0;
		          }
		          
		          $intake = $upgrade->getIntake();
		          if($intake == 'street'){
		              $hp = $hp + 15;
		          }else if($intake == 'sport'){
		              $hp = $hp + 35;
		          }else if($intake == 'deleted'){
		              $hp = $hp + 55;
		          }
		          
		          $ecu = $upgrade->getEcu();
		          if($ecu == 'street'){
		              $rpm = $rpm + 1500;
		          }else if($ecu == 'sport'){
		              $rpm = $rpm + 2000;
		          }else if($ecu == 'type r'){
		              $rpm = $rpm + 3500;
		          }
		          
		          $pistons = $upgrade->getPistons();
		          if($pistons == 'street'){
		              $hp = $hp + 4;
		          }else if($pistons == 'sport'){
		              $hp = $hp + 7;
		          }else if($pistons == 'type r'){
		              $hp = $hp + 13;
		          }
		          
		          $intercooler = $upgrade->getIntercooler();
		          if($intercooler == 'street'){
		              $hp = $hp + 6;
		          }else if($intercooler == 'sport'){
		              $hp = $hp + 11;
		          }else if($intercooler == 'type r'){
		              $hp = $hp + 15;
		          }
		          
		          $exhaust = $upgrade->getExhaust();
		          if($exhaust == 'street'){
		              $hp = $hp + 16;
		          }else if($exhaust == 'sport'){
		              $hp = $hp + 23;
		          }else if($exhaust == 'type r'){
		              $hp = $hp + 31;
		          }
		          
		          $peektorquerpm = $hpstock*5252;
		          $peektorquerpm = $peektorquerpm/$torque;
		          
		          $torque = $hp*5252;
		          $torque = $torque/$peektorquerpm;
		          
		          $tuned_engine = new EngineTuned();
		          
		          $tuned_engine->setManufacturer($engine->getManufacturer());
		          $tuned_engine->setName($engine->getName());
		          $tuned_engine->setBlockAlloy($engine->getBlockAlloy());
		          $tuned_engine->setConfiguration($engine->getConfiguration());
		          $tuned_engine->setPistonStroke($engine->getPistonStroke());
		          $tuned_engine->setCylinderBore($engine->getCylinderBore());
		          $tuned_engine->setNumberOfCylinders($engine->getNumberOfCylinders());
		          $tuned_engine->setValvesPerCylinder($engine->getValvesPerCylinder());
		          $tuned_engine->setDisplacement($engine->getDisplacement());
		          $tuned_engine->setHp($hp);
		          $tuned_engine->setTorque($torque);
		          $tuned_engine->setRedline($rpm);
		          
		          $tuned_engine->setUserTunedId($user);
		          $tuned_engine->setStockId($engine);
		          
		          $entityManager = $this->getDoctrine()->getManager();
		          $entityManager->persist($tuned_engine);
		          $entityManager->flush();
		          
		          return $this->redirectToRoute('engine_upgraded', array('id' => $tuned_engine->getId()));
		      }
		   }
		   return $this->render('pages/upgrade.html.twig', array('form' => $form->createView()));
		}
		
		/**
		 * @Route("/upgraded/engine/{id}", name="engine_upgraded")
		 * @Method({"GET", "POST"})
		 */
		public function engine_upgraded($id){
		    $engine_tuned = $this->getDoctrine()->getRepository(EngineTuned::class)->find($id);
            
		    $engine = $this->getDoctrine()->getRepository(EngineStock::class)->find($engine_tuned->getStockID());
		    $user = $this->getDoctrine()->getRepository(User::class)->find($engine_tuned->getUserTunedId());
		    return $this->render('pages/show_engine_tuned.html.twig', array('tuned' => $engine_tuned, 'user' => $user, 'engine' => $engine));
		}
	}