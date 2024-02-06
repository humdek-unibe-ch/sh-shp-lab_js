const tttest = {
    "components": {
        "1": {
            "id": "1",
            "type": "lab.html.Screen",
            "responses": [
                {
                    "label": "continue",
                    "event": "click",
                    "target": "button",
                    "filter": ""
                }
            ],
            "messageHandlers": [],
            "title": "Instructions",
            "content": "<header>\n  <h1>Your task</h1>\n</header>\n\n<main class=\"content-vertical-center content-horizontal-center\">\n  <div class=\"w-m text-justify\">\n    <p>In the following, you're going to see dots of different colors on the screen &mdash; either blue or green. Your task is to indicate the color of the dot, as quickly as you can while staying accurate. Please press the <kbd>S</kbd> key if you see a blue dot, and <kbd>L</kbd> if you see a green dot. \n    </p>\n    <hr>\n    <p>The dot will appear in one of several horizontal positions. You don't need to pay attention to the position &mdash; the color is all that counts.</p>\n    <img src=\"${ this.files['simon_green.svg'] }\" style=\"width: 100%\">\n    <p>During the task, we won't show you the unoccupied places, just a single dot at a time. Again, please indicate its color, regardless of position.</p>\n    <img src=\"${ this.files['simon_blue.svg'] }\" style=\"width: 100%\">\n    <p>Please click on the button below to start the task</p>\n  </div>\n</main>\n\n<footer class=\"content-horizontal-right\">\n  <button id=\"continue\">Continue &rarr;</button>\n</footer>",
            "notes": "Instruction",
            "parameters": [
                {
                    "name": "",
                    "value": "",
                    "type": "string"
                }
            ],
            "files": [
                {
                    "localPath": "simon_green.svg",
                    "poolPath": "embedded/9fa89c4e3dba7098b2ca91aed62d20c707369b93b3dd7af96a56e85b071a7634.svg"
                },
                {
                    "localPath": "simon_blue.svg",
                    "poolPath": "embedded/e031f99402d1ebdfb1276e246c3aa118869b0fd1cf9c66924d52ed1faf493567.svg"
                }
            ]
        },
        "2": {
            "id": "2",
            "type": "lab.flow.Loop",
            "children": [
                "3"
            ],
            "templateParameters": {
                "columns": [
                    {
                        "name": "position",
                        "type": "number"
                    },
                    {
                        "name": "color",
                        "type": "string"
                    },
                    {
                        "name": "congruency",
                        "type": "string"
                    },
                    {
                        "name": "power",
                        "type": "string"
                    }
                ],
                "rows": [
                    [
                        "-200",
                        "blue",
                        "congruent",
                        "strong"
                    ],
                    [
                        "-200",
                        "blue",
                        "congruent",
                        "strong"
                    ],
                    [
                        "-200",
                        "blue",
                        "congruent",
                        "strong"
                    ],
                    [
                        "-200",
                        "blue",
                        "congruent",
                        "strong"
                    ],
                    [
                        "-100",
                        "blue",
                        "congruent",
                        "weak"
                    ],
                    [
                        "-100",
                        "blue",
                        "congruent",
                        "weak"
                    ],
                    [
                        "-100",
                        "blue",
                        "congruent",
                        "weak"
                    ],
                    [
                        "-100",
                        "blue",
                        "congruent",
                        "weak"
                    ],
                    [
                        "0",
                        "blue",
                        "neutral",
                        "neutral"
                    ],
                    [
                        "0",
                        "blue",
                        "neutral",
                        "neutral"
                    ],
                    [
                        "0",
                        "blue",
                        "neutral",
                        "neutral"
                    ],
                    [
                        "0",
                        "blue",
                        "neutral",
                        "neutral"
                    ],
                    [
                        "100",
                        "blue",
                        "incongruent",
                        "weak"
                    ],
                    [
                        "100",
                        "blue",
                        "incongruent",
                        "weak"
                    ],
                    [
                        "100",
                        "blue",
                        "incongruent",
                        "weak"
                    ],
                    [
                        "100",
                        "blue",
                        "incongruent",
                        "weak"
                    ],
                    [
                        "200",
                        "blue",
                        "incongruent",
                        "strong"
                    ],
                    [
                        "200",
                        "blue",
                        "incongruent",
                        "strong"
                    ],
                    [
                        "200",
                        "blue",
                        "incongruent",
                        "strong"
                    ],
                    [
                        "200",
                        "blue",
                        "incongruent",
                        "strong"
                    ],
                    [
                        "-200",
                        "green",
                        "incongruent",
                        "strong"
                    ],
                    [
                        "-200",
                        "green",
                        "incongruent",
                        "strong"
                    ],
                    [
                        "-200",
                        "green",
                        "incongruent",
                        "strong"
                    ],
                    [
                        "-200",
                        "green",
                        "incongruent",
                        "strong"
                    ],
                    [
                        "-100",
                        "green",
                        "incongruent",
                        "weak"
                    ],
                    [
                        "-100",
                        "green",
                        "incongruent",
                        "weak"
                    ],
                    [
                        "-100",
                        "green",
                        "incongruent",
                        "weak"
                    ],
                    [
                        "-100",
                        "green",
                        "incongruent",
                        "weak"
                    ],
                    [
                        "0",
                        "green",
                        "neutral",
                        "neutral"
                    ],
                    [
                        "0",
                        "green",
                        "neutral",
                        "neutral"
                    ],
                    [
                        "0",
                        "green",
                        "neutral",
                        "neutral"
                    ],
                    [
                        "0",
                        "green",
                        "neutral",
                        "neutral"
                    ],
                    [
                        "100",
                        "green",
                        "congruent",
                        "weak"
                    ],
                    [
                        "100",
                        "green",
                        "congruent",
                        "weak"
                    ],
                    [
                        "100",
                        "green",
                        "congruent",
                        "weak"
                    ],
                    [
                        "100",
                        "green",
                        "congruent",
                        "weak"
                    ],
                    [
                        "200",
                        "green",
                        "congruent",
                        "strong"
                    ],
                    [
                        "200",
                        "green",
                        "congruent",
                        "strong"
                    ],
                    [
                        "200",
                        "green",
                        "congruent",
                        "strong"
                    ],
                    [
                        "200",
                        "green",
                        "congruent",
                        "strong"
                    ]
                ]
            },
            "responses": [
                {
                    "label": "",
                    "event": "",
                    "target": "",
                    "filter": ""
                }
            ],
            "messageHandlers": [],
            "title": "Simon task",
            "notes": "Trials consist of five bullet bullet points in a horizontal line.\nOne of the points is colored either [b]lue or [g]reen.\nThe color determines the correct response.\nThe colored point's position changes each trial. \nColor and position can either be [congruent], [incongruent] or [neutral].\nThe congruency's power can be [strong], [weak] or [neutral], depending on whether the colored point is on the edge, next to the center or in the center.",
            "parameters": [
                {
                    "name": "",
                    "value": "",
                    "type": "string"
                }
            ],
            "files": [],
            "sample": {
                "mode": "draw-shuffle",
                "n": "3"
            },
            "_tab": "Content"
        },
        "3": {
            "id": "3",
            "type": "lab.flow.Sequence",
            "children": [
                "18",
                "17",
                "20"
            ],
            "responses": [
                {
                    "label": "",
                    "event": "",
                    "target": "",
                    "filter": ""
                }
            ],
            "messageHandlers": [],
            "title": "Trial",
            "notes": "Sequence of screens to be looped, Consists of an empty screen before each trial, the trial screen and a feedback screen.",
            "parameters": [
                {
                    "name": "",
                    "value": "",
                    "type": "string"
                }
            ],
            "files": [],
            "_tab": "Parameters"
        },
        "7": {
            "id": "7",
            "type": "lab.html.Screen",
            "responses": [
                {
                    "label": "",
                    "event": "",
                    "target": "",
                    "filter": ""
                }
            ],
            "messageHandlers": [],
            "title": "Thanks",
            "notes": "Finishing the experiment and offering download of data (to be included)",
            "content": "<header>\r\n  <h1>Thank you!</h1>\r\n</header>\r\n<main class=\"content-vertical-center content-horizontal-center\">\r\n  <div class=\"m-w text-center\">\r\n    <p><strong>The experiment is now complete.</strong></p>\r\n    <p>Thank you for taking the time!</p>\r\n  </div>\r\n</main>\r\n<footer>\r\n  <p>You can now close this window.</p>\r\n</footer>",
            "parameters": [
                {
                    "name": "",
                    "value": "",
                    "type": "string"
                }
            ],
            "files": []
        },
        "17": {
            "id": "17",
            "type": "lab.canvas.Screen",
            "content": [
                {
                    "type": "circle",
                    "version": "2.7.0",
                    "originX": "center",
                    "originY": "center",
                    "left": "${ this.parameters.position }",
                    "top": 0,
                    "width": "50",
                    "height": 55,
                    "fill": "${ this.parameters.color }",
                    "stroke": null,
                    "strokeWidth": 1,
                    "strokeDashArray": null,
                    "strokeLineCap": "butt",
                    "strokeDashOffset": 0,
                    "strokeLineJoin": "round",
                    "strokeMiterLimit": 4,
                    "scaleX": 1,
                    "scaleY": 1,
                    "angle": 0,
                    "flipX": false,
                    "flipY": false,
                    "opacity": 1,
                    "shadow": null,
                    "visible": true,
                    "clipTo": null,
                    "backgroundColor": "",
                    "fillRule": "nonzero",
                    "paintFirst": "fill",
                    "globalCompositeOperation": "source-over",
                    "transformMatrix": null,
                    "skewX": 0,
                    "skewY": 0,
                    "radius": 27.5,
                    "startAngle": 0,
                    "endAngle": 6.283185307179586,
                    "id": "749"
                }
            ],
            "files": [],
            "parameters": [
                {
                    "name": "",
                    "value": "",
                    "type": "string"
                }
            ],
            "responses": [
                {
                    "label": "blue",
                    "event": "keydown",
                    "target": "",
                    "filter": "s"
                },
                {
                    "label": "green",
                    "event": "keydown",
                    "target": "",
                    "filter": "l"
                }
            ],
            "messageHandlers": [
                {
                    "title": "",
                    "message": "",
                    "code": ""
                }
            ],
            "viewport": [
                800,
                600
            ],
            "title": "Simon screen",
            "correctResponse": "${ this.parameters.color }",
            "_tab": "Behavior"
        },
        "18": {
            "id": "18",
            "type": "lab.canvas.Screen",
            "content": [
                {
                    "type": "i-text",
                    "version": "2.7.0",
                    "originX": "center",
                    "originY": "center",
                    "left": 0,
                    "top": 0,
                    "width": 18.05,
                    "height": 36.16,
                    "fill": "black",
                    "stroke": null,
                    "strokeWidth": 1,
                    "strokeDashArray": null,
                    "strokeLineCap": "butt",
                    "strokeDashOffset": 0,
                    "strokeLineJoin": "round",
                    "strokeMiterLimit": 4,
                    "scaleX": 1,
                    "scaleY": 1,
                    "angle": 0,
                    "flipX": false,
                    "flipY": false,
                    "opacity": 1,
                    "shadow": null,
                    "visible": true,
                    "clipTo": null,
                    "backgroundColor": "",
                    "fillRule": "nonzero",
                    "paintFirst": "fill",
                    "globalCompositeOperation": "source-over",
                    "transformMatrix": null,
                    "skewX": 0,
                    "skewY": 0,
                    "text": "+",
                    "fontSize": "48",
                    "fontWeight": "normal",
                    "fontFamily": "sans-serif",
                    "fontStyle": "normal",
                    "lineHeight": 1.16,
                    "underline": false,
                    "overline": false,
                    "linethrough": false,
                    "textAlign": "center",
                    "textBackgroundColor": "",
                    "charSpacing": 0,
                    "id": "753",
                    "styles": {}
                }
            ],
            "files": [],
            "parameters": [
                {
                    "name": "",
                    "value": "",
                    "type": "string"
                }
            ],
            "responses": [
                {
                    "label": "",
                    "event": "",
                    "target": "",
                    "filter": ""
                }
            ],
            "messageHandlers": [
                {
                    "title": "",
                    "message": "",
                    "code": ""
                }
            ],
            "viewport": [
                800,
                600
            ],
            "title": "Fixation cross",
            "timeout": "250"
        },
        "19": {
            "id": "19",
            "type": "lab.canvas.Frame",
            "context": "<!-- Nested components use this canvas -->\n<main>\n  <canvas />\n</main>\n<footer>\n  Please press <kbd>S</kbd> for blue and <kbd>L</kbd> for green.\n</footer>",
            "contextSelector": "canvas",
            "files": [],
            "parameters": [
                {
                    "name": "",
                    "value": "",
                    "type": "string"
                }
            ],
            "responses": [
                {
                    "label": "",
                    "event": "",
                    "target": "",
                    "filter": ""
                }
            ],
            "messageHandlers": [
                {
                    "title": "",
                    "message": "",
                    "code": ""
                }
            ],
            "title": "Frame",
            "children": [
                "2"
            ],
            "_tab": "Scripts"
        },
        "20": {
            "id": "20",
            "type": "lab.canvas.Screen",
            "content": [
                {
                    "type": "i-text",
                    "version": "2.7.0",
                    "originX": "center",
                    "originY": "center",
                    "left": 0,
                    "top": 0,
                    "width": 342.44,
                    "height": 22.6,
                    "fill": "black",
                    "stroke": null,
                    "strokeWidth": 1,
                    "strokeDashArray": null,
                    "strokeLineCap": "butt",
                    "strokeDashOffset": 0,
                    "strokeLineJoin": "round",
                    "strokeMiterLimit": 4,
                    "scaleX": 1,
                    "scaleY": 1,
                    "angle": 0,
                    "flipX": false,
                    "flipY": false,
                    "opacity": 1,
                    "shadow": null,
                    "visible": true,
                    "clipTo": null,
                    "backgroundColor": "",
                    "fillRule": "nonzero",
                    "paintFirst": "fill",
                    "globalCompositeOperation": "source-over",
                    "transformMatrix": null,
                    "skewX": 0,
                    "skewY": 0,
                    "text": "${ this.state.correct ? \"\" : \"Ooops!\"}",
                    "fontSize": "20",
                    "fontWeight": "bold",
                    "fontFamily": "sans-serif",
                    "fontStyle": "normal",
                    "lineHeight": 1.16,
                    "underline": false,
                    "overline": false,
                    "linethrough": false,
                    "textAlign": "center",
                    "textBackgroundColor": "",
                    "charSpacing": 0,
                    "id": "853",
                    "styles": {}
                },
                {
                    "type": "i-text",
                    "version": "2.7.0",
                    "originX": "center",
                    "originY": "center",
                    "left": 0,
                    "top": 40,
                    "width": 564.92,
                    "height": 18.08,
                    "fill": "black",
                    "stroke": null,
                    "strokeWidth": 1,
                    "strokeDashArray": null,
                    "strokeLineCap": "butt",
                    "strokeDashOffset": 0,
                    "strokeLineJoin": "round",
                    "strokeMiterLimit": 4,
                    "scaleX": 1,
                    "scaleY": 1,
                    "angle": 0,
                    "flipX": false,
                    "flipY": false,
                    "opacity": 1,
                    "shadow": null,
                    "visible": true,
                    "clipTo": null,
                    "backgroundColor": "",
                    "fillRule": "nonzero",
                    "paintFirst": "fill",
                    "globalCompositeOperation": "source-over",
                    "transformMatrix": null,
                    "skewX": 0,
                    "skewY": 0,
                    "text": "${ this.state.correct ? \"\" : \"Make sure you indicate the color of the dot correctly.\"}",
                    "fontSize": "16",
                    "fontWeight": "normal",
                    "fontFamily": "sans-serif",
                    "fontStyle": "normal",
                    "lineHeight": 1.16,
                    "underline": false,
                    "overline": false,
                    "linethrough": false,
                    "textAlign": "center",
                    "textBackgroundColor": "",
                    "charSpacing": 0,
                    "id": "855",
                    "styles": {}
                },
                {
                    "type": "i-text",
                    "version": "2.7.0",
                    "originX": "center",
                    "originY": "center",
                    "left": 0,
                    "top": 65,
                    "width": 558.12,
                    "height": 18.08,
                    "fill": "black",
                    "stroke": null,
                    "strokeWidth": 1,
                    "strokeDashArray": null,
                    "strokeLineCap": "butt",
                    "strokeDashOffset": 0,
                    "strokeLineJoin": "round",
                    "strokeMiterLimit": 4,
                    "scaleX": 1,
                    "scaleY": 1,
                    "angle": 0,
                    "flipX": false,
                    "flipY": false,
                    "opacity": 1,
                    "shadow": null,
                    "visible": true,
                    "clipTo": null,
                    "backgroundColor": "",
                    "fillRule": "nonzero",
                    "paintFirst": "fill",
                    "globalCompositeOperation": "source-over",
                    "transformMatrix": null,
                    "skewX": 0,
                    "skewY": 0,
                    "text": "${ this.state.correct ? \"\" : \"Please review the instructions below if you need to.\"}",
                    "fontSize": "16",
                    "fontWeight": "normal",
                    "fontFamily": "sans-serif",
                    "fontStyle": "normal",
                    "lineHeight": 1.16,
                    "underline": false,
                    "overline": false,
                    "linethrough": false,
                    "textAlign": "center",
                    "textBackgroundColor": "",
                    "charSpacing": 0,
                    "id": "884",
                    "styles": {}
                }
            ],
            "files": [],
            "parameters": [
                {
                    "name": "",
                    "value": "",
                    "type": "string"
                }
            ],
            "responses": [
                {
                    "label": "",
                    "event": "",
                    "target": "",
                    "filter": ""
                }
            ],
            "messageHandlers": [
                {
                    "title": "",
                    "message": "",
                    "code": ""
                }
            ],
            "viewport": [
                800,
                600
            ],
            "title": "Feedback",
            "tardy": true,
            "timeout": "${ this.state.correct ? 500 : 2000}"
        },
        "root": {
            "id": "root",
            "title": "root",
            "type": "lab.flow.Sequence",
            "children": [
                "1",
                "19",
                "7"
            ],
            "plugins": [
                {
                    "type": "lab.plugins.Metadata"
                }
            ],
            "metadata": {
                "title": "Simon task",
                "description": "",
                "repository": "",
                "contributors": "Michael Kriechbaumer\nFelix Henninger"
            },
            "parameters": [
                {
                    "name": "",
                    "value": "",
                    "type": "string"
                }
            ],
            "files": [],
            "messageHandlers": []
        }
    },
    "version": [
        20,
        2,
        4
    ],
    "files": {
        "files": {
            "index.html": {
                "content": "data:text/html,%3C!doctype%20html%3E%0A%3Chtml%3E%0A%3Chead%3E%0A%20%20%3Cmeta%20charset%3D%22utf-8%22%3E%0A%20%20%3Ctitle%3EExperiment%3C%2Ftitle%3E%0A%20%20%3C!--%20lab.js%20library%20and%20experiment%20code%20--%3E%0A%20%20%24%7B%20header%20%7D%0A%3C%2Fhead%3E%0A%3Cbody%3E%0A%20%20%3C!--%20If%20you're%20looking%20to%20fill%20all%20available%20browser%20space%2C%0A%20%20%20%20%20%20%20try%20replacing%20the%20class%20below%20with%20%22container%20fullscreen%22%20--%3E%0A%20%20%3Cdiv%20class%3D%22container%20fullscreen%22%20data-labjs-section%3D%22main%22%3E%0A%20%20%20%20%3Cmain%20class%3D%22content-vertical-center%20content-horizontal-center%22%3E%0A%20%20%20%20%20%20%3Cdiv%3E%0A%20%20%20%20%20%20%20%20%3Ch2%3ELoading%20Experiment%3C%2Fh2%3E%0A%20%20%20%20%20%20%20%20%3Cp%3EThe%20experiment%20is%20loading%20and%20should%20start%20in%20a%20few%20seconds%3C%2Fp%3E%0A%20%20%20%20%20%20%3C%2Fdiv%3E%0A%20%20%20%20%3C%2Fmain%3E%0A%20%20%3C%2Fdiv%3E%0A%3C%2Fbody%3E%0A%3C%2Fhtml%3E%0A",
                "source": "library"
            },
            "style.css": {
                "content": "data:text/css,",
                "source": "library"
            },
            "embedded/9fa89c4e3dba7098b2ca91aed62d20c707369b93b3dd7af96a56e85b071a7634.svg": {
                "content": "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+CjxzdmcKICAgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIgogICB4bWxuczpjYz0iaHR0cDovL2NyZWF0aXZlY29tbW9ucy5vcmcvbnMjIgogICB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiCiAgIHhtbG5zOnN2Zz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciCiAgIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIKICAgd2lkdGg9IjUyMCIKICAgaGVpZ2h0PSIyMTAuMTAwMDEiCiAgIHZpZXdCb3g9IjAgMCAxMzcuNTgzMzMgNTUuNTg4OTYiCiAgIHZlcnNpb249IjEuMSIKICAgaWQ9InN2ZzgiPgogIDxkZWZzCiAgICAgaWQ9ImRlZnMyIiAvPgogIDxtZXRhZGF0YQogICAgIGlkPSJtZXRhZGF0YTUiPgogICAgPHJkZjpSREY+CiAgICAgIDxjYzpXb3JrCiAgICAgICAgIHJkZjphYm91dD0iIj4KICAgICAgICA8ZGM6Zm9ybWF0PmltYWdlL3N2Zyt4bWw8L2RjOmZvcm1hdD4KICAgICAgICA8ZGM6dHlwZQogICAgICAgICAgIHJkZjpyZXNvdXJjZT0iaHR0cDovL3B1cmwub3JnL2RjL2RjbWl0eXBlL1N0aWxsSW1hZ2UiIC8+CiAgICAgICAgPGRjOnRpdGxlPjwvZGM6dGl0bGU+CiAgICAgIDwvY2M6V29yaz4KICAgIDwvcmRmOlJERj4KICA8L21ldGFkYXRhPgogIDxnCiAgICAgaWQ9ImxheWVyNCIKICAgICB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMzcuMDQxNjY4LC01MS41ODA1MjEpIgogICAgIHN0eWxlPSJkaXNwbGF5Om5vbmUiPgogICAgPHJlY3QKICAgICAgIHN0eWxlPSJvcGFjaXR5OjE7ZmlsbDojNjY2NjY2O2ZpbGwtb3BhY2l0eToxO3N0cm9rZTpub25lO3N0cm9rZS13aWR0aDowLjQ3MjMwMjg1O3N0cm9rZS1saW5lY2FwOnJvdW5kO3N0cm9rZS1saW5lam9pbjpyb3VuZDtzdHJva2UtbWl0ZXJsaW1pdDo0O3N0cm9rZS1kYXNoYXJyYXk6bm9uZTtzdHJva2Utb3BhY2l0eToxIgogICAgICAgaWQ9InJlY3Q5MDAiCiAgICAgICB3aWR0aD0iMTM3LjU4MzMzIgogICAgICAgaGVpZ2h0PSI1NS41ODg5NTkiCiAgICAgICB4PSIzNy4wNDE2NjgiCiAgICAgICB5PSI1MS41ODA1MjEiIC8+CiAgPC9nPgogIDxjaXJjbGUKICAgICBzdHlsZT0ib3BhY2l0eTowLjY5ODAwMDAyO3ZlY3Rvci1lZmZlY3Q6bm9uZTtmaWxsOm5vbmU7ZmlsbC1vcGFjaXR5OjE7c3Ryb2tlOiM5OTk5OTk7c3Ryb2tlLXdpZHRoOjAuOTkxMzkzNzQ7c3Ryb2tlLWxpbmVjYXA6cm91bmQ7c3Ryb2tlLWxpbmVqb2luOnJvdW5kO3N0cm9rZS1taXRlcmxpbWl0OjQ7c3Ryb2tlLWRhc2hhcnJheTpub25lO3N0cm9rZS1kYXNob2Zmc2V0OjA7c3Ryb2tlLW9wYWNpdHk6MSIKICAgICBpZD0icGF0aDE0NzgiCiAgICAgY3g9IjEzLjIyOTE2NyIKICAgICBjeT0iMjcuNzk0NDc5IgogICAgIHI9IjYuMTE4OTQ4NSIgLz4KICA8Y2lyY2xlCiAgICAgcj0iNi4xMTg5NDg1IgogICAgIGN5PSIyNy43OTQ0NzkiCiAgICAgY3g9IjY4Ljc5MTY2NCIKICAgICBpZD0iY2lyY2xlMTQ4MCIKICAgICBzdHlsZT0ib3BhY2l0eTowLjY5ODAwMDAyO2ZpbGw6bm9uZTtmaWxsLW9wYWNpdHk6MTtzdHJva2U6Izk5OTk5OTtzdHJva2Utd2lkdGg6MC45OTEzOTM3NDtzdHJva2UtbGluZWNhcDpyb3VuZDtzdHJva2UtbGluZWpvaW46cm91bmQ7c3Ryb2tlLW1pdGVybGltaXQ6NDtzdHJva2UtZGFzaGFycmF5Om5vbmU7c3Ryb2tlLW9wYWNpdHk6MSIgLz4KICA8Y2lyY2xlCiAgICAgc3R5bGU9Im9wYWNpdHk6MC42OTgwMDAwMjt2ZWN0b3ItZWZmZWN0Om5vbmU7ZmlsbDpub25lO2ZpbGwtb3BhY2l0eToxO3N0cm9rZTojOTk5OTk5O3N0cm9rZS13aWR0aDowLjk5MTM5Mzc0O3N0cm9rZS1saW5lY2FwOnJvdW5kO3N0cm9rZS1saW5lam9pbjpyb3VuZDtzdHJva2UtbWl0ZXJsaW1pdDo0O3N0cm9rZS1kYXNoYXJyYXk6bm9uZTtzdHJva2UtZGFzaG9mZnNldDowO3N0cm9rZS1vcGFjaXR5OjEiCiAgICAgaWQ9ImNpcmNsZTE0ODIiCiAgICAgY3g9Ijk2LjU3MjkwNiIKICAgICBjeT0iMjcuNzk0NDc5IgogICAgIHI9IjYuMTE4OTQ4NSIgLz4KICA8Y2lyY2xlCiAgICAgcj0iNi4xMTg5NDg1IgogICAgIGN5PSIyNy43OTQ0NzkiCiAgICAgY3g9IjEyNC4zNTQxNiIKICAgICBpZD0iY2lyY2xlMTQ4NCIKICAgICBzdHlsZT0ib3BhY2l0eTowLjY5ODAwMDAyO3ZlY3Rvci1lZmZlY3Q6bm9uZTtmaWxsOm5vbmU7ZmlsbC1vcGFjaXR5OjE7c3Ryb2tlOiM5OTk5OTk7c3Ryb2tlLXdpZHRoOjAuOTkxMzkzNzQ7c3Ryb2tlLWxpbmVjYXA6cm91bmQ7c3Ryb2tlLWxpbmVqb2luOnJvdW5kO3N0cm9rZS1taXRlcmxpbWl0OjQ7c3Ryb2tlLWRhc2hhcnJheTpub25lO3N0cm9rZS1kYXNob2Zmc2V0OjA7c3Ryb2tlLW9wYWNpdHk6MSIgLz4KICA8Y2lyY2xlCiAgICAgc3R5bGU9Im9wYWNpdHk6MTt2ZWN0b3ItZWZmZWN0Om5vbmU7ZmlsbDojMDA4MDAwO2ZpbGwtb3BhY2l0eToxO3N0cm9rZTpub25lO3N0cm9rZS13aWR0aDoxLjA3MTY5NjY0O3N0cm9rZS1saW5lY2FwOnJvdW5kO3N0cm9rZS1saW5lam9pbjpyb3VuZDtzdHJva2UtbWl0ZXJsaW1pdDo0O3N0cm9rZS1kYXNoYXJyYXk6bm9uZTtzdHJva2UtZGFzaG9mZnNldDowO3N0cm9rZS1vcGFjaXR5OjEiCiAgICAgaWQ9ImNpcmNsZTE0ODYiCiAgICAgY3g9IjQxLjAxMDQxOCIKICAgICBjeT0iMjcuNzk0NDc5IgogICAgIHI9IjYuNjE0NTgzNSIgLz4KPC9zdmc+Cg==",
                "source": "embedded",
                "checkSum": "9fa89c4e3dba7098b2ca91aed62d20c707369b93b3dd7af96a56e85b071a7634"
            },
            "embedded/e031f99402d1ebdfb1276e246c3aa118869b0fd1cf9c66924d52ed1faf493567.svg": {
                "content": "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+CjxzdmcKICAgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIgogICB4bWxuczpjYz0iaHR0cDovL2NyZWF0aXZlY29tbW9ucy5vcmcvbnMjIgogICB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiCiAgIHhtbG5zOnN2Zz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciCiAgIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIKICAgaWQ9InN2ZzgiCiAgIHZlcnNpb249IjEuMSIKICAgdmlld0JveD0iMCAwIDEzNy41ODMzMyA1NS41ODg5NiIKICAgaGVpZ2h0PSIyMTAuMTAwMDEiCiAgIHdpZHRoPSI1MjAiPgogIDxkZWZzCiAgICAgaWQ9ImRlZnMyIiAvPgogIDxtZXRhZGF0YQogICAgIGlkPSJtZXRhZGF0YTUiPgogICAgPHJkZjpSREY+CiAgICAgIDxjYzpXb3JrCiAgICAgICAgIHJkZjphYm91dD0iIj4KICAgICAgICA8ZGM6Zm9ybWF0PmltYWdlL3N2Zyt4bWw8L2RjOmZvcm1hdD4KICAgICAgICA8ZGM6dHlwZQogICAgICAgICAgIHJkZjpyZXNvdXJjZT0iaHR0cDovL3B1cmwub3JnL2RjL2RjbWl0eXBlL1N0aWxsSW1hZ2UiIC8+CiAgICAgICAgPGRjOnRpdGxlPjwvZGM6dGl0bGU+CiAgICAgIDwvY2M6V29yaz4KICAgIDwvcmRmOlJERj4KICA8L21ldGFkYXRhPgogIDxjaXJjbGUKICAgICByPSI2LjYxNDU4MzUiCiAgICAgY3k9IjI3Ljc5NDQ3OSIKICAgICBjeD0iOTYuNTcyOTE0IgogICAgIGlkPSJjaXJjbGUxNDg2IgogICAgIHN0eWxlPSJvcGFjaXR5OjE7dmVjdG9yLWVmZmVjdDpub25lO2ZpbGw6IzAwNDRhYTtmaWxsLW9wYWNpdHk6MTtzdHJva2U6bm9uZTtzdHJva2Utd2lkdGg6MS4wNzE2OTY2NDtzdHJva2UtbGluZWNhcDpyb3VuZDtzdHJva2UtbGluZWpvaW46cm91bmQ7c3Ryb2tlLW1pdGVybGltaXQ6NDtzdHJva2UtZGFzaGFycmF5Om5vbmU7c3Ryb2tlLWRhc2hvZmZzZXQ6MDtzdHJva2Utb3BhY2l0eToxIiAvPgo8L3N2Zz4K",
                "source": "embedded",
                "checkSum": "e031f99402d1ebdfb1276e246c3aa118869b0fd1cf9c66924d52ed1faf493567"
            }
        },
        "bundledFiles": {
            "lib/lab.css": {
                "type": "text/css"
            },
            "lib/loading.svg": {
                "type": "image/svg+xml"
            },
            "lib/lab.js": {
                "type": "application/javascript"
            },
            "lib/lab.js.map": {
                "type": "text/plain"
            },
            "lib/lab.fallback.js": {
                "type": "application/javascript"
            },
            "lib/lab.legacy.js": {
                "type": "application/javascript"
            },
            "lib/lab.legacy.js.map": {
                "type": "text/plain"
            }
        }
    }
}

$(document).ready(function () {
    initLabJS();
});

function initLabJS() {
    // Define studyc
    loadFiles(tttest);
    var componentTree = makeComponentTree(tttest.components, 'root');
    const study = lab.util.fromObject(componentTree);

    // Let's go!
    study.run();
}

// Load files if they are used
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