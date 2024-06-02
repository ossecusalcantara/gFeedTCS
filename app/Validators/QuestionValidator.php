<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class QuestionValidator.
 *
 * @package namespace App\Validators;
 */
class QuestionValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required',
            'order' => 'required',
            'question_description' => 'required',
            'type_question_id' => 'required|exists:type_questions,id'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required',
            'order' => 'required',
            'question_description' => 'required',
            'type_question_id' => 'required|exists:type_questions,id'
        ],
    ];
}
