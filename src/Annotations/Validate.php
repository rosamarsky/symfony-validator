<?php
declare(strict_types=1);

namespace Rosamarsky\Validator\Annotations;
use InvalidArgumentException;

/**
 * @Annotation
 */
class Validate
{
    /**
     * @var string
     */
    private $validationClassName;

    /**
     * @param $options
     * @throws InvalidArgumentException
     */
    public function __construct($options)
    {
        if (! isset($options['value']) || !is_string($options['value'])) {
            throw new InvalidArgumentException(sprintf('Invalid argument format.'));
        }

        $value = $options['value'];

        if (! class_exists($value)) {
            throw new InvalidArgumentException(sprintf('Class "%s" does not exist', $value));
        }

        $this->validationClassName = $value;
    }

    /**
     * @return string
     */
    public function getValidationClassName(): string
    {
        return $this->validationClassName;
    }
}