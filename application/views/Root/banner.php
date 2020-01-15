<?php
    require_once(APPPATH."views/Root/parts/Header.php");
    require_once(APPPATH."views/Root/parts/Sidebar.php");
    $active = 'dashboard';
?>
<style type="text/css">
  #background{
    position:absolute;
    z-index:0;
    background:white;
    display:block;
    min-height:100%; 
    min-width:100%;
    color:yellow;
}

#bg-text
{
    color:lightgrey;
    font-size:60px;
    transform:rotate(300deg);
    -webkit-transform:rotate(300deg);
}
.preview{
   width: 100px;
   height: 100px;
   border: 1px solid black;
   margin: 0 auto;
   background: white;
}
.preview img{
   display: none;
}
</style>
<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Banner Setting</a></div>
  </div>
<!--End-breadcrumbs-->
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title"> 
          <span class="icon">
              <i class="">
                <button type="button" class="btn btn-mini btn-info" data-toggle="modal" data-target="#modalBanner" id="add_btn">
                New Banner
              </button>
              </i>
            </span>
          <h5>Banner</h5>
        </div>
        <div class="widget-content nopadding">
          <table class="table table-bordered data-table">
            <thead>
              <tr>
                <th>No</th>
                <th>Keyword</th>
                <th>Order</th>
                <th>Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $data_banner = $this->ModelsExecuteMaster->FindData(array('active'=>1),'sitebanner',"'order','asc'");
                $no = 1;
                foreach ($data_banner->result() as $key) {
                  echo "
                  <tr>
                    <td width = '10'>".$no."</td>
                    <td width = '150'>".$key->alt_tag."</td>
                    <td width = '10'>".$key->order."</td>
                    <td width = '100'><center><a href='#' class = 'viewImage' id = '".$key->id."'><img src = '".$key->image."' width = '100'></a></center></td>
                    <td width = '100'>
                      <button class = 'btn btn-mini btn-warning edit' data-toggle='modal' id = '".$key->id."' >edit</button>
                      <button class = 'btn btn-mini btn-danger delete' data-toggle='modal' id = '".$key->id."' >delete</button>
                    </td>
                  </tr>
                  ";
                $no++;
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal hide" id="modalBanner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title" id="exampleModalLabel"><div id="title_modal">New Banner</div></h5>
        </div>
      <div class="modal-body">
        <form class="form-horizontal" enctype='multipart/form-data' id="post_banner">
          <div class="control-group">
            <label class="control-label">Title :</label>
            <div class="controls">
              <input type="text" class="span3" placeholder="Title" id="title" name="title" required="" />
              <input type="hidden" name="bannerid" id="bannerid">
              <input type="hidden" name="formtype" id="formtype" value="add">
              <input type="hidden" name="datatable" id="datatable" value="add">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Order :</label>
            <div class="controls">
              <input type="number" class="span3" placeholder="Order" id="order" name="order" required=""  min="0"/>
              <input type="hidden" name="width" id="width">
              <input type="hidden" name="height" id="height">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Image :</label>
            <div class="controls">
              <input type="file" id="bannerimage" name="bannerimage" />
              <img src="" id="profile-img-tag" width="200" />
              <span class="help-block">Resolution 1280 x 853 with white backgraund</span>
            </div>
          </div>
          <textarea id="image" name="image" style="display: none;"></textarea>
          <button class="btn btn-primary" id="btn_Save_banner">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- end Modal -->
<div class="modal hide" id="modalViewImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title" id="exampleModalLabel"><div id="title_modal">New Banner</div></h5>
        </div>
      <div class="modal-body">
        <img src="" id="preview-image">
      </div>
    </div>
  </div>
</div>
<?php
    require_once(APPPATH."views/Root/parts/Footer.php");
?>

<script type="text/javascript">
  $(function () {
    var form_mode = '';
    var _URL = window.URL || window.webkitURL;
    $.ajaxSetup({
      beforeSend:function(jqXHR, Obj){
          var value = "; " + document.cookie;
          var parts = value.split("; csrf_cookie_token=");
          if(parts.length == 2)   
          Obj.data += '&csrf_token='+parts.pop().split(";").shift();
      }
    });
    $("#bannerimage").change(function(){
      var file = $(this)[0].files[0];
      img = new Image();
      img.src = _URL.createObjectURL(file);
      var imgwidth = 0;
      var imgheight = 0;
      img.onload = function () {
        imgwidth = this.width;
        imgheight = this.height;
        $('#width').val(imgwidth);
        $('#height').val(imgheight);
      }
      readURL(this);
      encodeImagetoBase64(this);
      // alert("Current width=" + imgwidth + ", " + "Original height=" + imgheight);
    });
    $('#post_banner').submit(function (e) {
        $('#btn_Save_banner').text('Tunggu Sebentar.....');
        $('#btn_Save_banner').attr('disabled',true);

        e.preventDefault();
        var me = $(this);
        var width = $('#width').val();
        var height = $('#height').val();

        if (width == 1280 && height == 853) {
          $.ajax({
            type    :'post',
            url     : '<?=base_url()?>root/Apps/addBanner',
            data    : me.serialize(),
            dataType: 'json',
            success : function (response) {
              if(response.success == true){
                $('#modalBanner').modal('toggle');
                Swal.fire({
                  type: 'success',
                  title: 'Horay..',
                  text: 'Data Berhasil disimpan!',
                  // footer: '<a href>Why do I have this issue?</a>'
                }).then((result)=>{
                  location.reload();
                });
              }
              else{
                $('#modalBanner').modal('toggle');
                Swal.fire({
                  type: 'error',
                  title: 'Woops...',
                  text: response.message,
                  // footer: '<a href>Why do I have this issue?</a>'
                }).then((result)=>{
                  $('#modalBanner').modal('show');
                  $('#btn_Save_banner').text('Save');
                  $('#btn_Save_banner').attr('disabled',false);
                });
              }
            }
          });
        }
        else{
          $('#modalBanner').modal('toggle');
            Swal.fire({
              type: 'error',
              title: 'Woops...',
              text: 'Invalid Resolution, Resolution must in 1280 x 853',
              // footer: '<a href>Why do I have this issue?</a>'
            });
        }
    });
    $('.viewImage').click(function () {
      var id = $(this).attr("id");
      var table = 'sitebanner';
      $.ajax({
        type    :'post',
        url     : '<?=base_url()?>root/Apps/viewData',
        data    : {id:id,table:table},
        dataType: 'json',
        success : function (response) {
          if(response.success == true){
            $.each(response.data,function (k,v) {
              $('#preview-image').attr('src', v.image);
            });
            $('#modalViewImage').modal('show');
          }
        }
      });
    });
    $('.edit').click(function () {
      var id = $(this).attr("id");
      var table = 'sitebanner';
      $.ajax({
        type    :'post',
        url     : '<?=base_url()?>root/Apps/viewData',
        data    : {id:id,table:table},
        dataType: 'json',
        success : function (response) {
          if(response.success == true){
            $.each(response.data,function (k,v) {
              $('#title').val(v.alt_tag);
              $('#bannerid').val(id);
              $('#formtype').val('edit');
              $('#datatable').val('sitebanner');
              $('#order').val(v.order);
              $('#profile-img-tag').attr('src', v.image);
              $('#image').val(v.image);

              img = new Image();
              img.src = v.image;
              var imgwidth = 0;
              var imgheight = 0;
              img.onload = function () {
                imgwidth = this.width;
                imgheight = this.height;
                $('#width').val(imgwidth);
                $('#height').val(imgheight);
              }

            });
            $('#modalBanner').modal('show');
          }
        }
      });
    });
    $('.delete').click(function () {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {

          var id = $(this).attr("id");
          var table = 'sitebanner';
          $.ajax({
            type    :'post',
            url     : '<?=base_url()?>root/Apps/deleteRecord',
            data    : {id:id,table:table},
            dataType: 'json',
            success : function (response) {
              if(response.success == true){
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                ).then((result)=>{
                  location.reload();
                });
              }
              else{
                Swal.fire({
                  type: 'error',
                  title: 'Woops...',
                  text: response.message,
                  // footer: '<a href>Why do I have this issue?</a>'
                });
              }
            }
          });
        }
      })
    });
  });
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
        
      reader.onload = function (e) {
          $('#profile-img-tag').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  function encodeImagetoBase64(element) {
    $('#image').val('');
      var file = element.files[0];
      var reader = new FileReader();
      reader.onloadend = function() {
        // $(".link").attr("href",reader.result);
        // $(".link").text(reader.result);
        $('#image').val(reader.result);
      }
      reader.readAsDataURL(file);
  }
</script>