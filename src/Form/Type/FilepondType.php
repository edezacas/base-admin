<?php

namespace WeAreBrave\BaseAdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilepondType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('uploader', FileType::class, [
                'mapped' => false,
                'required' => false,
                'multiple' => $options['multiple']
            ])
            ->add('files', HiddenType::class, [
                'mapped' => false,
                'required' => false
            ]);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['multiple'] = $options['multiple'];
        $view->vars['uploadUri'] = $options['uploadUri'];
        $view->vars['files'] = $options['files'];
        $view->vars['acceptedFileTypes'] = $options['acceptedFileTypes'];
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'compound' => true,
            'multiple' => false,
            'uploadUri' => '',
            'files' => [],
            'acceptedFileTypes' => ''
        ]);

        $resolver->setAllowedTypes('uploadUri', 'string');
        $resolver->setAllowedTypes('multiple', 'bool');
        $resolver->setAllowedTypes('files', 'array');
        $resolver->setAllowedTypes('acceptedFileTypes', 'string');
    }

    public function getBlockPrefix(): string
    {
        return 'filepond';
    }
}
