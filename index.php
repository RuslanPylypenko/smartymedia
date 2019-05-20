<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
    <h1>Searching for repositories</h1>
    <p>You can search for repositories on GitHub and narrow the results using these repository search qualifiers in any
        combination.</p>
</div>

<div class="container">
    <div class="col-sm-6 col-sm-offset-3">
        <div class="row">

            <div id="rules_wrapper">

            </div>

            <hr>
            <a href="#" id="getRepositories" class="btn btn-info">Apply</a>
            <a href="#" id="clearRules" class="btn btn-warning">Clear</a>
            <a href="#" id="addNewRule" class="btn btn-success" style="float: right;">Add Rule</a>
            <hr>
            <ul id="repositories" class="list-group">

            </ul>
        </div>
    </div>

</div>


<script type="text/template" id="template_form">
    <div class="form-inline" id="rule_form_id_<%= id %>">
        <div class="form-group">
            <select class="form-control input_field" name="field">
                <option value="size">size</option>
                <option value="forks">forks</option>
                <option value="stars">stars</option>
                <option value="followers">followers</option>
            </select>
        </div>
        <div class="form-group">
            <select class="form-control input_operator" name="operator[]">
                <option value=":>">Больше</option>
                <option value=":<">Меньше</option>
                <option value=":">Равно</option>
            </select>
        </div>
        <div class="form-group">
            <input type="number" class="form-control input_value" name="value[]" placeholder="value">
        </div>
        <div class="form-group" style="float: right;">
            <button class="btn btn-danger delete-rule-btn" data-rule="<%= id %>">Delete</button>
        </div>
    </div>
    <br>
</script>

<script type="text/template" id="template_repo">
    <% _.each(repositories, function(item) { %>
    <li class="list-group-item">
        <a href="<%= item.html_url %>"><%= item.name %></a>
        <p>size: <%= item.size %></p>
        <p>stars: <%= item.stargazers_count %></p>
        <p>forks: <%= item.forks %></p>
        <p>followers: <%= item.watchers %></p>
    </li>
    <% }); %>
</script>


<script src="js/underscore.js"></script>
<script src="js/common.js"></script>


</body>
</html>
