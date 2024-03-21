<?php
/* This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/. */
?>
<?php
require_once __DIR__ . "/../../../../../../component/style/StyleView.php";

/**
 * The view class of the formUserInput style component.
 */
class LabJSView extends StyleView
{
    /* Private Properties *****************************************************/

    /**
     * The lab id
     */
    private $sid;

    /**
     * The lab info
     */
    private $lab;

    /**
     * If it is set it redirects to this link after the lab is completed
     */
    private $redirect_at_end;


    /* Constructors ***********************************************************/

    /**
     * The constructor.
     *
     * @param object $model
     *  The model instance of a base style component.
     * @param object $controller
     *  The controller instance of the component.
     */
    public function __construct($model, $controller)
    {
        parent::__construct($model, $controller);
        $this->sid = $this->model->get_db_field('lab-js', '');
        if ($this->sid > 0) {
            $this->lab = $this->model->get_lab();
        }
        $this->redirect_at_end = $this->model->get_db_field('redirect_at_end', '');
    }


    /* Public Methods *********************************************************/

    /**
     * Render the style view.
     */
    public function output_content()
    {

        $redirect_at_end = preg_replace('/^\/+/', '', $this->redirect_at_end); // remove the first /
        $redirect_at_end = preg_replace('/^#+/', '', $this->redirect_at_end); // remove the first #
        $redirect_at_end = $this->model->get_link_url(str_replace("/", "", $redirect_at_end));
        $lab_fields = array(
            "redirect_at_end" => $redirect_at_end,
            "labjs_generated_id" => isset($this->lab['labjs_generated_id']) ? $this->lab['labjs_generated_id'] : null
        );
        $lab_fields = json_encode($lab_fields);
        require __DIR__ . "/tpl_labJS.php";
    }

    public function output_content_mobile()
    {
        $style = parent::output_content_mobile();
        $redirect_at_end = preg_replace('/^\/+/', '', $this->redirect_at_end); // remove the first /
        $redirect_at_end = preg_replace('/^#+/', '', $this->redirect_at_end); // remove the first #
        $redirect_at_end = $this->model->get_link_url(str_replace("/", "", $redirect_at_end));
        $style['redirect_at_end']['content'] = str_replace(BASE_PATH, "", $redirect_at_end);
        $style['lab_json'] = $this->lab['config'] ? json_decode($this->lab['config']) : [];
        $style['alert'] = '';
        $style['show_lab'] = true;
        $style['labjs_generated_id'] = $this->lab['labjs_generated_id'];
        return $style;
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
            if (DEBUG) {
                $local = array(
                    __DIR__ . "/js/1_lodash.min.js",
                    __DIR__ . "/js/1_flatted.min.js",
                    __DIR__ . "/js/2_lab.js",
                    __DIR__ . "/js/3_labJS.js"
                );
            } else {
                $local = array(__DIR__ . "/../../../../js/ext/lab-js.min.js?v=" . rtrim(shell_exec("git describe --tags")));
            }
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
                    __DIR__ . "/css/lab.css"
                );
            } else {
                $local = array(__DIR__ . "/../../../../css/ext/lab-js.min.css?v=" . rtrim(shell_exec("git describe --tags")));
            }
        }
        return parent::get_css_includes($local);
    }
}
?>
