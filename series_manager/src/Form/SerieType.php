<?php

namespace App\Form;

use App\DTO\SerieCreateFormInput;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('serieName', options: ['label' => 'Nome'])
            ->add('seasonsQuantity', NumberType::class, options: ['label' => 'Qtd Temporadas'])
            ->add('episodesPerSeason', NumberType::class, options: ['label' => 'Ep por Teporada'])
            ->add('save', SubmitType::class, ['label' => $options['is_edit'] ? 'Editar' : 'Salvar'])
            ->setMethod($options['is_edit'] ? 'PATCH' : 'POST');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SerieCreateFormInput::class,
            'is_edit' => false,
        ]);
        $resolver->setAllowedTypes('is_edit', 'bool');
    }
}
