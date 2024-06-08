<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class UserValidator.
 *
 * @package namespace App\Validators;
 */
class UserValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'cpf' 		=> 'required', 
			'name' 		=> 'required', 
			'phone' 	=> 'required', 
			'email' 	     => 'required|unique:app_users,email', 
        	'departament_id' => 'required|exists:departaments,id',
        	'office_id'      => 'required|exists:offices,id',
        ],
        ValidatorInterface::RULE_UPDATE => [ 
			'name' 		=> 'required', 
			'phone' 	=> 'required', 
			'email' 	=> 'required', 
        ],

    ];
}
