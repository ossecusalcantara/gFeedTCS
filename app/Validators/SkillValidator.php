<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class SkillValidator.
 *
 * @package namespace App\Validators;
 */
class SkillValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' 		  => 'required', 
			'description' => 'required', 
			'type' 	      => 'required', 
        ],
        
        ValidatorInterface::RULE_UPDATE => [
            'name' 		  => 'required', 
			'description' => 'required', 
			'type' 	      => 'required', 
        ],
    ];
}
