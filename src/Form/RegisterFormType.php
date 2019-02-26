<?php
namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegisterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', TextType::class , array('attr' => array('class' => 'form-control form-control-sm')))
        ->add('password', PasswordType::class, array('attr' => array('class' => 'form-control form-control-sm')))
        ->add('email', TextType::class, array('attr' => array('class' => 'form-control form-control-sm')))
        ->add('firstname', TextType::class , array('attr' => array('class' => 'form-control form-control-sm')))
        ->add('lastname', TextType::class , array('attr' => array('class' => 'form-control form-control-sm')))
        ->add('register', SubmitType::class, array('label' => 'Register', 'attr' => array('class' => 'btn btn-secondary')));
    }
}