<?php
    namespace App\Controller;
    
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Entity\User;
    use Symfony\Component\HttpFoundation\Request;
    use App\Form\UserType;
    use App\Form\UserLoginType;
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
            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $user = $form->getData();
                $entityManager = $this->getDoctrine()->getManager();
                $user->setPassword(hash("sha256",$user->getPassword()));
                $user->setIsadmin(false);
                $entityManager->persist($user);
                $entityManager->flush();
                $flashbag = $this->get('session')->getFlashBag();
                $flashbag->add("SuccessfullRegister", "You successfully registered in our site!");
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
            $flashbag = $this->get('session')->getFlashBag();
            $flashbag->add("SuccessfullLoggout", "You successfully logout from our site!");
            return $this->redirectToRoute('engine_list_home');
        }
        /**
         * @Route("/login", name="login")
         */
        public function login(Request $request)
        {
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
                        'No product found for this email and password '
                        );
                }
                $this->get('session')->set('id', $user->getId());
                $flashbag = $this->get('session')->getFlashBag();
                $flashbag->add("SuccessfullLogin", "You successfully logged in our site!");
                return $this->redirectToRoute('BoardFind');
            }
            return $this->render('home/LoginForm.html.twig', array(
                'form' => $form->createView(),
            ));
        }
    }