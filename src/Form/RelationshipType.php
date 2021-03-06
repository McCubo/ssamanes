<?php

namespace App\Form;

use App\Entity\Relationship;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class RelationshipType extends AbstractType {

    public function buildForm (FormBuilderInterface $builder, array $options) {
        $builder->add('name', null,
                array(
                        'label' => 'form.relationship.label.name',
                        'required' => false,
                        'attr' => array(
                                'class' => 'form-control'
                        )
                ))->add('status', CheckboxType::class,
                array(
                        'label' => 'form.common.label.is_active',
                        'required' => false,
                        'attr' => array(
                                'class' => 'form-check-input'
                        )
                ));
    }

    public function configureOptions (OptionsResolver $resolver) {
        $resolver->setDefaults([
                'data_class' => Relationship::class,
                'csrf_protection' => true,
                // the name of the hidden HTML field that stores the token
                'csrf_field_name' => 'token',
                // an arbitrary string used to generate the value of the token
                // using a different string for each form improves its security
                'csrf_token_id' => 'relationship_item'
        ]);
    }
}
