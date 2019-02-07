<?php
/**
 * C2MediaStandard Plugin
 *
 * @author Steffen Wirth <wirth@c-two.de>
 * @date 01.02.2019
 */

namespace C2MediaStandard;

use Shopware\Components\Console\Application;

class C2MediaStandard extends \Shopware\Components\Plugin
{

    public function registerCommands(Application $application)
    {
        $application->add(new Commands\DatabaseCommand());
    }

}