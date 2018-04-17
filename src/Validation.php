<?php
declare(strict_types=1);

namespace Rosamarsky\Validator;

use Symfony\Component\HttpFoundation\Request;

interface Validation
{
    /**
     * @param Request $request
     */
    public function validate(Request $request): void;
}