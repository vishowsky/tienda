var base = location.protocol + '//' + location.host;
var route = document.getElementsByName('routeName')[0].getAttribute('content');

document.addEventListener('DOMContentLoaded', function (){
    var form_avatar_change = document.getElementById('form_avatar_change');
    var btn_avatar_edit = document.getElementById('btn_avatar_edit');
    var input_file_avatar = document.getElementById('input_file_avatar');
    if(btn_avatar_edit){
        btn_avatar_edit.addEventListener('click',function(e){
            e.preventDefault();
            input_file_avatar.click();
        })
    }

    if(input_file_avatar){
        input_file_avatar.addEventListener('change' , function(){
            //form_avatar_change.submit();
        })
    }
})
