	function Pag()
	{
		var value = document.getElementById('valor').value;
		var juros = document.getElementById('jur').value;
		var desconto = document.getElementById('desconto').value;
		var  val1 = value.replace('.','');
		var valor = val1.replace(',','.');
		valor = valor.replace('R$','');

		var  val2 = desconto.replace('.','');
		var discount = val2.replace(',','.');
		discount = discount.replace('R$','');

		var val2 = juros.replace('.','');
		var juro = val2.replace(',','.');
		juro = juro.replace(',','.');

		document.getElementById('valorV').value = valor;
		document.getElementById('discount').value = discount;
		document.getElementById('juros').value = juro;
	}

	function GetDays(){
		var dtPag = document.getElementById("dtPag").value;
		var dtVenc = document.getElementById("dtVenc").value;
		var total = document.getElementById("valor").value;
		var juros = document.getElementById("juros").value;
		var desconto = document.getElementById("desconto").value;
			desconto = desconto.replace('.','');
		    desconto = desconto.replace(',','.');
		    desconto = desconto.replace('R$','');

		document.getElementById('discount').value = desconto;

		var mdy = dtPag.split("/");
		var dtPagr = new Date(mdy[1] + "/" + mdy[0] + "/" + mdy[2]);
		var mmd = dtVenc.split("/");
		var dtVencr = new Date(mmd[1] + "/" + mmd[0] + "/" + mmd[2]);

		var dif = parseInt((dtPagr - dtVencr) / (24 * 3600 * 1000));

		var mult =parseFloat((juros/100)*dif);

		var multa = Math.round(mult *100)/100;
			//mult = multa.replace('.',',');

		if(desconto == "")
		{
			var dc = 0;
		} 
		else 
		{
			var dc = desconto;
		}
		var atual = parseFloat(multa) + parseFloat(total) - parseFloat(dc);
		var atualizado = Math.round(atual *100)/100;

		if(atualizado < 0)
		{
			$("#desconto").css("border-color", "#b94a48");
            $("#desconto").css("box-shadow", "inset 0 1px 1px rgba(0,0,0,0.075)");
		}
		if(atualizado > 0 && dc !== 0)
		{
			$("#desconto").css("border-color", "#468847");
            $("#desconto").css("box-shadow", "inset 0 1px 1px rgba(0,0,0,0.075)");

		}

		if(multa>0)
		{
			var mm = multa;
		}else
		{
			mm = 0;
		}

		var desc = parseFloat(total)-parseFloat(dc)+mm;
		var desct = Math.round(desc *100)/100;

		if(desct < 0)
		{
			$("#desconto").css("border-color", "#b94a48");
            $("#desconto").css("box-shadow", "inset 0 1px 1px rgba(0,0,0,0.075)");
		}
		if(desct > 0 && dc !== 0 )
		{
			$("#desconto").css("border-color", "#468847");
            $("#desconto").css("box-shadow", "inset 0 1px 1px rgba(0,0,0,0.075)");
		}

		if(dif > 0){
			document.getElementById("atraso").value=dif;
			document.getElementById("multa").value=multa;
			document.getElementById("atualizado").innerHTML=atualizado;
			document.getElementById("show").style.display="block";
			document.getElementById("atual").style.display="none";

		} 

		if( desconto !== "") 
		{
			document.getElementById("show").style.display="block";
			document.getElementById("atualizado").innerHTML=desct;
			document.getElementById("atual").style.display="none";
			document.getElementById("discount").value= desconto;
		}


		if(dif < 0 && desconto == "" )
		{
			document.getElementById("atraso").value= "";
			document.getElementById("multa").value= "";
			document.getElementById("show").style.display="none";
		}
		
		if(dtPag == "" && desconto == "")
		{
			document.getElementById("atraso").value= "";
			document.getElementById("multa").value= "";
			document.getElementById("show").style.display="none";

		}

	}
