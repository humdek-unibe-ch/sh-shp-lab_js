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
            $card_title = '<span>Lab JS </span>'  . (isset($this->lab['lab_generated_id']) ? ('<div> <code>&nbsp;' . $this->lab['lab_generated_id'] . '</code></div>') : '');
            if (isset($this->lab['published']) && $this->lab['published']) {
                $card_title = $card_title . '<span class="text-right flex-grow-1">Published at: <code id="lab-js-publish-at">' . $this->lab['published_at'] . '</code> </span>';
            } else {
                $card_title = $card_title . '<span class="text-right flex-grow-1"><code>Not published yet</code> </span>';
            }
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
                                    "label" => "Publish",
                                    "id" => "lab-js-publish",
                                    "url" => "#",
                                    "type" => "warning",
                                    "css" => "ml-3 " . (isset($this->lab['config']) && $this->lab['config'] == $this->lab['published'] ? 'disabled' : '')
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
                        // new BaseStyleComponent("template", array(
                        //     "path" => __DIR__ . "/tpl_moduleLabJSBuilder.php",
                        //     "items" => array(
                        //         "lab" => $this->lab
                        //     )
                        // ))
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
                // __DIR__ . "/js/1_knockout-latest.js",
                // __DIR__ . "/js/2_lab.core.min.js",
                // __DIR__ . "/js/3_lab-knockout-ui.min.js",
                // __DIR__ . "/js/4_lab-creator-core.min.js",
                // __DIR__ . "/js/5_lab-creator-knockout.min.js",
                // __DIR__ . "/js/6_lab-creator-core.i18n.min.js",
                // __DIR__ . "/js/7_lab.i18n.min.js",
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
                $local = array(
                    // __DIR__ . "/css/lab.min.css",
                    // __DIR__ . "/../style/labJS/css/modern.min.css",
                    // __DIR__ . "/../style/labJS/css/defaultV2.min.css",
                    // __DIR__ . "/css/lab-creator-core.min.css",
                    // __DIR__ . "/css/lab.css"
                );
            } else {
                $local = array(__DIR__ . "/../../../../lab-js/css/ext/lab-js.min.css?v=" . rtrim(shell_exec("git describe --tags")));
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
