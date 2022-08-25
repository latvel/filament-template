<?php

namespace Latvel\FilamentTemplate\Commands;

use Filament\Commands\Concerns\CanManipulateFiles;
use Filament\Commands\Concerns\CanValidateInput;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class CreateTemplateCommand extends Command
{
    use CanManipulateFiles;
    use CanValidateInput;

    protected $description = 'Creates a template class';

    protected $signature = 'make:filament-template {name?} {--F|force}';

    public function handle(): int
    {
        $template = (string)Str::of($this->argument('name') ?? $this->askRequired('Name (e.g. `Custom`)', 'name'))
            ->trim('/')
            ->trim('\\')
            ->trim(' ')
            ->replace('/', '\\');
        $templateClass = (string)Str::of($template)->afterLast('\\');
        $templateNamespace = Str::of($template)->contains('\\') ?
            (string)Str::of($template)->beforeLast('\\') :
            '';

        $path = app_path(
            (string)Str::of($template)
                ->prepend('Templates\\')
                ->replace('\\', '/')
                ->append('.php'),
        );

        if (!$this->option('force') && $this->checkForCollision([
                $path,
            ])) {
            return static::INVALID;
        }

        $this->copyStubToApp('Template', $path, [
            'class' => $templateClass,
            'namespace' => 'App\\Templates' . ($templateNamespace !== '' ? "\\{$templateNamespace}" : ''),
        ]);

        $this->info("Successfully created {$template}!");

        return static::SUCCESS;
    }

    protected function copyStubToApp(string $stub, string $targetPath, array $replacements = []): void
    {
        $filesystem = app(Filesystem::class);

        if (!$this->fileExists($stubPath = base_path("stubs/{$stub}.stub"))) {
            $stubPath = __DIR__ . "/../../stubs/{$stub}.stub";
        }

        $stub = Str::of($filesystem->get($stubPath));

        foreach ($replacements as $key => $replacement) {
            $stub = $stub->replace("{{ {$key} }}", $replacement);
        }

        $stub = (string)$stub;

        $this->writeFile($targetPath, $stub);
    }
}