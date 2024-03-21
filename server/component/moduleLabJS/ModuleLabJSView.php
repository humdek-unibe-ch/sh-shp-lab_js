<?php
/* This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/. */
?>
<?php
require_once __DIR__ . "/../../../../../component/BaseView.php";
require_once __DIR__ . "/../../../../../component/style/BaseStyleComponent.php";

/**
 * The view class of the asset select component.
 */
class ModuleLabJSView extends BaseView
{
    /* Constructors ***********************************************************/

    /**
     * Lab id, 
     * if it is > 0  edit/delete lab page     
     */
    private $lid;

    /**
     * The mode type of the form EDIT, DELETE, INSERT, VIEW     
     */
    private $mode;

    /**
     * the current selected lab
     */
    private $lab;

    /**
     * The constructor.
     *
     * @param object $model
     *  The model instance of the component.
     */
    public function __construct($model, $controller, $mode, $lid)
    {
        parent::__construct($model, $controller);
        $this->mode = $mode;
        $this->lid = $lid;
        if ($this->lid) {
            $this->lab = $this->model->get_labjs($this->lid);
        }
    }

    /* Private Methods ********************************************************/

    /* Public Methods *********************************************************/

    /**
     * Render the footer view.
     */
    public function output_content()
    {
        if (!$this->mode) {
            require __DIR__ . "/tpl_moduleLabJS.php";
        } else {
            require __DIR__ . "/tpl_moduleLabJS_Alerts.php";
            $card_title = '<span>Lab JS </span>'  . (isset($this->lab['labjs_generated_id']) ? ('<div> <code>&nbsp;' . $this->lab['labjs_generated_id'] . '</code></div>') : '');
            $labJSHolderChildren = array(
                $this->output_check_multiple_users(true),
                new   BaseStyleComponent("div", array(
                    "css" => "mb-3 d-flex justify-content-between",
                    "children" => array(
                        new   BaseStyleComponent("div", array(
                            "css" => "",
                            "children" => array(
                                new BaseStyleComponent("button", array(
                                    "label" => "Back to All Labs",
                                    "url" => $this->model->get_link_url("moduleLabJS"),
                                    "type" => "secondary",
                                )),
                                new BaseStyleComponent("button", array(
                                    "label" => "Dashboard",
                                    "url" => $this->model->get_link_url("moduleLabJSDashboard", array("lid" => $this->lid)),
                                    "type" => "primary",
                                    "css" => "ml-3"
                                )),
                                new BaseStyleComponent("button", array(
                                    "label" => "Versions",
                                    "url" => $this->model->get_link_url("moduleLabJSVersions", array("lid" => $this->lid)),
                                    "type" => "primary",
                                    "css" => "ml-3"
                                ))
                            )
                        )),
                        new BaseStyleComponent("button", array(
                            "label" => "Delete Labjs",
                            "id" => "lab-js-delete-btn",
                            "url" => $this->model->get_link_url(PAGE_LAB_JS_MODE, array("mode" => DELETE, "lid" => $this->lid)),
                            "type" => "danger",
                            "confirmation_title" => "Delete LabJS",
                            "label_cancel" => "Cancel",
                            "label_continue" => "Delete",
                            "label_message" => "Are you sure that you want to delete LabJS: <code>" . ($this->lab ? $this->lab['labjs_generated_id'] : "") . "</code>?",
                        ))
                    )
                )),
                new BaseStyleComponent("card", array(
                    "css" => "lab-js-card",
                    "is_expanded" => true,
                    "is_collapsible" => false,
                    "type" => "warning",
                    "id" => "lab-js-card",
                    "title" => $card_title,
                    "children" => array(
                        new BaseStyleComponent("form", array(
                            "label" => "Update LabJS",
                            "id" => "lab-js-form",
                            "url" => $this->model->get_link_url(PAGE_LAB_JS_MODE, array("mode" => UPDATE, "lid" => $this->lid)),
                            "type" => "warning",
                            "url_cancel" => $this->model->get_link_url(PAGE_LAB_JS, array()),
                            "children" => array(
                                new BaseStyleComponent("input", array(
                                    "type_input" => "hidden",
                                    "name" => "labjs_generated_id",
                                    "value" => isset($this->lab['generated_id']) ? $this->lab['generated_id'] : '',
                                    "is_required" => true
                                )),
                                new BaseStyleComponent("input", array(
                                    "label" => "LabJS experiment name",
                                    "type_input" => "text",
                                    "name" => "name",
                                    "value" => isset($this->lab['name']) ? $this->lab['name'] : '',
                                    "is_required" => true,
                                    "css" => "mb-3",
                                    "placeholder" => "Enter LabJS experiment name",
                                )),
                                new BaseStyleComponent("textarea", array(
                                    "label" => "LabJS JSON",
                                    "name" => "config",
                                    "css" => "lab-js-value mb-3",
                                    "value" => isset($this->lab['config']) ? $this->lab['config'] : '',
                                    "type_input" => "json",
                                    "json_mapper" => false,
                                    "placeholder" => "LabJS JSON",
                                ))
                            ),
                        ))
                    )
                ))
            );
            $labJSHolder = new BaseStyleComponent("div", array(
                "css" => "m-3",
                "children" => $labJSHolderChildren
            ));

            $labJSHolder->output_content();
        }
    }

    public function output_content_mobile()
    {
        echo 'mobile';
    }

    /**
     * Render the alert message.
     */
    protected function output_alert()
    {
        $this->output_controller_alerts_fail();
        $this->output_controller_alerts_success();
    }

    /**
     * Get js include files required for this component. This overrides the
     * parent implementation.
     *
     * @return array
     *  An array of js include files the component requires.
     */
    public function get_js_includes($local = array())
    {
        if (empty($local)) {
            $local = array(
                __DIR__ . "/js/lab.js",
            );
        }
        return parent::get_js_includes($local);
    }

    /**
     * Get css include files required for this component. This overrides the
     * parent implementation.
     *
     * @return array
     *  An array of css include files the component requires.
     */
    public function get_css_includes($local = array())
    {
        if (empty($local)) {
            if (DEBUG) {
                $local = array();
            } else {
                $local = array(__DIR__ . "/../../../css/ext/lab-js.min.css?v=" . rtrim(shell_exec("git describe --tags")));
            }
        }
        return parent::get_css_includes($local);
    }

    /**
     * Render the sidebar buttons
     */
    public function output_side_buttons()
    {
        //show create button
        $createButton = new BaseStyleComponent("button", array(
            "label" => "Create New LabJS",
            "url" => $this->model->get_link_url(PAGE_LAB_JS_MODE, array("mode" => INSERT)),
            "type" => "secondary",
            "css" => "d-block mb-3",
        ));
        $createButton->output_content();
    }

    /**
     * render the page content
     */
    public function output_page_content()
    {
        require __DIR__ . "/tpl_moduleLabJS_table.php";
    }

    /**
     * Render the rows for the labs
     */
    public function output_labs_rows()
    {
        foreach ($this->model->get_labs() as $lab) {
            require __DIR__ . "/tpl_moduleLabJS_row.php";
        }
    }
}
?>
