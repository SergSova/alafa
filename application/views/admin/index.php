<?php $this->load->view('admin/header');?> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>
    <td>
    <div align="justify" style="padding:10px; font-size:14px; height:100%;" class="admin-int-top-bg">
    <?php if (!empty($template)): ?> 
             <?php $this->load->view('admin/'.$template);?> 
    <?php endif ?>  
	  </div>
    </td>
  </tr>
  <tr>
    <td height="100%">&nbsp;</td>
  </tr>
</table>



<?php $this->load->view('admin/footer');?>