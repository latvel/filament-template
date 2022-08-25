<?php

namespace Latvel\FilamentTemplate\Forms\Components;

use Filament\Forms\Components\Concerns\EntanglesStateWithSingularRelationship;
use Filament\Forms\Components\Contracts\CanEntangleWithSingularRelationships;
use Filament\Forms\Components\Field;
use Latvel\FilamentTemplate\BaseTemplate;

class Template extends Field implements CanEntangleWithSingularRelationships
{
    use EntanglesStateWithSingularRelationship;

    protected string $view = 'filament-template::template-field';

    protected function setUp(): void
    {
        parent::setUp();

        $this->columnSpan('full');
    }

    public function template(BaseTemplate $template): self
    {
        $this->schema($template->schema());

        return $this;
    }
}