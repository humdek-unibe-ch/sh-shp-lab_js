var labjs_experiment;
var labjs_response_id
var labJSConfig;
var labJSFields;

/**
 * Initializes the LabJS experiment.
 * This function is called when the document is ready. It retrieves LabJS configurations and fields
 * from elements with the class 'selfHelp-lab-js-holder', then loads and runs the experiment.
 */
$(document).ready(function () {
    initLabJS();
});

/**
 * Initializes the LabJS experiment based on the configurations obtained from elements with the class 'selfHelp-lab-js-holder'.
 */
function initLabJS() {
    // Define labjs_experimentc
    $('.selfHelp-lab-js-holder').each(function () {
        labJSConfig = $(this).data('lab-js');
        labJSFields = $(this).data('lab-js-fields');
        $(this).removeAttr('data-lab-js');
        $(this).removeAttr('data-lab-js-fields');
        loadExperiment(labJSConfig);
    });
}

/**
 * Generates a unique identifier for LabJS responses.
 * @returns {string} A unique LabJS response identifier.
 */
function generate_labjs_response_id() {
    var dateNow = Date.now();
    const uniqueId = dateNow.toString(36) + Math.random().toString(36).substring(2, 7);
    return "R_LABJS_" + uniqueId.substring(uniqueId.length - 16);
}

/**
 * Saves data to the LabJS datastore for the Self-Help application.
 * @param {string} trigger_type - The type of trigger.
 * @param {object} [extra_data] - Additional data to save.
 */
function saveDataToSelfHelp(trigger_type, extra_data) {
    if (!extra_data) {
        extra_data = {
            "trigger_type": trigger_type
        };
    } else {
        extra_data['trigger_type'] = trigger_type;
    }
    extra_data['labjs_response_id'] = labjs_response_id;
    extra_data['labjs_generated_id'] = labJSFields['labjs_generated_id'];
    extra_data['redirect_at_end'] = labJSFields['redirect_at_end'];
    labjs_experiment.options.datastore.transmit("#", extra_data);
    if (extra_data['trigger_type'] == 'finished' && extra_data['redirect_at_end'] && extra_data['redirect_at_end'] != '') {
        // redirect on finish and if redirect url is set
        window.location.href = extra_data['redirect_at_end'];
    }    
}

/**
 * Loads the LabJS experiment using the provided configuration.
 * @param {object} exp - The LabJS experiment configuration.
 */
function loadExperiment(exp) {
    loadFiles(exp);
    var componentTree = makeComponentTree(exp.components, 'root');

    // adjust plugins    
    Object.entries(exp.components).forEach(([keyComp, comp]) => {
        if (comp.plugins) {
            Object.entries(comp.plugins).forEach(([keyPlugin, plugin]) => {
                if (plugin && plugin.type == 'fullscreen') {
                    plugin['path'] = 'lab.plugins.Fullscreen';
                }
            });
        }
    });
    labjs_experiment = lab.util.fromObject(componentTree);
    labjs_response_id = generate_labjs_response_id();
    labjs_experiment.run();
}

/**
 * Loads files used in the LabJS experiment if they are specified in the configuration.
 * @param {object} obj - The LabJS experiment configuration.
 */
function loadFiles(obj) {
    for (let keyComp in obj.components) {
        var comp = obj.components[keyComp];
        for (let keyFiles in comp.files) {
            var file = comp.files[keyFiles];
            if (obj.files.files[file.poolPath] && obj.files.files[file.poolPath].content) {
                file.poolPath = obj.files.files[file.poolPath].content;
            }
        };
    }
}


// Generic grid processing
const processGrid = (grid, colnames = null, types = undefined) =>
    grid.rows
        // Filter rows without data
        .filter(r => !r.every(c => c.trim() === ''))
        // Convert types if requested
        .map(r => r.map((c, i) => makeType(c, types ? types[i] : undefined)))
        // Use column names to create array of row objects.
        // If column names are passed as a parameter,
        // use those, otherwise rely on the grid object
        .map(r => _.fromPairs(_.zip(colnames || grid.columns, r)))

const processFiles = files =>
    _.fromPairs(
        files.map(f => [f.localPath.trim(), f.poolPath.trim()])
    )

const processMessageHandlers = (messageHandlers) =>
    _.fromPairs(
        messageHandlers
            .filter(h => h.message.trim() !== '' && h.code.trim() !== '')
            // TODO: Evaluate the safety implications
            // of the following de-facto-eval.
            .map(h => [
                h.message,
                adaptiveFunction(h.code)
            ])
    )

const processParameters = parameters =>
    _.fromPairs(
        parameters
            .filter(r => r.name.trim() !== '' && r.value.trim() !== '')
            .map(r => [r.name.trim(), makeType(r.value, r.type)])
    )

const createResponsePair = r =>
    // Process an object with the structure
    // { label: 'label', event: 'keypress', ...}
    // into an array with two parts: a label,
    // and an event definition, such as
    // ['keypress(r)', 'red']
    [
        `${r.event}` +
        `${r.filter ? `(${r.filter.trim()})` : ''}` +
        `${r.target ? ` ${r.target.trim()}` : ''}`,
        r.label?.trim() ?? ''
    ]

// Process individual fields
const processResponses = (responses) => {
    // Process each of these objects into an array
    // of [responseParams, label] pairs
    const pairs = responses.map(createResponsePair)
    // Finally, create an object of
    // { responseParams: label } mappings
    return _.fromPairs(pairs)
}

// Template parameters are also a grid,
// but column names and data types are defined
// as properties of an object.
const processTemplateParameters = grid =>
    processGrid(
        grid,
        grid.columns.map(c => c.name.trim()),
        grid.columns.map(c => c.type)
    )

const processShuffleGroups = columns =>
    Object.values(
        // Collect columns with the same shuffleGroup property
        _.groupBy(
            columns.filter(c => c.shuffleGroup !== undefined),
            'shuffleGroup'
        )
    ).map(
        // Extract column names
        g => g.map(c => c.name)
    )

const processItems = items =>
    items
        .filter(i => i.label !== '')
        .map(i => {
            // Provide a default name based on the label
            // for the items that require one
            if (['text', 'divider'].includes(i.type)) {
                return i
            } else {
                return ({
                    ...i,
                    name: i.name || slugify(i.label || '')
                })
            }
        })

const processContent = (nodeType, content) => {
    switch (nodeType) {
        case 'lab.canvas.Screen':
            return content.map(c => _.pick(c, [
                'type', 'left', 'top', 'angle', 'width', 'height',
                'stroke', 'strokeWidth', 'fill',
                // Text
                'text', 'fontStyle', 'fontWeight', 'fontSize', 'fontFamily',
                'lineHeight', 'textAlign', 'textBaseline',
                // Image
                'src', 'autoScale',
                // AOI
                'label',
            ]))
        default:
            return content
    }
}

// Process any single node in isolation
const processNode = node => {
    // Options to exclude from JSON output
    const filteredOptions = ['skipCondition']

    // TODO: This filters empty string values, which are
    // created by empty form fields in the builder. This is
    // hackish, and may not work indefinately -- it might
    // have to be solved on the input side, or by making
    // the library more resilient to malformed input.
    // Either way, this is probably not the final solution.
    const filterOptions = (value, key) =>
        value !== '' &&
        !(key.startsWith('_') || filteredOptions.includes(key))

    const output = Object.assign({}, _.pickBy(node, filterOptions), {
        content: processContent(node.type, node.content),
        files: node.files
            ? processFiles(node.files)
            : {},
        messageHandlers: node.messageHandlers
            ? processMessageHandlers(node.messageHandlers)
            : node.messageHandlers,
        parameters: node.parameters
            ? processParameters(node.parameters)
            : {},
        items: node.items
            ? processItems(node.items)
            : null,
        responses: node.responses
            ? processResponses(node.responses)
            : {},
        skip: node.skip || node.skipCondition || undefined,
        templateParameters: node.templateParameters
            ? processTemplateParameters(node.templateParameters)
            : node.templateParameters,
        shuffleGroups: node.templateParameters
            ? processShuffleGroups(node.templateParameters.columns || [])
            : node.shuffleGroups,
    })

    // Remove undefined and null values
    // (serialize-js used to do this for us)
    return _.pickBy(output, _.identity)
}

// Process a node and its children
const makeComponentTree = (data, root) => {
    const currentNode = processNode(data[root])

    if (currentNode) {
        const output = Object.assign({}, currentNode)

        // Convert children, if available
        if (currentNode.children) {
            switch (currentNode.type) {
                case 'lab.flow.Sequence':
                    // A sequence can have several components as content
                    output.content = currentNode.children
                        .map(c => makeComponentTree(data, c))
                    break
                case 'lab.flow.Loop':
                    // A loop has a single template
                    if (!_.isEmpty(currentNode.children)) {
                        output.template = makeComponentTree(data, currentNode.children[0])
                    }
                    break
                case 'lab.canvas.Frame':
                case 'lab.html.Frame':
                    // A loop has a single template
                    if (!_.isEmpty(currentNode.children)) {
                        output.content = makeComponentTree(data, currentNode.children[0])
                    }
                    break
                default:
                    // TODO: This won't catch canvas-based
                    // components, but it also doesn't need
                    // to right now.
                    break
            }

            // After parsing, children components are no longer needed
            delete output.children
        }

        // Delete unused fields
        delete output.id

        return output
    } else {
        return {}
    }
}

const makeType = (value, type) => {
    if (type === undefined) {
        // Return value unchanged
        return value
    } else {
        // Convert types
        switch (type) {
            case 'string':
                // Trim strings to avoid problems
                // caused by invisible spaces
                return _.toString(value).trim()
            case 'number':
                return value.trim() === '' ? null : _.toNumber(value)
            case 'boolean':
                // Only 'true' and 'false' are
                // accepted as values.
                // eslint-disable-next-line default-case
                switch (value.trim()) {
                    case 'true':
                        return true
                    case 'false':
                        return false
                }
            // eslint-disable-next-line no-fallthrough
            default:
                return null
        }
    }
}

// Regex for detecting awaits in a code snippet
const awaitRegex = /(^|[^\w])await\s+/m

// Async function constructor
// The eval call here is needed to circumvent CRA's polyfills,
// and probably can be removed at some later point
// eslint-disable-next-line no-new-func
const AsyncFunction = new Function(
    'return Object.getPrototypeOf(async function(){}).constructor'
)()

const adaptiveFunction = code =>
    // Build an async function if await appears in the source
    // NOTE: This is a relatively coarse and naive check.
    // It works for us™ because we don't need to be careful
    // about accidentally declaring a function async:
    // In the situations where we apply them, the return values
    // are not important, just that the function returns at all.
    // Alternatively, we could check whether parsing the function
    // works, and listen for syntax errors. I'm lazy. -F
    code.match(awaitRegex)
        ? new AsyncFunction(code)
        // eslint-disable-next-line no-new-func
        : new Function(code)
