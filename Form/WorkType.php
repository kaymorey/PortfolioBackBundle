<?php

namespace Kaymorey\PortfolioBackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WorkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text')
            ->add('url', 'url', array(
                'required' => false
            ))
            ->add('file', 'file', array(
                'required' => false
            ))
            ->add('year', 'choice', array(
                'choices' => $this->buildYearChoices()
            ))
            ->add('description', 'textarea', array(
                'required' => false
            ))
            ->add('skills', 'text', array(
                'required' => false
            ))
            ->add('category', 'entity', array(
                'class' => 'KaymoreyPortfolioBackBundle:Category',
                'property' => 'title'
            ))
        ;
    }
    public function buildYearChoices() {
        $first = new \DateTime('01/01/2010');
        $now = new \DateTime();
        $years = array();
        $years[0] = $first->format('Y');
        $i = 1;
        $oneYear = new \DateInterval('P1Y');
        while($first->format('Y') != $now->format('Y')) {
            $first->add($oneYear);
            $years[$i] = $first->format('Y');
            $i++;
        }
        return array_combine($years, $years);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kaymorey\PortfolioBackBundle\Entity\Work'
        ));
    }

    public function getName()
    {
        return 'kaymorey_portfoliobackbundle_worktype';
    }
}
