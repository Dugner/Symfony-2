<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProjectFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('responsible', 
            EntityType::class,
        ['class'=> User::class, 'choice_label' => 'name'])
            ->add('worker', 
                EntityType::class,
                ['class'=> User::class,
                'choice_label' => 'name',
                'expanded' => false,
                'multiple' => true])
            ->add(
                'thumbnail',
                FileType::class,
                ['required' => false]
            );

        if($options['standalone']){
            $builder->add('submit', SubmitType::class, 
            ['attr'=>['class'=>'btn-success btn-block']]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
            'standalone'=> false
        ]);
    }
}
