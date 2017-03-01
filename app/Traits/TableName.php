<?php

/**
 * Created by PhpStorm.
 * vim: set ai ts=4 sw=4 ff=unix:
 * Date: 12/15/16
 * Time: 10:55
 * File: TableName.php
 */

namespace Traits;


trait TableName
{

    public static function tableName()
    {
        return with(new static)->getTable();
    }

}
