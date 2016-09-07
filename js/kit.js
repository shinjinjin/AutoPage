//product/kit_info JS
//產品選擇

//抓取分類
function sel_xl(num){
	SP=$("#SP"+num+"").val();
	$("#XL"+num+" option").remove();
	$("#M"+num+" option").remove();

	$.ajax({
	    url:'/admin_sys/product/select_val',
	    type:'POST',
	    data: 'type=XL_M&SP='+SP,
	    dataType: 'json',
	    success: function(data) 
	    {
	       $("#XL"+num+"").append("<option >請選擇</option>")

	       for (var i = data.length - 1; i >= 0; i--) {
	          $("#XL"+num+"").append("<option value='"+data[i]+"''>"+data[i]+"</option>")
	       };
	    }
	  });
}
//商品名稱
function sel_m(num){
	SP=$("#SP"+num+"").val();
	XL=$("#XL"+num+"").val();
	$("#M"+num+" option").remove();
	$.ajax({
	    url:'/admin_sys/product/select_val',
	    type:'POST',
	    data: 'type=SP_M&SP='+SP+'&XL='+XL,
	    dataType: 'json',
	    success: function(data) 
	    {
	        $("#M"+num+"").append("<option >請選擇</option>")
	       for (var i = data.length - 1; i >= 0; i--) {    
	          strarray=data[i].split('_');
	          console.log(strarray);
	          $("#M"+num+"").append("<option value='"+strarray[0]+"''>"+strarray[1]+'('+strarray[2]+')'+"</option>");
	          strarray='';
	       };
	    }
	  });
}
//算BV總數與市價
var price = new Array(); 
function total_bv(num){
	M=$("#M"+num+"").val();
	var   total_price1=0;
	$.ajax({
	    url:'/admin_sys/product/select_val',
	    type:'POST',
	    data: 'type=total&m='+M,
	    dataType: 'json',
	    success: function(data) 
	    {	
	       if($('#total_price').val()!=''){
	       		total_price1=parseInt($('#total_price').val())+parseInt(data.SPJ_DJ);
	       }else{
		       price[num]=data.SPJ_DJ;
		       for (var i = price.length - 1; i >= 0; i--) {
		       		total_price1=parseInt(price[i])+parseInt(total_price1);
		 	   };
	 	   }
	 	   $('#total_price').val(total_price1);
	    }
	});
}