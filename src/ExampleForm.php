<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility;

use DateTime;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Forms;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Validation;

class ExampleForm
{
    /**
     * @return FormInterface<Form>
     */
    public function create(): FormInterface
    {
        $factory = Forms::createFormFactoryBuilder()
            ->addExtension(new ValidatorExtension(Validation::createValidator()))
            ->getFormFactory();

        return $factory->createBuilder(
            FormType::class,
            [
                'dueDate' => new DateTime('tomorrow')
            ]
        )->add(
            'task',
            TextType::class,
            [
                'constraints' => new NotBlank()
            ]
        )->add(
            'dueDate',
            DateType::class,
            [
                'constraints' => [
                    new NotBlank(),
                    new Type(DateTime::class)
                ]
            ]
        )->getForm();
    }
}
