window.Vue = require('vue');
window.Sortable = require('sortablejs');

const app = new Vue({
    el: '#smartscriptcreation',
    data: {
        smartscriptid: $('#smartscript-id').val(),
        sortdata: [],
        questionFormData: {
            'external_id': '',
            'name': '',
            'slug': '',
            'type': '',
            'body': '',
            'selected_objections': [],
            'postCodeCriteriaType': '',
            'postCodesRange': [],
            'postCodes': '',
            'question': '',
            'smart_script_question_type_id': '',
            'campaign_id': '',
            'is_required': '',
            'visible_to': '',
            'question_options': [],
            'default_option': ''
        },
        objections: {},
        questionOptionsFormData: {
            'value': '',
            'external_id': '',
            'target_question': '',
            'positive': false,
            'available': true
        },
        questions: [],
        questionTypes: {},
        valueQuestions: [
            "Dropdown", "Radio", "Checkbox", 'Select'
        ],
        showValueFields: false,
    },
    mounted : function()
    {
        require('./bootstrap');
        this.init();
    },
    computed: {
        questionName() {
            return this.questionFormData.name;
        },
        smart_script_question_type_id() {
            return this.questionFormData.smart_script_question_type_id;
        },
        postCodes() {
            return this.questionFormData.postCodes;
        }
    },
    watch: {
        questionName() {
            if (this.questionFormData.name) {
                this.questionFormData.slug = this.questionFormData.name.split(' ').join('-').toLowerCase();
            }
        },
        smart_script_question_type_id()
        {
            var questionType = this.questionTypes[this.smart_script_question_type_id];
            this.showValueFields = this.valueQuestions.indexOf(questionType) > -1 ? true : false;
        },
        postCodes()
        {
            this.questionFormData.postCodesRange = this.questionFormData.postCodes.replace(/\s/g, '').split(',');
        }
    },
    methods: {
        init: function () {
            this.loadQuestions();
            this.loadQuestionTypes();
            this.loadObjections();
        },
        loadQuestions: function () {
            axios.post('/smartscripts/api/loadquestions', {
                smartscript_id: this.smartscriptid,
            }).then(function (response) {
                var questions = response.data.question;
                if (questions.length > 0) {
                    app.questions.push(questions)

                }
            }).catch(function (error) {
                console.log(error);
            });
        },
        loadObjections: function () {
            axios.post('/smartscripts/api/loadobjections', {
                smartscript_id: this.smartscriptid,
            }).then(function (response) {
                var objections = response.data.objections;
                if (objections.length > 0) {
                    _.forEach(objections, function (value, key) {
                        app.objections[value.id] = value.name;
                    });
                }
            }).catch(function (error) {
                console.log(error);
            });
        },
        loadQuestionTypes: function () {
            axios.post('/smartscripts/api/loadquestiontypes', {
                smartscript_id: this.smartscriptid,
            }).then(function (response) {
                var questionTypes = response.data.questionTypes;
                for (var i = 0; i < questionTypes.length; i++) {
                    app.questionTypes[questionTypes[i].id] = questionTypes[i].name;
                }
            }).catch(function (error) {
                console.log(error);
            });
        },
        pushQuestionOption: function () {
            var data = {
                'value': this.questionOptionsFormData.value,
                'external_id': this.questionOptionsFormData.external_id,
                'target_question': this.questionOptionsFormData.target_question,
                'positive': this.questionOptionsFormData.positive,
                'available': this.questionOptionsFormData.available,
            }
            var validator = this.questionOptionIsValid(data.value, data.external_id);
            if (validator.isValid) {
                this.questionFormData.question_options.push(data);
                this.questionOptionsFormData.value = '';
                this.questionOptionsFormData.external_id = '';
                this.questionOptionsFormData.target_question = '';
                this.questionOptionsFormData.value = '';
                this.questionOptionsFormData.positive = false;
                this.questionOptionsFormData.available = true;
            }
            else {
                _.forEach(validator.errors, function (value, key) {
                    Materialize.toast(value, 5000, 'red');
                });
            }
        },
        questionOptionIsValid: function (newValue, externalID) {
            var returnValue = true;
            var messages = [];
            var pushedOptions = this.questionFormData.question_options;
            _.forEach(pushedOptions, function (value, key) {
                if (_.toLower(value.value) == _.toLower(newValue) || _.toLower(value.external_id) == _.toLower(externalID)) {
                    returnValue = false;
                    if (_.toLower(value.value) == _.toLower(newValue)) {
                        messages.push("Value already exist. Try another value please.");
                    }
                    if (_.toLower(value.external_id) == _.toLower(externalID)) {
                        messages.push("External ID already used in this options. I recommend picking a brand new one.");
                    }
                }
            });

            return {
                'isValid': returnValue,
                'errors': messages
            };
        },
        questionOptionRemove: function (optionIndex) {
            this.questionFormData.question_options.splice(optionIndex, 1);
        }
    }
});



