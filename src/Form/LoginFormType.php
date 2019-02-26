<?php
namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('username', TextType::class, array('attr' => array('class' => 'form-control form-control-sm')))
        ->add('password', PasswordType::class, array('attr' => array('class' => 'form-control form-control-sm')))
        ->add('login', SubmitType::class, array('label' => 'Login', 'attr' => array('class' => 'btn btn-secondary')));
    }
}