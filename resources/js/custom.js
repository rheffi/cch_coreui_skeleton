function isVerticallyOverflown(element) {
    return  element.scrollHeight > element.clientHeight;
}

function isHorizontallyOverflown(element) {
    return  element.scrollWidth > element.clientWidth;
}

function table_setting(target_table) {
    var setting_check = document.getElementById(target_table + '_setting');
    if (!setting_check) {
        var table = document.getElementById(target_table);
        var table_setting_div = document.createElement('div');
        var list = document.createElement('ul');
        list.classList.add('list-group');
        // list.style.listStyle = 'none';
        for (var r = 1; r < table.rows[0].cells.length; r++) {
            var li = document.createElement("li");
            // var label = document.createElement('label');
            var checkbox = document.createElement('input');
            checkbox.type = "checkbox";
            checkbox.classList.add('checkbox');
            checkbox.checked = true;
            checkbox.value = r + 1;
            checkbox.id = target_table+'_'+r+'_chk';
            checkbox.addEventListener('change', function () {
                $('#' + target_table + ' th:nth-child(' + this.value + ')').toggle();
                $('#' + target_table + ' td:nth-child(' + this.value + ')').toggle();
            });
            li.appendChild(checkbox);
            li.style.cursor='pointer';
            li.classList.add('list-group-item','list-group-item-success','py-1');
            li.addEventListener('click',function(e){
                var cb = $(this).find(":checkbox")[0];
                if (e.target != cb){
                    cb.checked = !cb.checked;
                    var evt = document.createEvent("HTMLEvents");
                    evt.initEvent("change", true, true);
                    cb.dispatchEvent(evt);
                }
                $(this).toggleClass("list-group-item-success", cb.checked);
            });
            li.appendChild(document.createTextNode(' ' + table.rows[0].cells[r].textContent));
            list.appendChild(li);
        }

        table_setting_div.appendChild(list);
        table_setting_div.id = target_table + '_setting';
        table_setting_div.classList.add('card', 'bg-gradient-light','position-absolute');
        table_setting_div.style.zIndex = 1001;

        event.currentTarget.parentNode.insertBefore(table_setting_div, event.currentTarget.nextSibling);
    } else {
        $('#' + target_table + '_setting').toggle();
    }
}
function isEmpty(value){
    if(value.length === 0){
        return true;
    }else{
        return false;
    }
}

function isNumeric(value){
    var regExp = /^[0-9]+$/g;
    return regExp.test(value);
}

function currencyFormatter(amount){
    return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g,',');
}


function is_checked(elements_name) {
    var checked = false;
    var chk = document.getElementsByName(elements_name);
    for (var i = 0; i < chk.length; i++) {
        if (chk[i].checked) {
            checked = true;
        }
    }
    return checked;
}

// checkbox all check
$(document).on('click','#check_all',function(){
    if ($("#check_all").prop("checked")) {
        $("input[name='check_item[]']").prop("checked", true);
    } else {
        $("input[name='check_item[]']").prop("checked", false);
    }
});

// 초기화 클릭
$('.btn-refresh').on('click', function (e) {
    e.preventDefault();
    location.href = location.pathname;
});



//excel download
function excel_download(url){
    swal.fire({
        text : '다운로드 하시겠습니까?',
        showCancelButton : true,
        confirmButtonText : "예",
        cancelButtonText : "아니오",
    }).then((result) => {
        if (result.isConfirmed) {
            location.href = url;
        }
    });
}

//get degree
function getRotationDegrees(obj) {
    var matrix = obj.css("-webkit-transform") ||
        obj.css("-moz-transform") ||
        obj.css("-ms-transform") ||
        obj.css("-o-transform") ||
        obj.css("transform");
    if (matrix !== 'none') {
        var values = matrix.split('(')[1].split(')')[0].split(',');
        var a = values[0];
        var b = values[1];
        var angle = Math.round(Math.atan2(b, a) * (180 / Math.PI));
    } else {
        var angle = 0;
    }
    return (angle < 0) ? angle + 360 : angle;
}

//가로 스크롤
$('.scrollbox').mousewheel(function(e, delta) {
    if(isHorizontallyOverflown(this)){
        this.scrollLeft -= (delta*90);
        e.preventDefault();
    }
});

$(document).on('change keyup','.input-price',function(){
    var val = $(this).val();
    val = val.replace(/[^0-9]/g,'');   // 입력값이 숫자가 아니면 공백
    val = val.replace(/,/g,'');          // ,값 공백처리
    val = val.replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    $(this).val(val); // 정규식을 이용해서 3자리 마다 , 추가
});

$(document).ready(function(){
    // 모달 draggable
    $('.modal.draggable>.modal-dialog').draggable({
        cursor: 'move',
        handle: '.modal-header'
    });
    $('.modal.draggable>.modal-dialog>.modal-content>.modal-header').css('cursor', 'move');

    //메뉴 숨기기
    $("ul.program_list").each(function(){
        if(!$(this).has('li').length) $(this).siblings().hide();
    });
});


$(window).on('load',function(){
//상단 메뉴 네비바
    var module_name = $('li.c-show > a').text();
    var program_name = $('a.c-active').text();
    var program_href = $('a.c-active').attr('href');
    $('.breadcrumb .breadcrumb-item:nth-child(2)').text(module_name);
    $('.breadcrumb .breadcrumb-item:last-child').html('<a href="'+program_href+'">'+program_name+'</a>');
});


//숫자입력칸 스크!롤 방지
$(document).on('focus', 'input[type=number]', function (e) {
    $(this).on('wheel.disableScroll', function (e) {
        e.preventDefault()
    })
})
$(document).on('blur', 'input[type=number]', function (e) {
    $(this).off('wheel.disableScroll')
})


//데이터줄 변경 체크
$(document).on('change','#main_table input:not([type=checkbox]) ,#main_table select',function(){
    var row = $($(this).closest('tr'));
    $(this).addClass('is-valid');
    row.data('changed-row',true);
});


//수정창 데이터 변경 감지
$(document).on('change','#data_form :input:not([type=checkbox]), #data_form select',function(){
    $('#data_form').data('changed',true);
});


//수정값 남기고 화면 변경시 알림
window.onbeforeunload = function () {
    if($('#data_form').data('changed')){
        if(!confirm('수정된 데이터가 있습니다 닫으시겠습니까?')){
            return false;
        }
    }
};

//submit 전송시 이벤트 방지
$(document).on("submit", "form", function(event){
    window.onbeforeunload = null;
});



