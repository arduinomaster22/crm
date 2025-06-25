<?php

namespace Backstage\Crm\Commands;

use Illuminate\Console\Command;

class CrmCommand extends Command
{
    public $signature = 'crm';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
