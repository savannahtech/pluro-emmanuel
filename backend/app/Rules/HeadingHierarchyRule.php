<?php

namespace App\Rules;

use App\Interfaces\RuleInterface;

class HeadingHierarchyRule implements RuleInterface
{
    public function apply($dom): array
    {
        $issues = [];
        $headings = [];
        foreach (['h1', 'h2', 'h3', 'h4', 'h5', 'h6'] as $tag) {
            $headings[$tag] = $dom->getElementsByTagName($tag);
        }

        $lastLevel = 0;
        foreach ($headings as $tag => $nodes) {
            $currentLevel = intval(substr($tag, 1));
            if ($currentLevel > $lastLevel + 1) {
                $issues[] = [
                    'type' => 'skipped_heading',
                    'message' => "Skipped heading level from <h{$lastLevel}> to <h{$currentLevel}>.",
                ];
            }
            $lastLevel = $currentLevel;
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
