<?php
/**
 * Created by PhpStorm.
 * User: kel
 * Date: 23.03.2015
 * Time: 10:37
 */

class ExportAction extends Action {

    public function run()
    {
        print_r(func_get_args());
        echo 'ActionExport';
    }

}