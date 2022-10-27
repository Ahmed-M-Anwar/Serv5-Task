<!DOCTYPE html>
<html>
    <head>
        <title>payment history</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h3 style="margin: 40px 0; text-align:center;">Payment History</h3>

            <label for="exampleDataList" class="form-label">search in paymet history</label>
            <input class="form-control" list="datalistOptions" id="search" placeholder="Type to search...">


            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">amount</th>
                    <th scope="col">currency</th>
                    <th scope="col">created at</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function(){

             fetch_customer_data();

             function fetch_customer_data(query = '')
             {
              $.ajax({
               url:"{{ route('history.action') }}",
               method:'GET',
               data:{query:query},
               dataType:'json',
               success:function(data)
               {
                $('tbody').html(data.table_data);
               }
              })
             }

             $(document).on('keyup', '#search', function(){
              var query = $(this).val();
              fetch_customer_data(query);
             });
            });
            </script>
    </body>
</html>
