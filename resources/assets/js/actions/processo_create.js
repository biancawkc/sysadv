$(document).on('change', '.pessoa', function(event) {
            var values = [];
            $('.pessoa').each(
                  function() {
                        if (values.indexOf(this.value) >= 0) {
                              //$(this).css("border-color", "rgb(185, 74, 72)", "!important");
                              $( this ).parent().addClass("has-error");
                              //$('#submit').prop("disabled",true);
                        }
                        else {
                              //$(this).css("border-color", ""); 
                              $( this ).parent().removeClass("has-error");
                              //$('#submit').prop("disabled",false);
                              values.push(this.value);

                        }
                  });
      });
$(document).on('change', '.cliente', function(event) {
       var selected = $("option:selected", this);
       //var idCliente = event.target.value;
       if(selected.attr('class')=='pj') {
            var show = $(this).attr('id');
            $('.'+show).show();
            $(".single-select").select2({placeholder: "Selecione ou Digite", allowClear: true, theme: "bootstrap"});
      
       } else {
            var show = $(this).attr('id');
            $('.'+show).hide();

       } 
      });

$(document).on('change', '.adversa', function(event) {
       var selected = $("option:selected", this);
       //var idCliente = event.target.value;
       if(selected.attr('class')=='pj') {
            var show = $(this).attr('id');
            $('.'+show).show();
            $(".single-select").select2({placeholder: "Selecione ou Digite", allowClear: true, theme: "bootstrap"});
      
       } else {
            var show = $(this).attr('id');
            $('.'+show).hide();

       } 
      });


 $('#clearDates').on('click', function(){
            document.getElementById("dtFn").value= "";
      }); 