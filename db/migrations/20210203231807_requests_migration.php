<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RequestsMigration extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('requests');
        $table->addColumn('name', 'string', ['limit' => '100'])
            ->addColumn('response', 'text')
            ->addColumn('createdAt', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }
}
