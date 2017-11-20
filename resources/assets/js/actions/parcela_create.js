   $(document).ready(function() {
      $('input[type="radio"]').click(function() {
        if($(this).attr('id') == 'ph') {
          $('#hono').show();  
          $('#ganho').hide();          
        }
        else {
          $('#hono').hide();
          $('#ganho').show();  
        }
      });
    });

    function porcent() 
    {
      var valor_acao = document.getElementById('valor_acao').value;
      var valor = valor_acao.replace('.','');
      	  valor = valor.replace(',','.');
      var num_parcelas = document.getElementById('num_parcelas').value;
      var porcento = document.getElementById('porcento').value;
      var result = Math.round(parseFloat(valor) * (parseFloat(porcento)/100)*100)/100;
      var result2 = Math.round(result/parseInt(num_parcelas)*100)/100;

      var pp = parseFloat(result) - ((num_parcelas - 1)*result2);
      var primeira = Math.round(pp* 100) / 100;

      if (!isNaN(result)) {
        document.getElementById('val_receber').value = result;
      }

      if (!isNaN(result2) && !isNaN(primeira)) {
        document.getElementById('val_acao').value = valor;
        document.getElementById('parcela').value = primeira;
        document.getElementById('demais').value = result2;
      }
    }

    function parcela()
    {
      var total = document.getElementById('total').value;
      var total1 = total.replace('.','');
      	  total = total1.replace(',','.');
      var num = document.getElementById('num').value;
      var dt = document.getElementById('dt').value;
      var va= parseFloat(total)/parseInt(num);
      var val = Math.round(va * 100) / 100;
      var p = parseFloat(total) - ((num - 1)*val);
      var parcela1 = Math.round(p * 100) / 100;

      if(!isNaN(val) )
      {
        document.getElementById('par').value = val;
      }

      if (!isNaN(parcela1)) {
        document.getElementById('parcel1').value = parcela1;
      }

    }
