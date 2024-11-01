<script type="text/javascript">
  
  var cc=0;
  function crcallCancel(id)
  {//cancel call request
  //alert(id);
	  if(cc==0)
	  {
		  //document.getElementById("called"+id).style.color = "red";
		  var cnf=confirm("Really want to cancel ?");
		  if(cnf)
		  {
		  crresponseUpdate(id,'cancel');
		  cc=1; 
          }		  
	  }
	  else
	  {
		  //document.getElementById("called"+id).style.color = "green";
		  var cnf=confirm("Did you call the person ?");
		  if(cnf)
		  {
		  crresponseUpdate(id,'done');
		  cc=0;
		  }
	  }
  }
  var cd=1;
  function crcallDone(id)
  {//call request accepted
	  if(cd==1)
	  {
		  //document.getElementById("called"+id).style.color = "green";
		  var cnf=confirm("Did you call the person ?");
		  if(cnf)
		  {
		   crresponseUpdate(id,'done');
		   cd=0;
		  }
	  }
	  else
	  {
		  //document.getElementById("called"+id).style.color = "red";
		  var cnf=confirm("Really want to cancel ?");
		  if(cnf)
		  {
		   crresponseUpdate(id,'cancel');
		   cd=1; 
		  }
	  }
  }
  function crremoveCallRequest(id)
  {//remove call request
	  //document.getElementById("record"+id).style.display="none";
	  var cnf=confirm("Are you sure about removing this person from list ?");
		  if(cnf)
		  {
	  crresponseUpdate(id,'del');
	      }
  }
  function crresponseUpdate(id,type)
  {
	var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     //alert(this.responseText);
	 if(this.responseText==1)
	 {
		 if(type=='del')
		 {document.getElementById("record"+id).style.display="none";}
	     if(type=='done')
	     {document.getElementById("called"+id).style.color = "green";}
	     if(type=='cancel')
		 {document.getElementById("called"+id).style.color = "red";}
	 }
    }
  };
  xhttp.open("POST", "<?php echo admin_url('admin-ajax.php'); ?>", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("action=crresponsecallstatup&adminresponse=1"+"&id="+id+"&type="+type+"&cllrspncpwajxcsrf=<?php echo wp_create_nonce('cllrspncpwajxcsrf'); ?>");  
  }
  
  jQuery(document).ready(function($){
    $('[data-toggle="tooltip"]').tooltip(); 
      });
  </script>
 <br>
<div class="container-fluid wpcr">
<div class="row">
<div class="col-sm-12">  
<div class="panel panel-primary wpcrpanel">
<div class="panel-heading"><h3>Call Request List</h3></div>
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped">
    <thead>
      <tr class="info">
		<th>Req. Id</th>
        <th>Name</th>
        <th>Phone</th>
		<th>Email</th>
        <th>Message</th>
		<th>Form Time</th>
        <th>To Time</th>
		<th>Request Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
	
      
	  <?php global $wpdb;$table=$wpdb->prefix.'cll_response_records'; ?>
	  <?php 
	  if(isset($_GET['wpcrpagecount']))
	  {
		  $wpcridin=sanitize_text_field($_GET['wpcrpagecount']);
		  $sql="select * from ".$table." where id <%d order by id desc";
	   $records=$wpdb->get_results($wpdb->prepare($sql,array($wpcridin)));
	  }
	  else
	  {
		$sql="select * from ".$table." order by id desc";
	   $records=$wpdb->get_results($sql);  
	  }
       
	   $wpcrcount=0;
	   $pid=0;
	   foreach($records as $data)
	   {   $wpcrcount++;
		   $pid=(int)$data->id;
		   $id=$pid;
		   
		   $rrow="record".(string)$id;
		   $cllv="called".(string)$id;
		   
		   $cll_done="crcallDone(".$id.")";
		   $cll_del="crremoveCallRequest(".$id.")";
		   $cll_cncl="crcallCancel(".$id.")";
		   
		   $action="<i id='".esc_attr($cllv)."' class='fas fa-phone-alt' style='color:red;font-size:20px;cursor: pointer;' onclick='".esc_js($cll_done)."' data-toggle='tooltip' title='Call back complete or not'></i><i class='fas fa-trash-alt' style='font-size:20px;margin-left:10px;cursor: pointer;' onclick='".esc_js($cll_del)."' data-toggle='tooltip' title='Remove From List'></i>";
		   if($data->action=='1')
		   {
			$action="<i id='".esc_attr($cllv)."' class='fas fa-phone-alt' style='color:green;font-size:20px;cursor: pointer;' onclick='".esc_js($cll_cncl)."' data-toggle='tooltip' title='Call back complete or not'></i>
<i class='fas fa-trash-alt' style='font-size:20px;margin-left:10px;cursor: pointer;' onclick='".esc_js($cll_del)."' data-toggle='tooltip' title='Remove From List'></i>";   
		   }
		   
		   echo "<tr id='".esc_attr($rrow)."'>";
		   echo "<td>".esc_html($data->id)."</td>";
		   echo "<td>".esc_html($data->name)."</td>";
		   echo "<td>".esc_html($data->number)."</td>";
		   echo "<td>".esc_html($data->email)."</td>";
		   echo "<td>".esc_html($data->comment)."</td>";
		   echo "<td>".esc_html($data->frmtime)."</td>";
		   echo "<td>".esc_html($data->totime)."</td>";
		   echo "<td>".esc_html($data->recorded)."</td>";
		   echo "<td>".$action." </td>";
		   echo "</tr>";
		   if($wpcrcount==10)
		   {
			   
			   break;
		   }
	   }
	  ?>
	 
	  </tbody>
	  </table>
<ul class="pager">
	  
	<?php
if(isset($_GET['wpcrpagecount']))
 {
?>
  <script type="text/javascript">
function goBack() {
    window.history.back();
}
</script>
  <li class="previous" onclick="goBack()"><a style="cursor:pointer"><button type="submit" class="btn btn-primary" style="float: left; margin:8px; width: 10%;" >Previous</button></a></li>
 <?php } ?> 
 
 <?php
if($wpcrcount==10)
 {
?>
 
<li ><a href="<?php echo esc_url($_SERVER['http_host'].$_SERVER['REQUEST_URI'].'&wpcrpagecount='.$pid); ?>"><button type="submit" class="btn btn-primary" style="float: right; margin:8px; width: 10%;" >Next</button></a></li>

 <?php } ?>
 </ul>
 	  </div>

 </div></div></div></div></div>
<style>
.scrolling-wrapper {
  overflow-x: scroll;
  overflow-y: hidden;
  white-space: nowrap;
}
  .card {
    display: inline-block;
  }
 .wpcrpanel .panel-heading
 {
    background:linear-gradient(#2c333a,#2c333a);
 }	
 .wpcr h3
 {
	 margin:0px;
    color: #fff;
padding: 8px;
 }
 .wpcr .wpcrpanel{border:1px solid #2c333a;}
 
</style>
<span style="right:0px;bottom:40px;position:absolute;"><a href="https://teknikforce.com" target="_BLANK"><img src="<?php echo esc_url(plugins_url("asset/img/logo.jpg",__FILE__)); ?>" style="max-height:40px;max-width:150px"></a></span>