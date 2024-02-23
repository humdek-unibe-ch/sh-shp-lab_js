<?php
/* This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/. */
?>
<?php
require_once __DIR__ . "/../../../../../../component/BaseController.php";
/**
 * The controller class of formUserInput style component.
 */
class LabJSController extends BaseController
{
    /* Private Properties *****************************************************/



    /* Constructors ***********************************************************/

    /**
     * The constructor.
     *
     * @param object $model
     *  The model instance of the login component.
     */
    public function __construct($model)
    {
        parent::__construct($model);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Decode transmitted data
            $data = json_decode(file_get_contents('php://input'), true);
        }
    }

    /* Private Methods ********************************************************/
}
?>
