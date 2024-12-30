<?php

use App\Services\AccessibilityService;
use App\Repositories\AccessibilityRepository;
use App\Rules\AltAttributeRule;
use App\Rules\HeadingHierarchyRule;
use App\Rules\FormLabelRule;
use Mockery\MockInterface;

beforeEach(function () {
    $this->repository = Mockery::mock(AccessibilityRepository::class);
    $this->service = new AccessibilityService($this->repository);
});

it('detects missing alt attributes in images', function () {
    $html = '<img src="image.png">';

    $this->repository
        ->shouldReceive('saveAnalysis')
        ->once()
        ->withArgs(function ($content, $issues) {
            return $content === '<img src="image.png">' && count($issues) === 1;
        });

    $result = $this->service->analyze($html);

    expect($result['issues'])->toHaveCount(1)
        ->and($result['issues'][0]['type'])->toBe('missing_alt')
        ->and($result['score'])->toBe(95); // 1 issue, 5 points deducted
});

it('detects missing form labels', function () {
    $html = '<input type="text" name="username">';

    $this->repository
        ->shouldReceive('saveAnalysis')
        ->once()
        ->withArgs(function ($content, $issues) {
            return $content === '<input type="text" name="username">' && count($issues) === 1;
        });

    $result = $this->service->analyze($html);

    expect($result['issues'])->toHaveCount(1)
        ->and($result['issues'][0]['type'])->toBe('missing_label')
        ->and($result['score'])->toBe(95); // 1 issue, 5 points deducted
});
