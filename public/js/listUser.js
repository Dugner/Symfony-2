/*$(function(){
    $.get(
        '/users.json'
    ).done(function(data){
        let table = $('<table class="table table-striped"></table>');
        let head = $('<thead><tr><th>Id</th><th>Name</th></tr></thead>');
        let body = $('<tbody></tbody>');

        data.forEach(function(user){
            body.append($('<tr><td>'+user.id+'</td><td>'+user.name+'</td></tr>'));
        });

        table.append(head).append(body);
        $('#ninja').empty().append(table);
    }).fail(function(){
        $('#ninja').empty().html("An Error Occured");
    });



});*/

$(function(){
    $.get(
        Routing.generate('admin_user_list' /* your params */)
    ).done(function(data){
        data.forEach(function(user){
            $('#ninja').append($('<tr><td>'+user.id+'</td><td>'+user.name+'</td></tr>'));
        });
    });
});