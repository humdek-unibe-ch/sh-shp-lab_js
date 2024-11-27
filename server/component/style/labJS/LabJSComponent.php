<?php
/* This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/. */
?>
<?php
require_once __DIR__ . "/../../../../../../component/BaseComponent.php";
require_once __DIR__ . "/LabJSView.php";
require_once __DIR__ . "/LabJSModel.php";
require_once __DIR__ . "/LabJSController.php";

/**
 * A component class for a LabJS style component. 
 *
 */
class LabJSComponent extends BaseComponent
{
    /* Constructors ***********************************************************/

    /**
     * The constructor creates an instance of the Model class and the View
     * class and passes the view instance to the constructor of the parent
     * class.
     *
     * @param array $services
     *  An associative array holding the different available services. See the
     *  class definition basepage for a list of all services.
     * @param int $id
     *  The section id of this navigation component.
     * @param array $params
     *  The list of get parameters to propagate.
     * @param number $id_page
     *  The id of the parent page
     * @param array $entry_record
     *  An array that contains the entry record information.
     */
    public function __construct($services, $id, $params, $id_page, $entry_record)
    {
        $model = new LabJSModel($services, $id, $params, $id_page, $entry_record);
        $controller = null;
        if (!$model->is_cms_page())
            $controller = new LabJSController($model);
        if ($model->get_show_view()) {
            $view = new LabJSView($model, $controller);
            parent::__construct($model, $view, $controller);
        }
    }
}
?>
