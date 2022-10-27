<html>
 <head>
  <title>Autocomplete text </title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container box">
   <h2 style="text-align:center; margin:50px 0;">Autocomplete text </h2><br />


   <form class="row" id='myForm' method="" action="">
    @csrf
    <div class="col-9">
     <div class="panel panel-default">
        <input style='font-size:18px;' type="text" name="data_text" id="data_text" class="form-control" placeholder="Enter Your Text" />
        <div id='list'></div>
     </div>
    </div>
    <div class="col-3">
    <button type="submit" id='submit' class="btn btn-primary mb-3" style='font-size:18px; '>submit</button>
    </div>
</form>
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
    fetch_data();
 function fetch_data(query = '')
 {
  $.ajax({
   url:"{{ route('autocomplete.fetch') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    $('#list').fadeIn();
    $('#list').html(data.table_data);

   }
  })
 }

 $(document).on('keyup', '#data_text', function(){
  var query = $(this).val();
  if(query != ''){
    fetch_data(query);
  }else{
    $('#list').html('');
  }
 });

 $(document).on('click', 'li', function(){
    $('#data_text').val($(this).text());
    $('#list').fadeOut();
 });

//////////////////submit/////////////////////////
 $('#submit').click(function(event){
    event.preventDefault();
    $('#data_text').val('');
    $.ajax({
    url:"{{ route('autocomplete.store') }}",
    method:'post',
    data:{
          '_token':"{{csrf_token()}}",
          'autocomplete_text':$("input[name='data_text']").val(),
          },
    dataType:'json',
    success:function(data)
   {             }
  })

 });

});
</script>
