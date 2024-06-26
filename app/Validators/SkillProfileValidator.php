<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class SkillProfileValidator.
 *
 * @package namespace App\Validators;
 */
class SkillProfileValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'pontuation'  => 'required', 
        	'user_id'     => 'required|exists:app_users,id',
        	'skill_id'    => 'required|exists:skills,id',
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
