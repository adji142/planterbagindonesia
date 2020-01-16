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
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Product</a></div>
  </div>
<!--End-breadcrumbs-->
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title"> 
          <span class="icon">
              <i class="">
                <button type="button" class="btn btn-mini btn-info" data-toggle="modal" data-target="#modalProduct" id="add_btn">
                New Product
              </button>
              </i>
            </span>
          <h5>Product</h5>
        </div>
        <div class="widget-content nopadding">
          <table class="table table-bordered data-table">
            <thead>
              <tr>
                <th>No</th>
                <th>Image</th>
                <th>Indonesian Title</th>
                <th>Englist Title</th>
                <th>Indonesian Description</th>
                <th>English Description</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $data_banner = $this->ModelsExecuteMaster->FindData(array('active'=>1),'siteproduct',"'linenumb', 'ASC'");
                $no = 1;
                foreach ($data_banner->result() as $key) {
                  echo "
                  <tr>
                    <td>".$no."</td>
                    <td width = '100'><center><img src = '".$key->image."' width = '100'></center></td>
                    <td>".$key->id_prodtitle."</td>
                    <td>".$key->en_prodtitle."</td>
                    <td>".$key->id_proddesc."</td>
                    <td>".$key->en_proddesc."</td>
                    <td></td>
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
<div class="modal hide" id="modalProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title" id="exampleModalLabel"><div id="title_modal">New Product</div></h5>
        </div>
      <div class="modal-body">
        <form class="form-horizontal" enctype='multipart/form-data' id="post_product">
          <div class="control-group">
            <label class="control-label">ID Title :</label>
            <div class="controls">
              <input type="text" class="span3" placeholder="Indonesian Title" id="idtitle" name="idtitle" required="" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">EN Title :</label>
            <div class="controls">
              <input type="text" class="span3" placeholder="English Title" id="entitle" name="entitle" required="" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Order :</label>
            <div class="controls">
              <input type="number" class="span3" placeholder="Order" id="order" name="order" required=""  min="0"/>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Image :</label>
            <div class="controls">
              <input type="file" id="bannerimage" name="bannerimage" />
              <input type="hidden" name="width" id="width">
              <input type="hidden" name="height" id="height">
              <img src="" id="profile-img-tag" width="200" />
              <span class="help-block">Resolution 350 x 400 with white backgraund</span>
            </div>
          </div>
          <textarea id="image" name="image" style="display: none;"></textarea>
          <div class="control-group">
            <label class="control-label">ID Description :</label>
            <div class="controls">
              <textarea class="id span3" rows="6" placeholder="Enter Indonesian Description ..." id="id_desc" name="id_desc" required=""></textarea>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">EN Description :</label>
            <div class="controls">
              <textarea class="en span3" rows="6" placeholder="Enter English Description ..." id="en_desc" name="en_desc" required=""></textarea>
            </div>
          </div>
          <button class="btn btn-primary" id="btn_Save_product">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- end Modal -->

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
    $(document).ready(function () {
      $('.id').wysihtml5();
      $('.en').wysihtml5();
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
    $('#post_product').submit(function (e) {
        $('#btn_Save_product').text('Tunggu Sebentar.....');
        $('#btn_Save_product').attr('disabled',true);

        e.preventDefault();
        var me = $(this);
        var width = $('#width').val();
        var height = $('#height').val();

        if (width == 350 && height == 400) {
          $.ajax({
            type    :'post',
            url     : '<?=base_url()?>Root/Apps/addProduct',
            data    : me.serialize(),
            dataType: 'json',
            success : function (response) {
              if(response.success == true){
                $('#modalProduct').modal('toggle');
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
                $('#modalProduct').modal('toggle');
                Swal.fire({
                  type: 'error',
                  title: 'Woops...',
                  text: response.message,
                  // footer: '<a href>Why do I have this issue?</a>'
                }).then((result)=>{
                  $('#modalProduct').modal('show');
                  $('#btn_Save_product').text('Save');
                  $('#btn_Save_product').attr('disabled',false);
                });
              }
            }
          });
        }
        else{
          $('#modalProduct').modal('toggle');
            Swal.fire({
              type: 'error',
              title: 'Woops...',
              text: 'Invalid Resolution, Resolution must in 1280 x 853',
              // footer: '<a href>Why do I have this issue?</a>'
            });
        }
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