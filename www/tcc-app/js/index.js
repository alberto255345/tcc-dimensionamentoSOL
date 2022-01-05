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

    var bootstrapButton = $.fn.button.noConflict(); // return $.fn.button to previously assigned value
    $.fn.bootstrapBtn = bootstrapButton;

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
    
          $("#subject_name").val('');
          $("#subject_code").val('');
          event.preventDefault();
          return false;
        }
        console.log( "Selected: " + ui.item.label + " aka " + ui.item.value);
        $("#subject_name").val(ui.item.street);
        $("#subject_code").val(ui.item.latitude + ', ' + ui.item.longitude);
        $('#campo-busca').val(ui.item.label);
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


