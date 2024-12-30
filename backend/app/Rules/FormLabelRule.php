<?php

namespace App\Rules;

use App\Interfaces\RuleInterface;

class FormLabelRule implements RuleInterface
{
    public function apply($dom): array
    {
        $issues = [];
        $inputs = $dom->getElementsByTagName('input');

        foreach ($inputs as $input) {
            if (!$input->hasAttribute('aria-label') && !$input->hasAttribute('aria-labelledby')) {
                $issues[] = [
                    'type' => 'missing_label',
                    'element' => $dom->saveHTML($input),
                    'message' => 'Form input is missing a label.',
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
