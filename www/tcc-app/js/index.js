$(document).ready(function(){
    
    $("#entra").show().delay(3000).queue(function(n) {
        $(this).fadeOut("slow"); n();
    });

    var slider = tns({
        container: '.my-slider',
        items: 1,
        center: true,
        slideBy: 'page',
        autoplay: false,
        loop: false,
        nav: false
      });

      $("button[data-controls='prev']").css({'position':'absolute','left':'0','z-index':'15','top':'50%'});
      $("button[data-controls='prev']").html('<i class="fas fa-chevron-left"></i>');
      $("button[data-controls='next']").css({'position':'absolute','right':'0','z-index':'15','top':'50%'});
      $("button[data-controls='next']").html('<i class="fas fa-chevron-right"></i>');
    //   $("button[data-controls='next']").unbind("click");

    var bootstrapButton = $.fn.button.noConflict(); // return $.fn.button to previously assigned value
    $.fn.bootstrapBtn = bootstrapButton;
    
    var opcFormList = ['subject_name','select1','campo-kwh', 'select2', 'select3', 'select4', 'metros-q'],
        optionsElements = {};
    
    var doc = document;
    slider.getInfo().nextButton.disabled = true;
    
    opcFormList.forEach(function(item) {
          var el = doc.getElementById(item);
    
          if (el && el.nodeName) {
            optionsElements[item] = el;
          }
    });
    
    opcFormList.forEach(function(item) {
        $(optionsElements[item]).on("change input focus",function(){
            console.log(item + ":" + $(optionsElements[item]).val());
            if ($(optionsElements[item]).val() == "" || $(optionsElements[item]).val() == undefined) {
                slider.getInfo().nextButton.disabled = true;
            }else{
                slider.getInfo().nextButton.disabled = false;
            }
        })    
    });

    $("#campo-busca").change(function(){
        if ($(this).val() == "") {
            $("#subject_name").val("").trigger('change');
        }
    });

    slider.events.on('transitionEnd', function (info, eventName) {          
            $(optionsElements[opcFormList[info.index]]).focus().trigger('focus');
    });

    $("#select1").change(function(){
        if (this.value == 1) {
            $("#saida1").html('Potência Instalada');
        } else {
            $("#saida1").html('Consumo Mensal');
        }
        
    });
   
});

$('#campo-busca').autocomplete({
    minLength: 10,
    autoFocus: true,
    delay: 500,
    position: {
        my: 'left top',
        at: 'left bottom'
    },
    appendTo: '#form',
    source: function(request, response){
        $.ajax({
            url: 'http://api.positionstack.com/v1/forward',
            type: 'get',
            dataType: 'json',
            data: {
                'access_key': '5ee2a99a880c7ee935eccc63c1b80618', 
                'query' : request.term
            }
        }).done(function(data){
            if(data['data'].length > 0){
                
                data = data['data'];
                response( $.each(data, function(key, item){
                    return({
                        label: item['street'] + ' ' + item['number'] + ' ' + item['region_code'],
                        value: key
                    });
                }));
            }
        });
    },
    select: function(event, ui) {
        if (ui.item.label == "Subject not found") {
    
          $("#subject_name").val('').trigger('change');
          $("#subject_code").val('').trigger('change');
          event.preventDefault();
          return false;
        }
        $("#subject_name").val(ui.item.label).trigger('change');
        $("#subject_code").val(ui.item.latitude + ', ' + ui.item.longitude).trigger('change');
        $('#campo-busca').val(ui.item.label).trigger('change');
        return false;
      }
});

// (function ($) {
//     $.each(['show', 'hide'], function (i, ev) {
//       var el = $.fn[ev];
//       $.fn[ev] = function () {
//         this.trigger(ev);
//         return el.apply(this, arguments);
//       };
//     });
//   })(jQuery);

// $('#ui-id-1').on('show', function() {
//     console.log('top:' + $("#ui-id-1").position().top + ' left:' + $("#ui-id-1").position().left);
//     const leftOffset = 300;
//     const topOffset = 30;
//     let $div = $("#ui-id-1");
//     let baseOffset = $div.offsetParent().offset();
//     $div.offset({
//     left: baseOffset.left - leftOffset,
//     top: baseOffset.top - topOffset
//     });
// });
function add(variavel) {
    var arrayOfStrings = variavel[2]['value'].split(',');
    variavel[2] = { name : 'lat', value : arrayOfStrings[0].trim()};
    variavel.push({ name : 'lon', value : arrayOfStrings[1].trim()});
    saida = [];
    variavel.forEach(function(item) {
        var nom = item['name'];
        saida.push({ [nom] : item['value']});
    });
    return saida;
}

$('#make-projet').click(function (event) {
    var resultado = add($('form').serializeArray());
    $.redirect("./chart/index.php", resultado, "POST");
});

