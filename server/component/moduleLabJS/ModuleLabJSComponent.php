<?php
/* This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/. */
?>
<?php
require_once __DIR__ . "/../../../../../component/BaseComponent.php";
require_once __DIR__ . "/ModuleLabJSView.php";
require_once __DIR__ . "/ModuleLabJSModel.php";
require_once __DIR__ . "/ModuleLabJSController.php";

/**
 * The class to define the asset select component.
 */
class ModuleLabJSComponent extends BaseComponent
{
    /* Constructors ***********************************************************/

    /**
     * The constructor creates an instance of the Model class and the View
     * class and passes them to the constructor of the parent class.
     *
     * @param array $services
     *  An associative array holding the different available services. See the
     *  class definition BasePage for a list of all services.
     * @param number $id_page
     *  The parent page id
     */
    public function __construct($services, $params)
    {
        $lid = isset($params['lid']) ? intval($params['lid']) : null;
        $mode = isset($params['mode']) ? $params['mode'] : null;
        $model = new ModuleLabJSModel($services, $lid);
        $controller = new ModuleLabJSController($model, $mode, $lid);
        $view = new ModuleLabJSView($model, $controller, $mode, $lid);
        parent::__construct($model, $view, $controller);
    }
}
?>
