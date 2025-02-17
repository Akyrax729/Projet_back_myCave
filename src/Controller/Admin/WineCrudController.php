<?php

namespace App\Controller\Admin;

use App\Entity\Wine;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Vich\UploaderBundle\Form\Type\VichImageType;

class WineCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Wine::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('year'),
            TextEditorField::new('description'),
            AssociationField::new('Region', 'Région')
                ->setFormTypeOptions([
                    'by_reference' => false,
                    'choice_label' => 'label',]),
            AssociationField::new('type','Type')
                ->setFormTypeOptions([
                'by_reference' => false,
                'multiple' => true,
                'choice_label' => 'label',]),
            ImageField::new('image_name')
                // ->setBasePath('images/')
                // ->setUploadDir('assets/images/'),
                ->setFormType(VichImageType::class),
            ];
    }
    
}
