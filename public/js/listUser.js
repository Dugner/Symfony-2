$(function(){
    $.ajax({
        url: 'localhost/users.json',
        dataType: 'jsonp',
        success: function (data) {
            console.log(data);        
        }
    });
      // 1 - List all the category as a list of links
      // 2 - When client on a category, show a radom joke on THIS caterogy
});