<?php
    namespace App\Twig;
    use Doctrine\ORM\EntityManagerInterface;
    use Twig_Extension;

    class Functions extends Twig_Extension{
        public function __construct(EntityManagerInterface $em)
        {
           $this->em = $em;
        }
           
        public function getFunctions() {
           return [
               new \Twig_SimpleFunction('getIsAdmin', [$this, 'getIsAdminById']),
           ];
        }
          
        public function getIsAdminById($id)
        {
            $user = $this->em->getRepository("App:User")
            ->find($id);
            if($user->getIsAdmin() == true){
                return true;
            }else{
                return false;
            }
        }
    }