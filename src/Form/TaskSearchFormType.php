<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Project;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\DTO\TaskSearch;


class TaskSearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('project', EntityType::class, ['class' => Project::class, 'choice_label' => 'title'])
            ->add('search', TextType::class, ['required' => false]);

        if($options['standalone']){
            $builder->add('submit', SubmitType::class, [
                'label' => 'search',
                'attr'=>['class'=>'btn-warning btn-block']]);
        }
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => TaskSearch::class,
                'standalone' => false
            ]
        );
    }
}