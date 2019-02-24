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
	use Symfony\Component\Form\Extension\Core\Type\IntegerType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\Form\Forms;
	use App\Entity\EngineStock;
	use App\Entity\User;
    use App\Form\UserLoginType;
	use App\Form\UserType;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\RedirectResponse;
        

    class HPCalcController extends AbstractController{

	    /**
	     * @Route("/", name="engine_list_home")
	     */
		public function index(){
			$engines= $this->getDoctrine()->getRepository(EngineStock::class)->findAll();
			
			return $this->render('pages/index.html.twig', array('engines' => $engines));
		}
		
		/**
		 * @Route("/stock/engine/add", name="new_engine") 
		 * @Method({"GET", "POST"})
		 */
		public function new_engine(Request $request){
		    $id = $this->get('session')->get('id');
		    
		     if($id == NULL){
		         $user = new User();
		         $form = $this->createForm(UserLoginType::class, $user);
		         $form->handleRequest($request);
		         if ($form->isSubmitted()) {
		             $guestUser = $form->getData();
		             $guestUser->setPassword(hash("sha256",$guestUser->getPassword()));
		             $user = $this->getDoctrine()
		             ->getRepository(User::class)
		             ->findOneByUsernamePassword($guestUser->getUsername(), $guestUser->getPassword());
		             if (!$user) {
		                 throw $this->createNotFoundException(
		                     'No User found with this email and password!'
		                     );
		             }
		             $this->get('session')->set('id', $user->getId());
		             $flashbag = $this->get('session')->getFlashBag();
		             $flashbag->add("SuccessfullLogin", "You're successfully logged in!");
		             return $this->redirectToRoute('new_engine');
		         }
		    }else{
		    
    		    $engine = new EngineStock();
    		    
    		    $form = $this->createFormBuilder($engine)
    		    ->add('manufacturer', TextType::class, array('attr' => array('class' => 'form-control form-control-sm')))
    		    ->add('name', TextType::class, array('attr' => array('class' => 'form-control form-control-sm')))
    		    ->add('production', TextType::class, array('attr' => array('class' => 'form-control form-control-sm')))
    		    ->add('block_alloy', TextType::class, array('attr' => array('class' => 'form-control form-control-sm')))
    		    ->add('configuration', TextType::class, array('attr' => array('class' => 'form-control form-control-sm')))
    		    ->add('valvetrain', TextType::class, array('attr' => array('class' => 'form-control form-control-sm')))
    		    ->add('displacement', IntegerType::class, array('attr' => array('class' => 'form-control form-control-sm')))
    		    ->add('hp', IntegerType::class, array('attr' => array('class' => 'form-control form-control-sm')))
    		    ->add('max_hp_at_rpm', IntegerType::class, array('attr' => array('class' => 'form-control form-control-sm')))
    		    ->add('torque', IntegerType::class, array('attr' => array('class' => 'form-control form-control-sm')))
    		    ->add('max_torque_at_rpm', IntegerType::class, array('attr' => array('class' => 'form-control form-control-sm')))
    		    ->add('redline', IntegerType::class, array('attr' => array('class' => 'form-control form-control-sm')))
    		    ->add('lifespan', IntegerType::class, array('attr' => array('class' => 'form-control form-control-sm')))
    		    ->add('save', SubmitType::class, array('label' => 'Add Engine', 'attr' => array('class' => 'btn btn-secondary')))
    		    ->getForm();
    		    
    		    $form->handleRequest($request);
    		    
    		    if($form->isSubmitted() && $form->isValid()){
    		        $engine = $form->getData();
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
		    $twojz->setProduction("1991-2007");
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
	}