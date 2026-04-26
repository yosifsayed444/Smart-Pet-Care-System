<?php

class Message
{
    use Model;

    protected $table = 'messages';

    protected $allowedColumns = [

        'name',
        'email',
        'subject',
        'message'

    ];
}