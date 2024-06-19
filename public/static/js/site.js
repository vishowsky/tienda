const base = location.protocol + '//' + location.host;
const route = document.getElementsByName('routeName')[0].getAttribute('content');
const http = new XMLHttpRequest();
const csrfToken = document.getElementsByName('csrf_token')[0].getAttribute('content');
const currency = document.getElementsByName('currency')[0].getAttribute('content');
var page = 1;
var page_section = "";

document.addEventListener('DOMContentLoaded', function (){
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    var slider = new Slider;
    var form_avatar_change = document.getElementById('form_avatar_change');
    var avatar_change_overlay = document.getElementById('avatar_change_overlay');
    var btn_avatar_edit = document.getElementById('btn_avatar_edit');
    var input_file_avatar = document.getElementById('input_file_avatar');
    var products_list = document.getElementById('products_list');
    var load_more_products = document.getElementById('load_more_products');
    if(btn_avatar_edit){
        btn_avatar_edit.addEventListener('click',function(e){
            e.preventDefault();
            input_file_avatar.click();
        })
    }

    if(load_more_products){
        load_more_products.addEventListener('click',function(e){
            e.preventDefault();
            load_products();
        })
    }

    if(input_file_avatar){
        input_file_avatar.adxmdEventListener('change' , function(){
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
    page_section = section;
    var url = base+ '/js/api/load/products/'+page_section+'?page='+page;
    http.open('GET',url,true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            page = page + 1;
            var data = this.responseText;
            data = JSON.parse(data);
            if(data.data.length == 0){
                load_more_products.style.display = "none";

            }

            data.data.forEach( function(product, index){
                var div = "";
                div += "<div class=\"product\">";
                    div += "<div class=\"image\">";
                        div += "<div class=\"overlay\">";
                            div += "<div class=\"btns\">";
                                div += "<a href=\""+base+"/product/"+product.id+"/"+product.slug+"\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" data-bs-title=\"Ver producto\"><i class=\"fa-regular fa-eye\"></i></a>";
                                div += "<a href=\""+base+"/product/"+product.id+"/"+product.slug+"\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" data-bs-title=\"Agregar al carro\"><i class=\"fa-solid fa-cart-shopping\"></i></a>";
                                div += "<a href=\""+base+"/product/"+product.id+"/"+product.slug+"\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" data-bs-title=\"Agregar a favoritos\"><i class=\"fa-regular fa-heart\"></i></a>";
                            div += "</div>"
                        div += "</div>";
                        div += "<img src=\""+base+"/uploads/"+product.file_path+"/t_"+product.image+"\">";
                    div += "</div>";
                    div += "<a href=\""+base+"/product/"+product.id+"/"+product.slug+"\">";
                        div += "<div class=\"title\">"+product.name+"</div>";
                        div += "<div class=\"price\">"+currency+" "+product.price+"</div>";
                        div += "<div class=\"options\"></div>";
                    div += "</a>"
                div += "<div>";
                products_list.innerHTML += div;
            });
        }else{

        }

    }
}
