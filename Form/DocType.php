<?php

namespace Kaymorey\PortfolioBackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DocType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', 'text')
            ->add('file', 'file', array(
                'required' => true
            ))
        ;
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kaymorey\PortfolioBackBundle\Entity\Doc'
        ));
    }

    public function getName()
    {
        return 'kaymorey_portfoliobackbundle_doctype';
    }
}
