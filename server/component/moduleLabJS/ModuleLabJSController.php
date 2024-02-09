<?php
/* This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/. */
?>
<?php
require_once __DIR__ . "/../../../../../component/BaseController.php";
/**
 * The controller class of the group insert component.
 */
class ModuleLabJSController extends BaseController
{
    /* Private Properties *****************************************************/


    /* Constructors ***********************************************************/

    /**
     * The constructor.
     *
     * @param object $model
     *  The model instance of the component.
     */
    public function __construct($model, $mode, $lid)
    {
        parent::__construct($model);
        if (isset($mode) && !$this->check_acl($mode)) {
            return false;
        }
        if ($mode === INSERT) {
            //insert mode
            $lid = $this->model->insert_new_lab();
            if ($lid) {
                // redirect in update mode with the newly created lab id
                $url = $this->model->get_link_url(PAGE_LAB_JS_MODE, array("mode" => UPDATE, "lid" => $lid));
                header('Location: ' . $url);
            }
        } else if ($mode === UPDATE && $lid > 0 && isset($_POST['config']) && isset($_POST['name'])) {
            $this->model->update_labjs($lid, $_POST['config']);
        } else if ($mode === UPDATE && $lid > 0 && isset($_POST['mode']) && $_POST['mode'] == 'publish') {
            $this->model->publish_lab($lid);
        } else if ($mode === DELETE && $lid > 0) {
            $del_res = $this->model->delete_lab($lid);
            if ($del_res) {
                header('Location: ' . $this->model->get_link_url("moduleLabJS"));
            } else {
                $this->fail = true;
                $this->error_msgs[] = "Failed to delete lab: " . $lid;
            }
        }
    }

    /**
     * Check the acl for the current user and the current page
     * @return bool
     * true if access is granted, false otherwise.
     */
    protected function check_acl($mode)
    {
        if (!$this->model->get_services()->get_acl()->has_access($_SESSION['id_user'], $this->model->get_services()->get_db()->fetch_page_id_by_keyword(PAGE_LAB_JS_MODE), $mode)) {
            $this->fail = true;
            $this->error_msgs[] = "You don't have rights to " . $mode . " this lab";
            return false;
        } else {
            return true;
        }
    }

    /* Public Methods *********************************************************/
}
?>
