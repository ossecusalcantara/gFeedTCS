<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class FeedbackValidator.
 *
 * @package namespace App\Validators;
 */
class FeedbackValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'reason' 		=> 'required', 
            'notes' 		=> 'required', 
			'user_id' 	     => 'required|exists:app_users,id', 
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
