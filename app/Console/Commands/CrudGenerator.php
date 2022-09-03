<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:api:crud {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make API Resource';

    private $customStoreRequest = "StoreRequest";
    private $customUpdateRequest = "UpdateRequest";


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name   = $this->argument('name');
        $model  = str_replace("/", "", $name);
        //Generate Model & Migration
        $this->call('make:model', [
            'name' => $model,
            '--migration' => true
        ]);

        //Generate Form Store Request
        $this->call('make:request', [
            'name' => $name . '/' . $this->customStoreRequest,
        ]);

        //Generate Form Update Request
        $this->call('make:request', [
            'name' => $name . '/' . $this->customUpdateRequest,
        ]);

        //Generate Controller Resource
        $this->call('make:controller', [
            'name' => $name . 'Controller',
            '--model' => $model,
            '--api' => true
        ]);
        $this->updateController($name);

        return 0;
    }

    public function updateController($name)
    {
        $customNamespaceStoreRequest = "Http\\Requests\\" . str_replace("/", "\\", $name) . "\\" . $this->customStoreRequest;
        $customNamespaceUpdateRequest = "Http\\Requests\\" . str_replace("/", "\\", $name) . "\\" . $this->customUpdateRequest;
        $controllerFile = app_path() . "/Http/Controllers/" . $name . 'Controller.php';

        $str = file_get_contents($controllerFile);
        $str = str_replace("{{ customNamespaceStoreRequest }}", $customNamespaceStoreRequest, $str);
        $str = str_replace("{{ customNamespaceUpdateRequest }}", $customNamespaceUpdateRequest, $str);

        $str = str_replace("{{ customStoreRequest }}", $this->customStoreRequest, $str);
        $str = str_replace("{{ customUpdateRequest }}", $this->customUpdateRequest, $str);
        file_put_contents($controllerFile, $str);
    }
}