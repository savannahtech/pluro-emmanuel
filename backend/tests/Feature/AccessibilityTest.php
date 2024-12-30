<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;

it('returns accessibility score for uploaded HTML file', function () {
     $htmlFile = new UploadedFile(
        base_path('tests/fixtures/sample.html'),
        'sample.html',
        'text/html',
        null,
        true
    );

    $response = $this->json('POST', '/api/analyze', [
        'file' => $htmlFile,
    ]);
    $response->assertStatus(200);
    $response->assertJson([
        'data' => [
            'score' => 65,
        ],
    ]);
});

it('checks if each issue has the correct format', function () {
    $htmlFile = new UploadedFile(
        base_path('tests/fixtures/sample.html'),
        'sample.html',
        'text/html',
        null,
        true
    );

    $response = $this->json('POST', '/api/analyze', [
        'file' => $htmlFile,
    ]);

    $issues = $response->json('data.issues');
    foreach ($issues as $issue) {
        expect($issue)->toHaveKey('type');
        expect($issue)->toHaveKey('element');
        expect($issue)->toHaveKey('message');
        expect($issue['type'])->toBe('missing_label');
    }
});

//it('returns an empty issues list when there are no accessibility issues', function () {
//    $htmlFile = new UploadedFile(
//        base_path('tests/fixtures/sample_no_issues.html'),
//        'sample_no_issues.html',
//        'text/html',
//        null,
//        true
//    );
//
//    $response = $this->json('POST', '/api/analyze', [
//        'file' => $htmlFile,
//    ]);
//
//    $response->assertJson([
//        'data' => [
//            'score' => 100,
//            'issues' => [],
//        ],
//    ]);
//});
