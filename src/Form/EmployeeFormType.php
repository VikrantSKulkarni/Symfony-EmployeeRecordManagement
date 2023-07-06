<?php

namespace App\Form;

use App\Entity\Employees;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EmployeeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name',TextType::class,['attr' => [
                'label' => 'Name *',
                'class' => 'form-control',
            ]])
            ->add('Email',EmailType::class,['attr' => [
                'label' => 'Email *',
                'class' => 'form-control',
            ]])
            ->add('DateOfBirth',DateType::class,['attr'=>[
                'label'=>'Date Of Birth *',
                 'class'=>'form-control'],
                 'years' => range(1950, date('Y'))
            ])
            ->add('gender',ChoiceType::class, [
                'choices' => [
                    'Male' => 'Male',
                    'Female' => 'Female',
                ],
                'expanded' => true,
            ])
            ->add('Address',TextareaType::class,['attr' => [
                'label' => 'Address *',
                'class' => 'form-control',
            ]])
            ->add('Mobile',NumberType::class,['attr' => [
                'label' => 'Mobile *',
                'class' => 'form-control',
            ]])
            ->add('Education',ChoiceType::class, [
                'attr'=>[
                    'class'=>'form-control'
                ],
                'choices'  => [
                    'Bsc' => 'Bsc',
                    'Msc' => 'Msc',
                    'Bsc(computer)' =>'Bsc(computer)' ,
                    'Msc(computer)' =>'Msc(computer)',
                    'Computer Enginerring'=>'Computer Enginerring',
                    'IT Enginerring'=>'IT Enginerring',
                ],
            ])
            ->add('Department',ChoiceType::class, [
                'attr'=>[
                    'class'=>'form-control'
                ],
                'choices'  => [
                    'IT' => 'IT',
                    'Sales' => 'Sales',
                    'HR' =>'HR' ,
                    'Digital Marketing' =>'Digital Marketing',
                    'Tech Support'=>'Tech Support',
                    'Testing'=>'Testing',
                ],
            ])
            ->add('ManagerName',TextType::class,['attr' => [
                'label' => 'Manager *',
                'class' => 'form-control',
            ]])
            ->add('Joining_date',DateType::class,['attr' => [
                'label' => 'Joining Date *',
                'class' => 'form-control',
            ]])
            ->add('ProfilePic',FileType::class,['attr'=>[
                'class' => 'form-control',
                'maxSize' => '20M',
            ],'required' => false,])

            ->add('Resume',FileType::class,['attr'=>[
                'class' => 'form-control',
                'maxSize' => '20M',
            ],'required' => false,],)
            ->add('submit', SubmitType::class,['attr'=>[
                'class' => 'btn btn-primary mt-3',
            ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employees::class,
        ]);
    }
}
