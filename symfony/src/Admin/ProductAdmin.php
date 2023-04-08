<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use App\Entity\Product;

class ProductAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('image', FileType::class, [
                'label' => 'Product image',
                'required' => false,
                'mapped' => false,
            ])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('price')
            ->add('_action', null, [
                'actions' => [
                    'edit' => [],
                    'delete' => [],
                ],
            ])
        ;
    }

    public function prePersist($product)
    {
        $this->manageImageUpload($product);
    }

    public function preUpdate($product)
    {
        $this->manageImageUpload($product);
    }

    private function manageImageUpload($product)
    {
        if ($product->getImage()) {
            $product->setImageFilename(uniqid().'.'.$product->getImage()->guessExtension());
            $product->getImage()->move(
                $this->getParameter('products_images_directory'),
                $product->getImageFilename()
            );
        }
    }
}
