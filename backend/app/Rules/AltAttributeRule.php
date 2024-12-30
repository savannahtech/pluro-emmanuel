<?php

namespace App\Rules;

use App\Interfaces\RuleInterface;

class AltAttributeRule implements RuleInterface
{
    public function apply($dom): array
    {
        $issues = [];
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $image) {
            if (!$image->hasAttribute('alt')) {
                $issues[] = [
                    'type' => 'missing_alt',
                    'element' => $dom->saveHTML($image),
                    'message' => 'Image is missing an alt attribute.',
                ];
            }
        }
        return $issues;
    }

    public function getMetadata(): array
    {
        return [
            'guideline' => 'WCAG 2.1 - 3.3.2 Labels or Instructions',
            'purpose' => 'Ensure form inputs are labeled to improve accessibility.',
        ];
    }
}

