<?php
    require_once(APPPATH."views/Root/parts/Header.php");
    require_once(APPPATH."views/Root/parts/Sidebar.php");
    $active = 'dashboard';
    $data_about = $this->ModelsExecuteMaster->GetData('contactfromuser',"'order','asc'");
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
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Contact List</a></div>
  </div>
<!--End-breadcrumbs-->
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title"> 
          <h5>Contact List</h5>
        </div>
        <div class="widget-content nopadding">
          <table class="table table-bordered data-table">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date Submition</th>
                <th>Message</th>
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
                    <td>".$key->name."</td>
                    <td>".$key->email."</td>
                    <td>".$key->submitdate."</td>
                    <td>".$key->content."</td>
                    <td>
                    <button class = 'btn btn-mini btn-warning show' data-toggle='modal' id = '".$key->id."' >View</button>
                    <button class = 'btn btn-mini btn-danger reply' data-toggle='modal' id = '".$key->id."' >reply</button>
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
<div class="modal hide" id="modalAbout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title" id="exampleModalLabel"><div id="title_modal">View Message</div></h5>
        </div>
      <div class="modal-body">
        <form class="form-horizontal" id="post_about">
          <div class="control-group">
            <label class="control-label">Name :</label>
            <div class="controls">
              <input type="text" class="span3" id="name" name="name" readonly="" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Email :</label>
            <div class="controls">
              <input type="text" class="span3" id="email" name="email" readonly="" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Date Submition :</label>
            <div class="controls">
              <input type="text" class="span3" id="date" name="date" readonly="" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Message :</label>
            <div class="controls">
              <textarea class="id span3" rows="6" id="message" name="message" readonly=""></textarea>
            </div>
          </div>
          <button class="btn btn-primary" id="btn_Save_about">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- end Modal -->
<div class="modal hide" id="modalreply" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title" id="exampleModalLabel"><div id="title_modal">View Message</div></h5>
        </div>
      <div class="modal-body">
        <form class="form-horizontal" id="post_reply">
          <div class="control-group">
            <label class="control-label">Email :</label>
            <div class="controls">
              <input type="text" class="span3" id="email_reciept" name="email_reciept" readonly="" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Message :</label>
            <div class="controls">
              <textarea class="id_reciept span3" rows="6" id="message_reciept" name="message_reciept" required=""></textarea>
            </div>
          </div>
          <button class="btn btn-primary" id="btn_Send_Reply">Save</button>
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
      $('.id_reciept').wysihtml5();
    });

    $('#post_about').click(function () {
        $('#modalAbout').modal('toggle');
    });
    $('.show').click(function () {
      var id = $(this).attr("id");
      $.ajax({
        type    :'post',
        url     : '<?=base_url()?>root/Apps/showmessage',
        data    : {id:id},
        dataType: 'json',
        success : function (response) {
          if(response.success == true){
            $.each(response.data,function (k,v) {
              $('#name').val(v.name);
              $('#email').val(v.email);
              $('#date').val(v.submitdate);
              $('#message').data('wysihtml5').editor.setValue(v.content);
            });
            $('#modalAbout').modal('show');
          }
        }
      });
    });
    $('.reply').click(function () {
      var id = $(this).attr("id");
      $.ajax({
        type    :'post',
        url     : '<?=base_url()?>root/Apps/showmessage',
        data    : {id:id},
        dataType: 'json',
        success : function (response) {
          if(response.success == true){
            $.each(response.data,function (k,v) {
              $('#email_reciept').val(v.email);
            });
            $('#modalreply').modal('show');
          }
        }
      });
    });
    $('#post_reply').submit(function (e) {
      $('#btn_Send_Reply').text('Tunggu Sebentar.....');
      $('#btn_Send_Reply').attr('disabled',true);

      e.preventDefault();
      var me = $(this);
        $.ajax({
          type    :'post',
          url     : '<?=base_url()?>root/Apps/SendMail',
          data    : me.serialize(),
          dataType: 'json',
          success : function (response) {
            if(response.success == true){
              $('#modalreply').modal('toggle');
              Swal.fire({
                type: 'success',
                title: 'Horay..',
                text: response.message,
                // footer: '<a href>Why do I have this issue?</a>'
              }).then((result)=>{
                location.reload();
              });
            }
            else{
              $('#modalreply').modal('toggle');
              Swal.fire({
                type: 'error',
                title: 'Woops...',
                text: response.message,
                // footer: '<a href>Why do I have this issue?</a>'
              }).then((result)=>{
                $('#btn_Send_Reply').text('Save');
                $('#btn_Send_Reply').attr('disabled',false);
              });
            }
          }
        });
    })
  });
</script>