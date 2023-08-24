<?php
return [
    'global' => [
        'group.id' => 'crm',
        'metadata.broker.list' => 'kafka:9092',
        'enable.auto.commit' => 'false',
    ],
    'topic' => [
        'auto.offset.reset' => 'beginning',
    ],
];
