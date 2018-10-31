<!DOCTYPE html>
<html>
<style>
    table {
        table-layout: fixed; width: 100%;
    }
    tr:hover{
        background-color: #bef7eb!important;
    }
    td:hover{
        cursor: pointer;

    }
</style>
@include('admin.head')
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  @include('admin.header')
  @include('admin.main-sidebar')
    <div class="content-wrapper">
        <section class="content">
            <div class="col-lg-6 connectedSortable">
                <div class="box box-primary">
                    <div class="box-header">
                        <i class="ion ion-clipboard"></i>
                        <h3 class="box-title">List Data</h3>
                    </div>
                    <div class="box-body">
                        <table id="example" class="table table-striped table-bordered" >
                        <colgroup>
                           <col span="1" style="width: 15%;">
                           <col span="1" style="width: 40%;">
                           <col span="1" style="width: 45%;">
                        </colgroup>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th class="dy-th">Link</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 connectedSortable">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <i class="fa fa-th"></i>
                        <h3 class="box-title">Edit Data</h3>
                        <div class="box-tools">
                            <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                      <div class="box box-warning">
            <!-- /.box-header -->
                        <div class="box-body">
                    <form role="form" action="/content/edit" method="POST">
                        <!-- text input -->
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="textID" id="text-ID">
                        <div class="form-group">
                          <label>Title</label>
                          <input type="text" name="textTitle" id="text-title" class="form-control" placeholder="Enter ...">
                        </div>
                        <!-- textarea -->
                        <div class="form-group">
                          <label>Content</label>
                          <textarea class="form-control" name="textContent" id="text-content" rows="7" placeholder="Enter ..."></textarea>
                        </div>
                        <div class="form-group">
                          <label>Keyword</label>
                          <input type="text" class="form-control" name="textKeyword" id="text-keyword" placeholder="Enter ...">
                        </div>
                        <div class="form-group">
                          <label>Category</label>
                          <input type="text" class="form-control" name="textCategory" id="text-category" placeholder="Enter ...">
                        </div>
                        <!-- input states -->
                        <div class="form-group has-error">
                            <label>Author</label>
                            <input type="text" id="text-author" class="form-control" id="inputSuccess" placeholder="Enter ..." disabled>
                            <span class="control-label help-block" for="inputSuccess"><i class="fa fa-times-circle-o"></i> Can't Be Changed</label>
                        </div>
                        <div class="form-group">
                          <label>Link</label>
                          <input type="text" name="textLink" id="text-link" class="form-control" placeholder="Enter ...">
                        </div>
                        <div style="display: inline-block; width: 49.3%" class="form-group">
                          <label>Articel Date</label>
                          <input  type="text" id="text-artdate" name="textArtdate" class="form-control" placeholder="Enter ..."> 
                        </div>
                        <div style="display: inline-block;  width: 50%" class="form-group">
                          <label>Scrap Date</label>
                          <input  type="text" id="textScrdate" name="text-scrdate" class="form-control" placeholder="Enter ..." disabled=""> 
                        </div>
                        <div class="form-group">
                          <input type="submit" name="updateTable" class="btn btn-block btn-warning btn-sm" value="UPDATE">
                        </div>
                    </form>
                        </div>
            <!-- /.box-body -->
          </div>  
                    </div>
                </div>
            </div>
        </section>
    </div>
  @include('admin.footer')
  @include('admin.control-sidebar')
    <?php 
        /*if(isset($_POST['updateTable'])){
            update_table($_POST['text-category'],$_POST['text-title'],$_POST['text-content'],$_POST['text-keyword'], $_POST['text-artdate'],$_POST['text-link'],$_POST['text-ID']);
        }*/
    ?>
</div>
<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
</script>
<script>
$(document).ready(function() {
    $('#example').DataTable({
        "aLengthMenu": [[3, 5, 7], [3, 5, 7]],
        "iDisplayLength": 3
    });    
});


$(localStorage.getItem('tabActive')).addClass('active');
$(localStorage.getItem('tabParent')).addClass('active menu-open');
var a = JSON.parse(localStorage.getItem('tableData'));
for (var i = 0; i < a.length; i++) { 
    var activeClass = localStorage.getItem('activeClass');
    if(activeClass.indexOf("kategori") != -1){
        $("tbody")
        .append('<tr class="row-content" id="'+a[i]['ID']+'"><td class="tID">'+a[i]['ID']+'</td><td class="tTitle">'+a[i]['TITLE']+'</td><td style="word-wrap: break-word" class="tLink">'+a[i]['LINK']+'</td></tr>');
    }
    else if(activeClass.indexOf("site") != -1){
        $(".dy-th").html("Categories");
        $("tbody")
        .append('<tr class="row-content" id="'+a[i]['ID']+'"><td class="tID">'+a[i]['ID']+'</td><td class="tTitle">'+a[i]['TITLE']+'</td><td style="word-wrap: break-word" class="tCategory">'+a[i]['KATEGORI']+'</td></tr>');
    }     
}
$(".row-content").on("click",function(e){
    // $.ajax({
    //     url: "gas.php",
    //     type: "POST",
    //     data: 'query2='+this.id,
    //     dataType: 'json',
    //     success: function(data) {
            // $("#text-ID").val(data['ID']);
            // $("#text-title").val(data['TITLE']);
            // $("#text-content").val(data['CONTENT']);
            // $("#text-keyword").val(data['KEYWORD']);
            // $("#text-category").val(data['KATEGORI']);
            // $("#text-author").val(data['AUTHOR']);
            // $("#text-artdate").val(data['ARTICLE_DATE']);
            // $("#text-scrdate").val(data['GET_DATE']);
            // $("#text-link").val(data['LINK']);
    //     }, 
    // });
    var a = JSON.parse(localStorage.getItem('tableData'));
    for(var i=0; i < a.length; i++){
        if(a[i]['ID'] == this.id){
            $("#text-ID").val(a[i]['ID']);
            $("#text-title").val(a[i]['TITLE']);
            $("#text-content").val(a[i]['CONTENT']);
            $("#text-keyword").val(a[i]['KEYWORD']);
            $("#text-category").val(a[i]['KATEGORI']);
            $("#text-author").val(a[i]['AUTHOR']);
            $("#text-artdate").val(a[i]['ARTICLE_DATE']);
            $("#text-scrdate").val(a[i]['GET_DATE']);
            $("#text-link").val(a[i]['LINK']);
        }
    }
    e.preventDefault();
});


</script>
</body>
</html>
