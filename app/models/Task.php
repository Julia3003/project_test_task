<?php

namespace models;

use core\BaseModel;

class Task extends BaseModel
{
    /**
     * @return array
     */
    public function getTasksWithAgentName()
    {
        $sql = "SELECT CONCAT(`agents`.`surname`, ' ', `agents`.`name`) AS agent,
            SUM(CASE WHEN category = 'outage' THEN 1 ELSE 0 END) AS `outage`,
            SUM(CASE WHEN category = 'check-discount' THEN 1 ELSE 0 END) AS `check-discount`,
            SUM(CASE WHEN category = 'technical-issue' THEN 1 ELSE 0 END) AS `technical-issue`,
            SUM(CASE WHEN category = 'other' THEN 1 ELSE 0 END) AS `other`
        FROM `orders` INNER JOIN `agents` ON `orders`.`agent_id` = `agents`.`id` GROUP BY agent_id";
        $result = $this->db->query($sql);
        $tasks = $result->fetch_all(MYSQLI_ASSOC);
        if ($tasks) {
            return $tasks;
        }
        return [];
    }
    public function getSolvedTasksWithAgentNameByCriteria(string $criteria)
    {
        $sql = "SELECT CONCAT(`agents`.`surname`, ' ', `agents`.`name`) AS agent,
            SUM(CASE WHEN category = 'outage' THEN 1 ELSE 0 END) AS `outage`,
            SUM(CASE WHEN category = 'check-discount' THEN 1 ELSE 0 END) AS `check-discount`,
            SUM(CASE WHEN category = 'technical-issue' THEN 1 ELSE 0 END) AS `technical-issue`,
            SUM(CASE WHEN category = 'other' THEN 1 ELSE 0 END) AS `other`
        FROM `orders`  INNER JOIN `agents` ON `orders`.`agent_id` = `agents`.`id`
        WHERE $criteria AND status = 'solved'
        GROUP BY agent_id;";
        $result = $this->db->query($sql);
        $tasks = $result->fetch_all(MYSQLI_ASSOC);
        if ($tasks) {
            return $tasks;
        }
        return [];
    }
}
