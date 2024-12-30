<?php

namespace App\Services;

use App\Repositories\AccessibilityRepository;
use App\Rules\AltAttributeRule;
use App\Rules\HeadingHierarchyRule;
use App\Rules\FormLabelRule;
use Illuminate\Support\Facades\Log;

class AccessibilityService
{
    protected AccessibilityRepository $repository;
    protected $rules = [];

    public function __construct(AccessibilityRepository $repository)
    {
        $this->repository = $repository;

        $this->rules = [
            new AltAttributeRule(),
            new HeadingHierarchyRule(),
            new FormLabelRule(),
        ];
    }

    public function analyze(string $content): array
    {
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);

        try {
            if (!$dom->loadHTML($content)) {
                throw new \Exception('Failed to parse HTML content.');
            }
        } catch (\Exception $e) {
            Log::error('Failed to parse HTML content: ' . $e->getMessage());
            return [
                'score' => 0,
                'issues' => [
                    [
                        'type' => 'invalid_html',
                        'message' => $e->getMessage(),
                    ]
                ],
            ];
        } finally {
            libxml_clear_errors();
        }
        $issues = [];
        foreach ($this->rules as $rule) {
            $ruleIssues = $rule->apply($dom);
            foreach ($ruleIssues as &$issue) {
                $issue['rule_metadata'] = $rule->getMetadata();
            }
            $issues = array_merge($issues, $ruleIssues);
        }
        $this->repository->saveAnalysis($content, $issues);
        return [
            'score' => $this->calculateScore($issues),
            'issues' => $issues,
        ];
    }


    private function calculateScore(array $issues): int
    {
        // Simple scoring logic: fewer issues = higher score
        $totalPossiblePoints = 100;
        $penaltyPerIssue = 5;
        return max($totalPossiblePoints - count($issues) * $penaltyPerIssue, 0);
    }
}
