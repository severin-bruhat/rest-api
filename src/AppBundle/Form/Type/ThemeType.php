<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for themes
 */
class ThemeType extends AbstractType
{
    /**
     * [buildForm description]
     * @param  FormBuilderInterface $builder [description]
     * @param  array                $options [description]
     * @return [type]                        [description]
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('value');
    }

    /**
     * [configureOptions description]
     * @param  OptionsResolver $resolver [description]
     * @return [type]                    [description]
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Theme',
            'csrf_protection' => false, //always disable for an API (stateless)
        ]);
    }
}
