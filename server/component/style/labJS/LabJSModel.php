<?php
/* This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/. */
?>
<?php
require_once __DIR__ . "/../../../../../../component/style/StyleModel.php";

/**
 * This class is used to prepare all data related to the form style
 * components such that the data can easily be displayed in the view of the
 * component.
 */
class LabJSModel extends StyleModel
{
    /* Private Properties *****************************************************/

    /**
     * If checked the lab can be done once per schedule
     */
    private $once_per_schedule;

    /**
     * If checked the lab can be done only once by an user. The checkbox `once_per_schedule` is ignore if this is checked
     */
    private $once_per_user;

    /**
     * Start time when the lab should be available
     */
    private $start_time;

    /**
     * End time when the lab should be not available anymore
     */
    private $end_time;

    /**
     * Start time converted to date
     */
    private $start_time_calced;

    /**
     * End time converted to date and adjusted if smaller than start time
     */
    private $end_time_calced;

    private $show_view = true;

    /* Constructors ***********************************************************/

    /**
     * The constructor fetches all session related fields from the database.
     *
     * @param object $services
     *  An associative array holding the different available services. See the
     *  class definition base page for a list of all services.
     * @param int $id
     *  The section id of the navigation wrapper.
     * @param array $params
     *  The list of get parameters to propagate.
     * @param number $id_page
     *  The id of the parent page
     * @param array $entry_record
     *  An array that contains the entry record information.
     */
    public function __construct($services, $id, $params, $id_page, $entry_record)
    {
        parent::__construct($services, $id, $params, $id_page, $entry_record);
        $this->once_per_schedule = $this->get_db_field('once_per_schedule', 0);
        $this->once_per_user = $this->get_db_field('once_per_user', 0);
        $this->start_time = $this->get_db_field('start_time', '00:00');
        $this->end_time = $this->get_db_field('end_time', '00:00');
    }

    /* Private Methods ********************************************************/

    /* Private Methods *********************************************************/

    /**
     * Get the lab
     * @return object
     * Return the row for the lab
     */
    private function get_raw_lab()
    {
        $sid = $this->get_db_field('lab-js', '');
        return $this->db->query_db_first("SELECT * FROM labjs WHERE id = :id", array(':id' => $sid));
    }

    /**
     * Prepare the data for processing.
     *
     * This function prepares the provided data for further processing. It checks each key in the data array
     * and formats it accordingly. If the key is one of 'labjs_response_id', 'trigger_type', or 'labjs_generated_id',
     * or was received through url_params ('extra_param_*'),
     * it keeps the original value. If the value is an array, it converts it to JSON format and prefixes the key
     * with 'extra_data_'. If the value is not an array, it keeps the original value and prefixes the key with 'extra_data_'.
     * Additionally, it stores the original data in a key '_raw_data' in JSON format under the assumption that the original data
     * contains a key named 'data'.
     *
     * @param object $data The data to prepare.
     * @return array The prepared data.
     */
    private function prepare_data($data)
    {
        $prepared_data = array();
        foreach ($data['metadata'] as $key => $value) {
            // Values received through url_params keep their own name, as the
            // surveyJS style stores them, so a study mixing the two lines up.
            if (strpos($key, 'extra_param_') === 0) {
                $prepared_data[$key] = $value;
                continue;
            }
            if (in_array($key, ['labjs_response_id', 'trigger_type', 'labjs_generated_id'])) {
                $prepared_data[$key] = $value;
            } else {
                if (is_array($value)) {
                    $prepared_data['extra_data_' . $key] = json_encode($value);
                } else {
                    $prepared_data['extra_data_' . $key] = $value;
                }
            }
        }
        $prepared_data['_raw_data'] = json_encode($data['data'] ?? array());
        return $prepared_data;
    }

    /* Public Methods *********************************************************/

    /**
     * Get the lab and apply all dynamic variables
     * @return object | false
     * Return the info for the lab
     */
    public function get_lab()
    {
        $lab = $this->get_raw_lab();
        if (!$lab) {
            return false;
        }
        $lab['name'] = 'lab-js';
        $data_config = $this->get_db_field('data_config');
        $lab['content'] = $lab['config'];
        $lab['section_name'] = $this->section_name;
        $lab['content'] = $this->calc_dynamic_values($lab, $data_config);
        $lab['config'] = $lab['content'];
        return $lab;
    }

    /**
     * The updateBasedOn key this experiment identifies a row with, or null for
     * the default `labjs_response_id` behaviour.
     *
     * `get_data()` takes a filter string rather than bound parameters, so a
     * value that could break out of it is rejected instead of escaped.
     *
     * @param array $data
     *  The prepared data being saved.
     * @return array|null
     */
    private function get_update_based_on_key($data)
    {
        $col = trim((string) $this->get_db_field('update_based_on', ''));
        if ($col === '' || !isset($data[$col])) {
            return null;
        }
        // A column name is an identifier; a value is compared literally.
        if (!preg_match('/^[A-Za-z_][A-Za-z0-9_]*$/', $col)) {
            return null;
        }
        $value = $data[$col];
        if (!is_scalar($value)) {
            return null;
        }
        $value = (string) $value;
        if ($value === '' || !preg_match('/^[A-Za-z0-9_.:@\- ]{1,190}$/', $value)) {
            return null;
        }
        return array($col => $value);
    }

    /**
     * Whether a row already answers to this key.
     *
     * @param string $table_name
     *  The data table the experiment writes to.
     * @param array $key
     *  Column => value, as returned by get_update_based_on_key().
     * @return bool
     */
    private function row_exists($table_name, $key)
    {
        $id_table = $this->user_input->get_dataTable_id($table_name);
        if (!$id_table) {
            return false;
        }
        $filter = '';
        foreach ($key as $col => $value) {
            $filter .= ' AND ' . $col . ' = "' . $value . '"';
        }
        $record = $this->user_input->get_data(
            $id_table,
            $filter,
            true,
            isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null,
            true
        );
        return !empty($record);
    }

    /**
     * Save lab js data as external table
     * @param object $data
     * Object with the data that should be saved
     */
    public function save_lab($data)
    {
        $data = $this->prepare_data($data);
        $lab = $this->get_raw_lab();
        if (isset($lab['labjs_generated_id']) && isset($data['labjs_generated_id']) && $data['labjs_generated_id'] == $lab['labjs_generated_id']) {
            if (isset($data['trigger_type'])) {
                $shared_key = $this->get_update_based_on_key($data);
                // Join the shared row only if one already answers to the key, so a
                // run that has not reached it yet keeps its own row.
                if ($shared_key !== null && $this->row_exists($data['labjs_generated_id'], $shared_key)) {
                    $this->user_input->save_data(transactionBy_by_user, $data['labjs_generated_id'], $data, $shared_key);
                    return true;
                }
                $updateBasedOn = array(
                    "labjs_response_id" => $data['labjs_response_id']
                );
                if ($data['trigger_type'] == actionTriggerTypes_started) {
                    $id_table = $this->user_input->get_dataTable_id($data['labjs_generated_id']);
                    $filter = '';
                    foreach ($updateBasedOn as $key => $value) {
                        $filter = $filter . ' AND ' . $key . ' = "' . $value . '"';
                    }
                    $record = $this->user_input->get_data(
                        $id_table,
                        $filter,
                        true,
                        $_SESSION['id_user'],
                        true
                    );
                    if ($record) {
                        $this->user_input->save_data(transactionBy_by_user, $data['labjs_generated_id'], $data, $updateBasedOn);
                        return true;
                    } else {
                        $this->user_input->save_data(transactionBy_by_user, $data['labjs_generated_id'], $data);
                        return true;
                    }
                } else {
                    $this->user_input->save_data(transactionBy_by_user, $data['labjs_generated_id'], $data, $updateBasedOn);
                    return true;
                }
            }
        }
        return false;
    }

    public function get_show_view(): bool
    {
        return $this->show_view;
    } 
    
    public function set_show_view(bool $show_view): void
    {
        $this->show_view = $show_view;
    }   
}
?>
