-- add plugin entry in the plugin table
INSERT IGNORE INTO plugins (name, version) 
VALUES ('lab-js', 'v1.1.0');

-- add `debug` field to style `labJS`
INSERT IGNORE INTO `styles_fields` (`id_styles`, `id_fields`, `default_value`, `help`) VALUES (get_style_id('labJS'), get_field_id('debug'), 0, 'If *checked*, debug messages will be rendered to the screen. These might help to understand the result of a condition evaluation. **Make sure that this field is *unchecked* once the page is productive**.');
