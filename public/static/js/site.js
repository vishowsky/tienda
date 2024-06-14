const base = location.protocol + '//' + location.host;
const route = document.getElementsByName('routeName')[0].getAttribute('content');
const http = new XMLHttpRequest();
const csrfToken = document.getElementsByName('csrf_token')[0].getAttribute('content');

document.addEventListener('DOMContentLoaded', function (){
    var slider = new Slider;
    var form_avatar_change = document.getElementById('form_avatar_change');
    var avatar_change_overlay = document.getElementById('avatar_change_overlay');
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
            var load_img = '<img src="'+base+'/static/images/loading.svg" />';
            avatar_change_overlay.innerHTML = load_img;
            avatar_change_overlay.style.display = 'flex';
            form_avatar_change.submit();
        })
    }
    slider.show();
    if(route == "home"){
        load_products('home');
    }

});

function load_products(section){
    var url = base+ '/js/api/load/products/'+section;
    http.open('GET',url,true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = this.responseText;
            data = JSON.parse(data);
            data.data.forEach( function(element, index){
                console.log(product.name);
            });
        }else{

        }
    }
}
