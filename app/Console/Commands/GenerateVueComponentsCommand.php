<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateVueComponentsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:vue-components';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $script = base_path('/scan-vue-files.sh');
        $componentsDir = base_path('resources/js/vue/components');
        exec("chmod +x {$script} && {$script} {$componentsDir}");
    }
}
