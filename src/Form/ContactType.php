<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Event;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class,[
                'required' => true,'attr' => [
                    'placeholder' => 'ex : John'
                ]
            ])
            ->add('lastname', TextType::class,[
                'required' => true,
                'attr' => [
                    'placeholder' => 'ex : Doe'
                ]
            ])
            ->add('phone', TextType::class, [
                'attr' => [
                    'placeholder' => 'ex : 03 83 83 83 83'
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'ex : test@gmail.com'
                ]
            ])
            ->add('type', ChoiceType::class,[
                'required' => true,
                'label' => 'Votre demande conserne',
                'choices' => $this->getChoices()
                

            ])
            ->add('message', TextareaType::class,[
                'attr' => [
                    'rows' => 5,
                    'placeholder' => 'Entrez votre message'

                    ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
            'translation_domain' => 'contact'
        ]);
    }

    public function getChoices()
    {
        $choices = Event::TYPE;
        $output = [];
        foreach ($choices as $key => $value) {
            $output[$value] = $key;
        }

        $output['Autre'] = 'autre';

        return $output;
    }
}
