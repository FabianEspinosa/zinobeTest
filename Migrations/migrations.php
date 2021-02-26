<?php

return [
    'name' => 'Migraciones del proyecto',
    'migrations_namespace' => 'zinobetest\Migrations',
    'table_name' => 'doctrine_migration_versions',
    'column_name' => 'version',
    'column_length' => 14,
    'executed_at_column_name' => 'executed_at',
    'migrations_directory' => './database/migrations',
    'all_or_nothing' => true,
    'check_database_platform' => true,
];