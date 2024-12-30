<?php

namespace App\DTOs;

class AccessibilityIssue
{
    public string $type;
    public string $element;
    public string $message;

    public function __construct(string $type, string $element, string $message)
    {
        $this->type = $type;
        $this->element = $element;
        $this->message = $message;
    }
}
