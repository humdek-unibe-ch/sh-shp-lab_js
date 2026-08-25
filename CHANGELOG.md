# v1.3.0
### New feature
 - `url_params` on the `labJS` style: when enabled, the URL parameters of the requested page are handed to the experiment and each is saved with its data as `extra_param_<name>`. Both route parameters and the query string are read; a query parameter wins on a name clash. Off by default, so an experiment that does not set it is unaffected. The `surveyJS` style has worked this way since v1.0.0; this is the same contract and the same column names, so the two can be chained
 - `redirect_at_end` accepts `{{name}}` templates, filled on the client from the data being saved (any `extra_param_*`, `labjs_response_id`). A value without `{{` `}}` resolves exactly as before
 - `update_based_on` on the `labJS` style: names the column that identifies a response row. Empty (the default) keeps the existing behaviour, rows keyed on the generated `labjs_response_id`, one row per run. Set to a column name, the experiment updates the row already holding that value, so several components sharing a data table build one row together. A key matching no row falls back to the default rather than inserting, because the key often arrives part way through a run and inserting then would abandon the row already opened
 - `block_updates_when` on the `labJS` style: names a column that locks a row once it is set. Empty (the default) never locks. Set to a column name and a row whose value there is set and not "0" refuses further writes, so a resubmission under an already-used key cannot overwrite finished data. An experiment that writes the column itself is never blocked by it, so the run that finishes a study can still save. Pairs with `update_based_on`: one names the key, the other makes it single-use. The check runs in the model, so it holds for a direct POST as well as a normal submission
 - the keyed column must identify one participant on its own. With guest participants every write shares a user, so a value repeated across people would merge them into one row

# v1.2.0
### New feature
 - do not save `_raw_data` in transaction

# v1.1.10
### Bugfix
 - properly save the data only once

# v1.1.9
### Bugfix
 - use a global variable to know if the data was saved

# v1.1.8
### Bugfix
  - on `saveData` do not exit but add a flag to know that the data was saved

# v1.1.7
 - on `saveData` accept the data and exit;

# v1.1.6
 - on data save do not load the whole view. Just save the data.

# v1.1.5
 - do not load LabJS in CMS
 - properly save the data without duplication

# v1.1.4
### Bugfix
 - load first LabJs field before the experiment

# v1.1.3
### Bugfix
 - properly check if the LabJS is object

# v1.1.2 - Requires SelfHelp v7.0.0+
### New Features
 - make it compatible with the `user_input` refactoring
 - set `displayName` to the dataTable related to the LabJS survey

# v1.1.1
### Bugfix
 - fix the db version script

# v1.1.0
### New Features
 - add field `debug` to style `labJS`

### Bugfix
 - properly propagate `entry_record` to style `labJS`

# v1.0.3
### Bugfix
 - adjust the `css` to be as similar to the original

# v1.0.2
### Bugfix
 - add function `slugify`;

# v1.0.1
### Bugfix

- properly loads `csp` rules for`js`files when in CMS mode

# v1.0.0
### New Features

 - The LabJS related styles and components
 - Lab JS Style
