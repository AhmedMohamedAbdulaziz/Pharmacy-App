<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * php artisan make:repository {Name}
 *
 * Scaffolds a complete module under app/Modules/{Name}/ containing:
 *   ├── Models/{Name}.php
 *   ├── Interfaces/{Name}RepositoryInterface.php
 *   ├── Repositories/{Name}Repository.php
 *   ├── Services/{Name}Service.php
 *   ├── Requests/Store{Name}Request.php
 *   ├── Requests/Update{Name}Request.php
 *   └── Controllers/{Name}Controller.php
 *
 * It also auto-registers the new interface/repository binding
 * in RepositoryServiceProvider.
 */
class MakeRepository extends Command
{
    protected $signature   = 'make:repository {name : The module name (e.g. Patient)}';
    protected $description = 'Scaffold a complete module under app/Modules/{Name}/';

    public function handle(): void
    {
        $name       = Str::studly($this->argument('name'));
        $modulePath = app_path("Modules/{$name}");

        $this->createModel($name, $modulePath);
        $this->createInterface($name, $modulePath);
        $this->createRepository($name, $modulePath);
        $this->createService($name, $modulePath);
        $this->createRequests($name, $modulePath);
        $this->createController($name, $modulePath);
        $this->updateProvider($name);

        $this->newLine();
        $this->info("✅  Module [{$name}] scaffolded under app/Modules/{$name}/");
        $this->table(
            ['Layer', 'File'],
            [
                ['Model',      "app/Modules/{$name}/Models/{$name}.php"],
                ['Interface',  "app/Modules/{$name}/Interfaces/{$name}RepositoryInterface.php"],
                ['Repository', "app/Modules/{$name}/Repositories/{$name}Repository.php"],
                ['Service',    "app/Modules/{$name}/Services/{$name}Service.php"],
                ['Request',    "app/Modules/{$name}/Requests/Store{$name}Request.php"],
                ['Request',    "app/Modules/{$name}/Requests/Update{$name}Request.php"],
                ['Controller', "app/Modules/{$name}/Controllers/{$name}Controller.php"],
            ]
        );
        $this->newLine();
        $this->comment('Next steps:');
        $this->comment("  1. Add \$fillable fields to the Model.");
        $this->comment("  2. Add business-logic methods to the Service.");
        $this->comment("  3. Register routes in routes/web.php.");
    }

    // ── Stubs ─────────────────────────────────────────────────────────────────

    protected function createModel(string $name, string $path): void
    {
        $stub = <<<PHP
<?php
namespace App\Modules\\{$name}\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class {$name} extends Model
{
    use HasFactory;

    protected \$table    = '{$this->tableName($name)}';
    protected \$fillable = [];
}
PHP;
        $this->write("{$path}/Models/{$name}.php", $stub, "Model");
    }

    protected function createInterface(string $name, string $path): void
    {
        $stub = <<<PHP
<?php
namespace App\Modules\\{$name}\Interfaces;

interface {$name}RepositoryInterface
{
    public function all();
    public function find(string \$id);
    public function create(array \$data);
    public function update(string \$id, array \$data);
    public function delete(string \$id);
}
PHP;
        $this->write("{$path}/Interfaces/{$name}RepositoryInterface.php", $stub, "Interface");
    }

    protected function createRepository(string $name, string $path): void
    {
        $stub = <<<PHP
<?php
namespace App\Modules\\{$name}\Repositories;

use App\Modules\\{$name}\Interfaces\\{$name}RepositoryInterface;
use App\Modules\\{$name}\Models\\{$name};

class {$name}Repository implements {$name}RepositoryInterface
{
    public function all()               { return {$name}::all(); }
    public function find(string \$id)    { return {$name}::findOrFail(\$id); }
    public function create(array \$data) { return {$name}::create(\$data); }

    public function update(string \$id, array \$data)
    {
        \$model = {$name}::findOrFail(\$id);
        \$model->update(\$data);
        return \$model;
    }

    public function delete(string \$id) { return {$name}::destroy(\$id); }
}
PHP;
        $this->write("{$path}/Repositories/{$name}Repository.php", $stub, "Repository");
    }

    protected function createService(string $name, string $path): void
    {
        $stub = <<<PHP
<?php
namespace App\Modules\\{$name}\Services;

use App\Modules\\{$name}\Interfaces\\{$name}RepositoryInterface;

class {$name}Service
{
    public function __construct(protected {$name}RepositoryInterface \$repo) {}

    public function all()               { return \$this->repo->all(); }
    public function find(string \$id)    { return \$this->repo->find(\$id); }
    public function create(array \$data) { return \$this->repo->create(\$data); }
    public function update(string \$id, array \$data) { return \$this->repo->update(\$id, \$data); }
    public function delete(string \$id)  { return \$this->repo->delete(\$id); }
}
PHP;
        $this->write("{$path}/Services/{$name}Service.php", $stub, "Service");
    }

    protected function createRequests(string $name, string $path): void
    {
        foreach (['Store', 'Update'] as $prefix) {
            $stub = <<<PHP
<?php
namespace App\Modules\\{$name}\Requests;

use Illuminate\Foundation\Http\FormRequest;

class {$prefix}{$name}Request extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            // TODO: add validation rules
        ];
    }

    public function messages(): array
    {
        return [
            // TODO: add custom messages
        ];
    }
}
PHP;
            $this->write("{$path}/Requests/{$prefix}{$name}Request.php", $stub, "{$prefix}Request");
        }
    }

    protected function createController(string $name, string $path): void
    {
        $lower = Str::camel($name);
        $snake = Str::snake($name, '.');

        $stub = <<<PHP
<?php
namespace App\Modules\\{$name}\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\\{$name}\Requests\Store{$name}Request;
use App\Modules\\{$name}\Requests\Update{$name}Request;
use App\Modules\\{$name}\Services\\{$name}Service;

class {$name}Controller extends Controller
{
    public function __construct(protected {$name}Service \${$lower}Service) {}

    public function index()
    {
        \$items = \$this->{$lower}Service->all();
        return view('{$snake}.index', compact('items'));
    }

    public function create() { return view('{$snake}.create'); }

    public function store(Store{$name}Request \$request)
    {
        \$this->{$lower}Service->create(\$request->validated());
        return redirect()->back()->with('success', '{$name} created successfully.');
    }

    public function show(string \$id)
    {
        \$item = \$this->{$lower}Service->find(\$id);
        return view('{$snake}.show', compact('item'));
    }

    public function edit(string \$id)
    {
        \$item = \$this->{$lower}Service->find(\$id);
        return view('{$snake}.edit', compact('item'));
    }

    public function update(Update{$name}Request \$request, string \$id)
    {
        \$this->{$lower}Service->update(\$id, \$request->validated());
        return redirect()->back()->with('success', '{$name} updated successfully.');
    }

    public function destroy(string \$id)
    {
        \$this->{$lower}Service->delete(\$id);
        return redirect()->back()->with('success', '{$name} deleted successfully.');
    }
}
PHP;
        $this->write("{$path}/Controllers/{$name}Controller.php", $stub, "Controller");
    }

    // ── Provider auto-registration ────────────────────────────────────────────

    protected function updateProvider(string $name): void
    {
        $providerPath = app_path('Providers/RepositoryServiceProvider.php');
        $content      = File::get($providerPath);

        $interfaceUse  = "use App\\Modules\\{$name}\\Interfaces\\{$name}RepositoryInterface;";
        $repositoryUse = "use App\\Modules\\{$name}\\Repositories\\{$name}Repository;";
        $serviceUse    = "use App\\Modules\\{$name}\\Services\\{$name}Service;";

        if (str_contains($content, $interfaceUse)) {
            $this->warn("  Binding already exists – skipping RepositoryServiceProvider update.");
            return;
        }

        // Inject use statements before the class declaration
        $content = str_replace(
            "class RepositoryServiceProvider",
            "{$interfaceUse}\n{$repositoryUse}\n{$serviceUse}\n\nclass RepositoryServiceProvider",
            $content
        );

        // Inject interface→repository binding and service binding inside register()
        $binding = <<<PHP

        // ── {$name} Module ────────────────────────────────────────────────────
        \$this->app->bind({$name}RepositoryInterface::class, {$name}Repository::class);
        \$this->app->bind({$name}Service::class, fn (\$app) =>
            new {$name}Service(\$app->make({$name}RepositoryInterface::class))
        );
PHP;
        $content = preg_replace(
            '/(public function boot\(\): void)/m',
            "{$binding}\n    }\n\n    /**\n     * Bootstrap services.\n     */\n    \$1",
            $content,
            1
        );

        File::put($providerPath, $content);
        $this->line("  Registered bindings in RepositoryServiceProvider.");
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    protected function write(string $absolutePath, string $stub, string $label): void
    {
        $dir = dirname($absolutePath);
        if (!File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }
        File::put($absolutePath, $stub);
        $this->line("  <fg=green>✔</> {$label}");
    }

    protected function tableName(string $name): string
    {
        return Str::snake(Str::plural($name));
    }
}
