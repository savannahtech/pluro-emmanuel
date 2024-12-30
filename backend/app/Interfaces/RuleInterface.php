<?php
namespace App\Interfaces;
interface RuleInterface
{
    public function apply(\DOMDocument $dom): array;
    public function getMetadata(): array;
}
