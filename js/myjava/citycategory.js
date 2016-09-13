function DefaultCity(CityId,AreaId,Area){
  var Chkid;
  $.ajax({
    url:'/index/selectcity',
    type:'POST',
    data: 'cid='+CityId,
    dataType: 'json',
    success: function( json ) 
    {
      $('#'+Area+' option').remove();
      for (var i = 0; i < json.length; i++) {
        if(json[i].d_id==AreaId)
          Chkid='selected';
        else
          Chkid='';
        $('#'+Area+'').append('<option value="'+json[i].d_id+'" '+Chkid+'>'+json[i].d_name+'</option>');
      };
    }
  });
}

// $('#d_city').change(function(){
function SelectCity(City,Area){

  $.ajax({
    url:'/index/selectcity',
    type:'POST',
    data: 'cid='+City.value,
    dataType: 'json',
    success: function( json ) 
    {
      $('#'+Area+' option').remove();
      for (var i = 0; i < json.length; i++) {
        $('#'+Area+'').append('<option value="'+json[i].d_id+'">'+json[i].d_name+'</option>');
      };
    }
  });
// });
}