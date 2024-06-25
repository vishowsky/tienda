const base = location.protocol + '//' + location.host;
const route = document.getElementsByName('routeName')[0].getAttribute('content');
const http = new XMLHttpRequest();
const csrfToken = document.getElementsByName('csrf_token')[0].getAttribute('content');
const currency = document.getElementsByName('currency')[0].getAttribute('content');
const auth = document.getElementsByName('auth')[0].getAttribute('content');

var page = 1;
var page_section = "";
var products_list_ids_temp = [];

$(document).ready(function() {
    $('.slick-slider').slick({
        dots: true,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 2000,
    });
});


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

    if(route == "product_single"){
        var inventory = document.getElementsByClassName('inventory');
        for(i=0; i <inventory.length; i++){
            inventory[i].addEventListener('click', function(e){
                e.preventDefault();
                load_product_variants(this.getAttribute('data-inventory-id'));
            }
        );}
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
                products_list_ids_temp.push('product.id');
                var div = "";
                div += "<div class=\"product\">";
                    div += "<div class=\"image\">";
                        div += "<div class=\"overlay\">";
                            div += "<div class=\"btns\">";
                                div += "<a href=\""+base+"/product/"+product.id+"/"+product.slug+"\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" data-bs-title=\"Ver producto\"><i class=\"fa-regular fa-eye\"></i></a>";
                                div += "<a href=\"\" data-bs-title=\"Agregar al carro\"><i class=\"fa-solid fa-cart-shopping\"></i></a>";
                                if(auth == "1"){
                                    div += "<a href=\"#\" id=\"favorite_1_"+product.id+"\" onclick=\"add_to_favorites('"+product.id+"','1');return false;\" data-bs-title=\"Agregar a favoritos\"><i class=\"fa-regular fa-heart\"></i></a>";
                                }else{
                                    div += "<a href=\"#\" id=\"favorite_1_"+product.id+"\" onclick=\"Swal.fire({title: 'Chuta...', text: 'Debes iniciar sesion para agregar favoritos',icon: 'error' });return false;\" data-bs-title=\"Agregar a favoritos\"><i class=\"fa-regular fa-heart\"></i></a>";
                                }
                                div += "</div>"
                        div += "</div>";
                        div += "<img src=\""+base+"/uploads/"+product.file_path+"/t_"+product.image+"\">";
                    div += "</div>";
                    div += "<a href=\""+base+"/product/"+product.id+"/"+product.slug+"\" title=\""+product.name+"\">";
                        div += "<div class=\"title\">"+product.name+"</div>";
                        div += "<div class=\"price\">"+currency+" "+product.price+"</div>";
                        div += "<div class=\"options\"></div>";
                    div += "</a>"
                div += "<div>";
                products_list.innerHTML += div;
            });

            if(auth == "1"){
                mark_user_favorites(products_list_ids_temp);
                products_list_ids_temp = [];
        }
        }else{

        }
    }
}

function mark_user_favorites(object){
    var url = base + '/js/api/load/user/favorites/';
    var params = 'module=1&object='+object;
    console.log(object);
    http.open('POST',url,true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.setRequestHeader('Content-type','applicaction/x-www-form-urlencoded')
    http.send(params);
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = this.responseText;
            data = JSON.parse(data);

            if(data.count > "0")
                data.objects.forEach(function(product, index){
                    document.getElementById('favorite_1_'+favorite).classList.add('favorite_active');
                });
        }
    }
}
function add_to_favorites(object, module){
    url = base+'/js/api/favorites/add/'+object+'/'+module;
    http.open('POST',url,true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = this.responseText;
            data = JSON.parse(data);
            if(data.status == "success"){
                document.getElementById('favorite_'+module+'_'+object).classList.add('favorite_active');
            }

        }
    }

}
function load_product_variants(inventory_id){
    document.getElementById('variants_div').style.display = 'none';
    document.getElementById('variants').innerHTML = "";
    document.getElementById('field_variant').value = null;
    var inventory_list = document.getElementsByClassName('inventory');
    for(i=0; i < inventory_list.length; i++){
        inventory_list[i].classList.remove('active')
    }
    var product_id = document.getElementsByName('product_id')[0].getAttribute('content');
    var inv = inventory_id;
    document.getElementById('field_inventory').value = inv;
    document.getElementById('inventory_'+inv).classList.add('active');

    var url = base + '/js/api/load/product/inventory/'+inv+'/variants';
    http.open('POST',url,true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = this.responseText;
            data = JSON.parse(data);
            if(data.length > 0){
                document.getElementById('variants_div').style.display = 'block';
                data.forEach(function(element, index){
                    variant = '';
                    variant += "<li>";
                        variant += '<a href="#" class="variant" onclick="variants_active_remove(); document.getElementById(\'field_variant\').value = ' + element.id + '; this.classList.add(\'active\'); return false;">';
                            variant += element.name;
                        variant += "</a>";
                    variant += '</li>';
                    document.getElementById('variants').innerHTML += variant;
                });
            }        console.log(data);

        }
    }

}

function variants_active_remove(){
    var li_variants = document.getElementsByClassName('variant');
    for(i=0; i < li_variants.length; i++){
        li_variants[i].classList.remove('active')

    }
}
