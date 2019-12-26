<?php
    require_once(APPPATH."views/Root/parts/header.php");
    require_once(APPPATH."views/Root/parts/sidebar.php");
    $active = 'dashboard';
    $data_about = $this->ModelsExecuteMaster->FindData(array('active'=>1),'siteabout',"'order','asc'");
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
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">About Setting</a></div>
  </div>
<!--End-breadcrumbs-->
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title"> 
          <span class="icon">
              <i class="">
                <?php
                  if ($data_about->num_rows() < 1) {
                    echo '
                      <button type="button" class="btn btn-mini btn-info" data-toggle="modal" data-target="#modalAbout" id="add_btn">
                      New About
                      </button>
                    ';
                  }
                ?>
              </i>
            </span>
          <h5>About</h5>
        </div>
        <div class="widget-content nopadding">
          <table class="table table-bordered data-table">
            <thead>
              <tr>
                <th>No</th>
                <th>About Image</th>
                <th>Headline</th>
                <th>Indonesian Description</th>
                <th>English Description</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 1;
                foreach ($data_about->result() as $key) {
                  echo "
                  <tr>
                    <td>".$no."</td>
                    <td> <img src='".$key->imageabout."' alt = '".$key->headline."' width='100'></td>
                    <td>".$key->headline."</td>
                    <td>".$key->id_desc."</td>
                    <td>".$key->en_desc."</td>
                    <td><button class = 'btn btn-mini btn-warning edit' data-toggle='modal' id = '".$key->id."' >Edit</button></td>
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
<div class="modal hide" id="modalAbout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title" id="exampleModalLabel"><div id="title_modal">New About</div></h5>
        </div>
      <div class="modal-body">
        <form class="form-horizontal" enctype='multipart/form-data' id="post_about">
          <div class="control-group">
            <label class="control-label">Headline :</label>
            <div class="controls">
              <input type="text" class="span3" placeholder="Headline" id="hl" name="hl" required="" />
              <input type="hidden" name="aboutid" id="aboutid">
              <input type="hidden" name="formmode" id="formmode" value="add">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Image :</label>
            <div class="controls">
              <input type="file" id="bannerimage" name="bannerimage" />
              <input type="hidden" id="width" name="width" />
              <input type="hidden" id="height" name="height" />
              <img src="" id="profile-img-tag" width="200" />
              <span class="help-block">Resolution 1680 x 900 with white backgraund</span>
            </div>
          </div>
          <textarea id="image" name="image" style="display: none;"></textarea>
          <div class="control-group">
            <label class="control-label">Indonesian Description :</label>
            <div class="controls">
              <textarea class="id span3" rows="6" placeholder="Enter text ..." id="id_desc" name="id_desc" required=""></textarea>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">English Description :</label>
            <div class="controls">
              <textarea class="en span3" rows="6" placeholder="Enter text ..." id="en_desc" name="en_desc" required=""></textarea>
            </div>
          </div>
          <hr>
          <center><h3>Contact Information</h3></center>
          <hr>
          <div class="control-group">
            <label class="control-label">Office Address :</label>
            <div class="controls">
              <textarea class="en span3" rows="3" placeholder="Office Address" id="officeaddr" name="officeaddr" required=""></textarea>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Phone :</label>
            <div class="controls">
              <input type="text" class="span3" placeholder="Phone" id="phone" name="phone" required="" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Secondary Phone :</label>
            <div class="controls">
              <input type="text" class="span3" placeholder="Secondary Phone" id="secphone" name="secphone"/>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Fax :</label>
            <div class="controls">
              <input type="text" class="span3" placeholder="FAX" id="fax" name="fax" required="" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Email :</label>
            <div class="controls">
              <input type="email" class="span3" placeholder="Email" id="email" name="email" required="" />
            </div>
          </div>
          <button class="btn btn-primary" id="btn_Save_about">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- end Modal -->

<?php
    require_once(APPPATH."views/Root/parts/footer.php");
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
    $('#post_about').submit(function (e) {
        $('#btn_Save_about').text('Tunggu Sebentar.....');
        $('#btn_Save_about').attr('disabled',true);

        e.preventDefault();
        var me = $(this);
        var width = $('#width').val();
        var height = $('#height').val();

        if (width == 1680 && height == 900) {
          $.ajax({
            type    :'post',
            url     : '<?=base_url()?>root/Apps/addAbout',
            data    : me.serialize(),
            dataType: 'json',
            success : function (response) {
              if(response.success == true){
                $('#modalAbout').modal('toggle');
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
                $('#modalAbout').modal('toggle');
                Swal.fire({
                  type: 'error',
                  title: 'Woops...',
                  text: response.message,
                  // footer: '<a href>Why do I have this issue?</a>'
                }).then((result)=>{
                  $('#modalAbout').modal('show');
                  $('#btn_Save_about').text('Save');
                  $('#btn_Save_about').attr('disabled',false);
                });
              }
            }
          });
        }
        else{
          $('#modalAbout').modal('toggle');
            Swal.fire({
              type: 'error',
              title: 'Woops...',
              text: 'Invalid Resolution, Resolution must in 1280 x 853',
              // footer: '<a href>Why do I have this issue?</a>'
            }).then((result)=>{
              $('#modalAbout').modal('show');
            });
        }
    });
    $('.edit').click(function () {
      var id = $(this).attr("id");
      $.ajax({
        type    :'post',
        url     : '<?=base_url()?>root/Apps/showAbout',
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