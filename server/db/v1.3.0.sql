-- add plugin entry in the plugin table
UPDATE `plugins`
SET version = 'v1.3.0'
WHERE `name` = 'lab-js';

-- Carry values between pages through the URL, as the surveyJS style already
-- does. `url_params` saves the route parameters and query string of the
-- requested page as `extra_param_<name>`; `redirect_at_end` gains `{{name}}`
-- interpolation so they can be handed to the next page.
INSERT IGNORE INTO `fields` (`id`, `name`, `id_type`, `display`)
VALUES (NULL, 'url_params', get_field_type_id('checkbox'), 0);

INSERT IGNORE INTO `styles_fields` (`id_styles`, `id_fields`, `default_value`, `help`)
VALUES (get_style_id('labJS'), get_field_id('url_params'), 0,
'If enabled, parameters can be passed via the url, as a path segment or query string. Example: `?code=test&par1=2`. Each parameter is saved with the experiment data as `extra_param_<name>` and can be referenced in `redirect_at_end` as `{{extra_param_<name>}}`.');

UPDATE `styles_fields`
SET `help` = 'Redirect to `url` after the experiment is saved with status `finished` with function `saveDataToSelfHelp`.

Accepts either a page keyword (`my-page`) or a template containing `{{name}}` placeholders (`my-page?code={{extra_param_code}}`). Placeholders are filled from the data being saved, so any `extra_param_*` value received through `url_params`, as well as `labjs_response_id`, can be handed on to the next page. Missing values resolve to an empty string.'
WHERE `id_styles` = get_style_id('labJS') AND `id_fields` = get_field_id('redirect_at_end');

-- Let a study choose what identifies a response row. Empty (the default) keys
-- on `labjs_response_id` as before. Set to a column, components sharing a data
-- table build one row. The column must identify a participant on its own:
-- guest writes share a user, so a repeated value merges people.
INSERT IGNORE INTO `fields` (`id`, `name`, `id_type`, `display`)
VALUES (NULL, 'update_based_on', get_field_type_id('text'), 0);

INSERT IGNORE INTO `styles_fields` (`id_styles`, `id_fields`, `default_value`, `help`)
VALUES (get_style_id('labJS'), get_field_id('update_based_on'), '',
'Column that identifies a response row. Empty keeps the default: one row per run, keyed on labjs_response_id. Set to a column name and the experiment updates the row already holding that value - so several components sharing a labjs_generated_id build one row. A key matching no row falls back to the default rather than inserting. The column must identify a single participant.');
