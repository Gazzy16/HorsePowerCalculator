<?php
    namespace App\Controller;
    
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Entity\User;
    use Symfony\Component\HttpFoundation\Request;
    use App\Form\RegisterFormType;
    use App\Form\LoginFormType;
    use Symfony\Component\HttpFoundation\Session\Session;
    use Symfony\Component\HttpFoundation\Session\SessionInterface;
    
    class UserController extends AbstractController
    {
        /**
         * @Route("/register", name="register")
         * @param Request $request
         * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
         */
        public function register(Request $request)
        {
            $user = new User();
            $form = $this->createForm(RegisterFormType::class, $user);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $user = $form->getData();
                $user->setPassword(hash("sha256",$user->getPassword()));
                $user->setIsadmin(false);
                $entityManager->persist($user);
                $entityManager->flush();
                return $this->redirectToRoute('engine_list_home');
            }
            return $this->render('pages/register_form.html.twig', array(
                'form' => $form->createView(),
            ));
        }
        
        /**
         * @Route("/logout", name="logout")
         */
        public function logout()
        {
            $this->get('session')->clear();
            return $this->redirectToRoute('engine_list_home');
        }
        /**
         * @Route("/login", name="login")
         */
        public function login(Request $request)
        {
            $user = new User();
            $form = $this->createForm(LoginFormType::class, $user);
            $form->handleRequest($request);
            if ($form->isSubmitted()) {
                $guest = $form->getData();
                $guest->setPassword(hash("sha256",$guest->getPassword()));
                $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneByUsernamePassword($guest->getUsername(), $guest->getPassword());
                if (!$user) {
                    throw $this->createNotFoundException(
                        'No User found with this email and password!'
                        );
                }
                $this->get('session')->set('id', $user->getId());
                return $this->redirectToRoute('engine_list_home');
            }
            return $this->render('pages/login_form.html.twig', array(
                'form' => $form->createView(),
            ));
        }
    }