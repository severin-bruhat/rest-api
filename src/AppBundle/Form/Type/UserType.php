<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

/**
 * Form type for users
 */
class UserType extends AbstractType
{
    /**
     * [buildForm description]
     * @param  FormBuilderInterface $builder [description]
     * @param  array                $options [description]
     * @return [type]                        [description]
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname');
        $builder->add('lastname');
        $builder->add('email', EmailType::class);
    }

    /**
     * [configureOptions description]
     * @param  OptionsResolver $resolver [description]
     * @return [type]                    [description]
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\User',
            'csrf_protection' => false, //always disable for an API (stateless)
        ]);
    }
}
