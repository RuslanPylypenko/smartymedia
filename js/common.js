var rules = [];

$(document).ready(function () {

    addRule();

    $('#addNewRule').on('click', function (e) {
        e.preventDefault();

        addRule();

    });
    $('#getRepositories').on('click', function (e) {
        e.preventDefault();
        readRulesFields();
        search();
    });
    
    $('#clearRules').on('click', function (e) {
        e.preventDefault();
        clearRules();
    });
    
});

function readRulesFields() {

    var fields = $('.input_field');
    fields.each(function (key) {
        rules[key].field = $(this).val();
    });

    var operators= $('.input_operator');
    operators.each(function (key) {
        rules[key].operator = $(this).val();
    });

    var input_values= $('.input_value');
    input_values.each(function (key) {
        rules[key].value = $(this).val();
    });


    console.log(rules);
}

function clearRules() {
    rules.length = 0;
    $('#rules_wrapper').empty();
    addRule();
}

function search() {
    $.ajax({
        url: '/search.php',
        data: {search: rules},
        method: 'post',
        success: function (response) {
            var res = JSON.parse(response);

            if (res.items) {
                render(res.items)
            }
        }
    });
}


function addRule() {
    var id = rules.length;
    rules.push({
        id: id,
        field: null,
        operator: null,
        value: null,
    });
    addRuleForm(id);

}

function addRuleForm(id) {
    if (id === undefined) id = 0;
    var template = _.template($("#template_form").html());
    $("#rules_wrapper").append(template({id: id}));

    $('.delete-rule-btn').unbind();
    $('.delete-rule-btn').on('click', function () {
        var id = $(this).data('rule');
        $('#rule_form_id_' + id).remove();
        rules.splice(id, 1);
    });
}

function render(items) {
    var template = _.template($("#template_repo").html());


    $("#repositories").html(template({repositories: items}));

    if(items.length === 0){
        $("#repositories").html('<p class="text-danger">Нет репозиториев</p>');
    }
}