-- add plugin entry in the plugin table
UPDATE `plugins`
SET version = 'v1.2.0'
WHERE `name` = 'lab-js';

-- register hook  for addTransaction
INSERT IGNORE INTO `hooks` (`id_hookTypes`, `name`, `description`, `class`, `function`, `exec_class`, `exec_function`) 
VALUES ((SELECT id FROM lookups WHERE lookup_code = 'hook_overwrite_return' LIMIT 0,1), 'labJs-addTransaction', 'Modify add_transaction function', 'Transaction', 'add_transaction', 'LabJSHooks', 'add_transaction');
