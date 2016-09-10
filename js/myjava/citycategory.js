function DefaultCity(CityId,AreaId){
  var Chkid;
  $.ajax({
    url:'/index/selectcity',
    type:'POST',
    data: 'cid='+CityId,
    dataType: 'json',
    success: function( json ) 
    {
      $('#d_area option').remove();
      for (var i = 0; i < json.length; i++) {
        if(json[i].s_id==AreaId)
          Chkid='selected';
        else
          Chkid='';
        $('#d_area').append('<option value="'+json[i].s_id+'" '+Chkid+'>'+json[i].s_name+'</option>');
      };
    }
  });
}

$('#d_city').change(function(){
  $.ajax({
    url:'/index/selectcity',
    type:'POST',
    data: 'cid='+$(this).val(),
    dataType: 'json',
    success: function( json ) 
    {
      $('#d_area option').remove();
      for (var i = 0; i < json.length; i++) {
        $('#d_area').append('<option value="'+json[i].s_id+'">'+json[i].s_name+'</option>');
      };
    }
  });
});