<?php
    require_once(APPPATH."views/Root/parts/Header.php");
    require_once(APPPATH."views/Root/parts/Sidebar.php");
    $active = 'dashboard';
    $data_order = $this->ModelsExecuteMaster->FindData(array('active'=>1),'thowtoorder',"'id','asc'")->row();
    $idx = "";
    if ($data_order) {
      $idx = $data_order->id;
    }
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
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">How to Order</a></div>
  </div>
<!--End-breadcrumbs-->
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title"> 
          <h5>How to Order</h5>
        </div>
        <form class="form-horizontal" enctype='multipart/form-data' id="post_about">
          <div class="control-group">
            <label class="control-label">How to Order :</label>
            <div class="controls">
              <textarea class="id span6" rows="6" placeholder="Enter text ..." id="id_desc" name="id_desc" required=""></textarea>
              <input type="hidden" name="id" id="id" value="<?php echo $idx; ?>">
              <input type="hidden" name="formtype" id="formtype" value="add">
            </div>
          </div>
          <hr>
          <center><h3>Market Place</h3></center>
          <hr>
          <div class="control-group">
            <label class="control-label">Tokopedia :</label>
            <div class="controls">
              <input type="text" class="span3" placeholder="Tokopedia" id="toped" name="toped" required="" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Bukalapak :</label>
            <div class="controls">
              <input type="text" class="span3" placeholder="Bukalapak" id="bl" name="bl" required="" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Shopee :</label>
            <div class="controls">
              <input type="text" class="span3" placeholder="Shopee" id="shopee" name="shopee" required="" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Instagram :</label>
            <div class="controls">
              <input type="text" class="span3" placeholder="Instagram" id="ig" name="ig" required="" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Facebook :</label>
            <div class="controls">
              <input type="text" class="span3" placeholder="Facebook" id="fb" name="fb" required="" />
            </div>
          </div>
          <button class="btn btn-primary" id="btn_Save">Save</button>
        </form>
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
    $(document).ready(function () {
      $('.id').wysihtml5();
      $('.en').wysihtml5();
      var id = $('#id').val();
      if (id == "") {
        $('#id_desc').data('wysihtml5').editor.setValue("");
        $('#toped').val("");
        $('#bl').val("");
        $('#shopee').val("");
        $('#ig').val("");
        $('#fb').val("");
        $('#formtype').val("add");
        console.log("add");
      }
      else{
        $.ajax({
          type    :'post',
          url     : '<?=base_url()?>Root/Apps/getordertc',
          data    : {id:id},
          dataType: 'json',
          success : function (response) {
            if(response.success == true){
              $.each(response.data,function (k,v) {
                $('#id_desc').data('wysihtml5').editor.setValue(v.description);
                $('#toped').val(v.toped);
                $('#bl').val(v.bukalapak);
                $('#shopee').val(v.shopee);
                $('#ig').val(v.instagram);
                $('#fb').val(v.facebook);
                $('#formtype').val("edit");
                $('#id').val(v.id);
              });
            }
          }
        });
        console.log("edit");
      }
    });
    $('#post_about').submit(function (e) {
        $('#btn_Save').text('Tunggu Sebentar.....');
        $('#btn_Save').attr('disabled',true);

        e.preventDefault();
        var me = $(this);
          $.ajax({
            type    :'post',
            url     : '<?=base_url()?>Root/Apps/addordertc',
            data    : me.serialize(),
            dataType: 'json',
            success : function (response) {
              if(response.success == true){
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
                Swal.fire({
                  type: 'error',
                  title: 'Woops...',
                  text: response.message,
                  // footer: '<a href>Why do I have this issue?</a>'
                }).then((result)=>{
                  $('#btn_Save').text('Save');
                  $('#btn_Save').attr('disabled',false);
                });
              }
            }
          });
    });
    $('.edit').click(function () {
      var id = $(this).attr("id");
      $.ajax({
        type    :'post',
        url     : '<?=base_url()?>Root/Apps/showAbout',
        data    : {id:id},
        dataType: 'json',
        success : function (response) {
          if(response.success == true){
            $.each(response.data,function (k,v) {
              $('#hl').val(v.headline);
              $('#aboutid').val(v.id);
              $('#formmode').val('edit');
              $('#profile-img-tag').attr('src', v.imageabout);
              $('#image').val(v.imageabout);
              $('#id_desc').data('wysihtml5').editor.setValue(v.id_desc);
              $('#en_desc').data('wysihtml5').editor.setValue(v.id_desc);
              $('#officeaddr').val(v.address);
              $('#phone').val(v.phone);
              $('#secphone').val(v.secphone);
              $('#fax').val(v.fax);
              $('#email').val(v.email);
              $('#modalAbout').modal('show');

              img = new Image();
              img.src = v.imageabout;
              var imgwidth = 0;
              var imgheight = 0;
              img.onload = function () {
                imgwidth = this.width;
                imgheight = this.height;
                $('#width').val(imgwidth);
                $('#height').val(imgheight);
              }
            });
          }
        }
      });
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