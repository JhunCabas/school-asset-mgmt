<html>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" charset="utf-8">
$(function(){
  
  $.getJSON("select.php",{id: $("select#ctlJob").val(), ajax: 'true'}, function(j){
      var options = '';
      for (var i = 0; i < j.length; i++) {
        options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
      }
      $("select#ctlPerson").html(options);
    })
	
  $("select#ctlJob").change(function(){
    $.getJSON("select.php",{id: $(this).val(), ajax: 'true'}, function(j){
      var options = '';
      for (var i = 0; i < j.length; i++) {
        options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
      }
      $("select#ctlPerson").html(options);
    })
  })
})
</script>

<form action="">
  <label for="ctlJob">Job Function:</label>
  <select name="id" id="ctlJob">
    <option value="" selected>Please Select</option>
    <option value="1">Managers</option>
    <option value="2">Team Leaders</option>
    <option value="3">Developers</option>
  </select>
  <label for="ctlPerson">Individual:</label>
  <select name="person_id" id="ctlPerson">
     <option value=""></option>
  </select>
</form>
</html>