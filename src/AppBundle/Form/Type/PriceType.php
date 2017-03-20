<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for prices
 */
class PriceType extends AbstractType
{
    /**
     * [buildForm description]
     * @param  FormBuilderInterface $builder [description]
     * @param  array                $options [description]
     * @return [type]                        [description]
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Pas besoin de rajouter les options avec ChoiceType vu que nous allons l'utiliser via API.
        // Le formulaire ne sera jamais affiché
        $builder->add('type');
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
            'data_class' => 'AppBundle\Entity\Price',
            'csrf_protection' => false, //always disable for an API (stateless)
        ]);
    }
}
