<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Lastname', TextType::class,['attr'=>['class'=>'form-control  col-6 m-2']])
            ->add('Firstname', TextType::class,['attr'=>['class'=>'form-control  col-6 m-2']])  
            ->add('Email',TextType::class,['attr'=>['class'=> 'form-control  col-6 m-2', 'style'=>'background-color:#fff']])
            ->add('Message',TextareaType::class,['attr'=>['class'=>'   form-control  col-6 m-2', 'style'=>'background-color:#fff']])
            ->add('Submit',SubmitType::class,['attr'=>['class'=>'btn btn-danger  form-control  col-6 m-2']])   
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
