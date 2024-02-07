<?php
/* This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/. */
?>
<?php
require_once __DIR__ . "/../../../../../component/BaseModel.php";
/**
 * This class is used to prepare all data related to the cmsPreference component such
 * that the data can easily be displayed in the view of the component.
 */
class ModuleLabJSModel extends BaseModel
{

    /* Constructors ***********************************************************/

    /**
     * The constructor.
     *
     * @param array $services
     *  An associative array holding the differnt available services. See the
     *  class definition BasePage for a list of all services.
     */
    public function __construct($services)
    {
        parent::__construct($services);
    }

    /**
     * Insert a new LabJS.     
     * @return int
     *  The id of the new lab or false if the process failed.
     */
    public function insert_new_lab()
    {
        try {
            $this->db->begin_transaction();
            $sid = $this->db->insert(SURVEYJS_TABLE_SURVEYS, array(
                "lab_generated_id" => "SVJS_" . substr(uniqid(), -15)
            ));
            $this->transaction->add_transaction(
                transactionTypes_insert,
                transactionBy_by_user,
                $_SESSION['id_user'],
                SURVEYJS_TABLE_SURVEYS,
                $sid
            );
            $this->db->commit();
            return $sid;
        } catch (Exception $e) {
            $this->db->rollback();
            return false;
        }
    }

    /**
     * Update a LabJS.   
     * @param int $sid
     * Lab id,
     * @param object $labJson
     * Lab json data
     * @return int
     *  The id of the new lab or false if the process failed.
     */
    public function update_lab($sid, $labJson)
    {
        try {
            $this->db->begin_transaction();
            $this->db->update_by_ids(SURVEYJS_TABLE_SURVEYS, array("config" => json_encode($labJson)), array('id' => $sid));
            $this->transaction->add_transaction(
                transactionTypes_update,
                transactionBy_by_user,
                $_SESSION['id_user'],
                SURVEYJS_TABLE_SURVEYS,
                $sid
            );
            $this->db->commit();
            return $sid;
        } catch (Exception $e) {
            $this->db->rollback();
            return false;
        }
    }

    /**
     * Get lab
     * @param int $sid
     * lab id
     * @param return object
     * Return the lab row
     */
    public function get_lab($sid)
    {
        $sql = "SELECT *, JSON_UNQUOTE(JSON_EXTRACT(config, '$.title')) AS lab_name
                FROM labs
                WHERE id = :id";
        return $this->db->query_db_first($sql, array(':id' => $sid));
    }

    /**
     * Get all labs
     * @return array
     * Return all labs as rows
     */
    public function get_labs()
    {
        return $this->db->select_table("view_labs");
    }

    /**
     * Delete lab
     * @param int $sid
     * The lab id
     * @return bool
     * Return the success result of the operation
     */
    public function delete_lab($sid)
    {
        return $this->db->remove_by_ids("labs", array("id" => $sid));
    }

    /**
     * Publish lab
     * @param int $sid
     * The lab id
     * @return bool
     * Return the success result of the operation
     */
    public function publish_lab($sid)
    {
        $sql = 'UPDATE labs
                SET published = config, published_at = NOW()
                WHERE id =:sid;';
        $res = $this->db->execute_update_db($sql, array(":sid" => $sid));
        if ($res) {
            // add new version of the lab
            $lab = $this->get_lab($sid);

            $res = $res &&  $this->db->insert(SURVEYJS_TABLE_SURVEYS_VERSIONS, array(
                "id_users" => $_SESSION['id_user'],
                "id_labs" => $sid,
                "config" => $lab['published'],
                "published" => 1
            ));
        }
        return $res;
    }
}
