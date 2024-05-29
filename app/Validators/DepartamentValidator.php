<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class DepartamentValidator.
 *
 * @package namespace App\Validators;
 */
class DepartamentValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required',
            'description' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required',
            'description' => 'required',
        ],
    ];
}
