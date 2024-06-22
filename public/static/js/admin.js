var base = location.protocol + '//' + location.host;
var route = document.getElementsByName('routeName')[0].getAttribute('content');
const http = new XMLHttpRequest();
const csrfToken = document.getElementsByName('csrf_token')[0].getAttribute('content');
document.addEventListener('DOMContentLoaded', function (){

    var btn_search = document.getElementById('btn_search');
    var form_search = document.getElementById('form_search');
    var category = document.getElementById('category');
    if(btn_search){
        btn_search.addEventListener('click', function(e){
            e.preventDefault();
        if(form_search.style.display === 'block'){
            form_search.style.display = 'none';
        }else{
            form_search.style.display = 'block';

        }
    });
    }
    if ( route == "product_add") {
        setSubCategoriesToProducts();

    }
    if ( route == "product_edit") {
        setSubCategoriesToProducts();
        var btn_product_file_image = document.getElementById('btn_product_file_image');
        var product_file_image = document.getElementById('product_file_image');
        btn_product_file_image.addEventListener('click', function () {
            product_file_image.click();
        }, false);

        product_file_image.addEventListener('change', function () {
            document.getElementById('form_product_gallery').submit();
        });
    }
    route_active = document.getElementsByClassName('lk-'+route)[0].classList.add('active');
    // document.getElementsByClassName('lk-'+route)[0].classList.add('active');

    btn_deleted = document.getElementsByClassName('btn-deleted');
    for(i=0; i < btn_deleted.length; i++){
        btn_deleted[i].addEventListener('click', delete_object);
    }
    if(category){
        category.addEventListener('change', setSubCategoriesToProducts);
    }
});

$(document).ready(function () {
    editor_init('editor');
})

function editor_init(field) {
    CKEDITOR.replace(field, {
        toolbar: [
            { name: 'clipboard', items: ['cut', 'Copy', 'Paste', 'PasteText', '-', 'Undo', 'Redo'] },
            { name: 'basicstyles', items: ['Bold', 'Italic', 'BulletedList', 'Strike', 'Image', 'Link', 'Inlink', 'Blockquote'] },
            { name: 'document', items: ['CodeSnippet', 'EmojiPanel', 'Preview', 'Source'] }
        ]
    });
}

function delete_object(e){
    e.preventDefault();
    var object = this.getAttribute('data-object');
    var action = this.getAttribute('data-action')
    var path = this.getAttribute('data-path');
    var url = base + '/' + path + '/' + object + '/'+ action ;
    var title,text, icon;
    if(action == "delete"){
        title = 'Seguro que quieres eliminar este elemento?';
        text = 'Recuerda que esta accion enviara al producto a la papelera';
        icon = 'warning';

    }
    if(action == "restore"){
        title = 'Seguro que quieres restaurar este elemento9?';
        text = 'Recuerda que esta accion restaurara el producto y lo dejarta activo';
        icon = 'info';
    }
    swal({
        title: title,
        text: text,
        icon: icon,
        buttons: true,
        dangerMode:true,
    })
    .then((willDelete) =>{
        if(willDelete){
            window.location.href = url;
        }
    });
}

function setSubCategoriesToProducts(){
    parent_id = category.value;
    var subcategory_actual =  document.getElementById('subcategory_actual').value;
    select = document.getElementById('subcategory');
    select.innerHTML = "";
    var url = base + '/admin/js/api/load/subcategories/'+parent_id;
    http.open('GET', url,true);
    http.setRequestHeader('X-CSRF-TOKEN',csrfToken);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = this.responseText;
            data = JSON.parse(data);
            data.forEach(function(element, index) {
                if( subcategory_actual == element.id){
                    select.innerHTML += "<option value=\""+element.id+"\" selected>"+element.name+"</option>"

                }else{


                    select.innerHTML += "<option value=\""+element.id+"\">"+element.name+"</option>"
                }
            });
        }
    }

}
