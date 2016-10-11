 
     
        <div id="zayavka">
        <div class="asd"><?=lang('main_user_form_zayavka')?></div>
        	<div class="pict">
            	<div class="f_tab activ" blocked="false" id="step_1">                	
                    <div class="dog"><div class="cifra active_form_tab">1</div></div>
                </div> 
                <div class="f_tab neactiv" blocked="true" id="step_2">
                    <div class="cv"><div class="cifra">2</div></div>
                    <div class="slog" style="font-size:24px">LET`S GO!</div>
                </div>
            </div>
            
            <div class="forma">
            <div class="inside"> <!--  action="#" method="post" -->
            
<script type="text/javascript">

if($('#eq_need').attr('checked')){
	$('#inp_size').show(500);
};

 $(document).ready(function() {
	 
 if($('#eq_need').attr('checked')){
	$('#inp_size').show(500);
};
	 
 if($('#more_2').attr('checked')){
	$('#inp_more_2').show(500);
};	 
	 
 //====== - - - - -  =======
    $('.onoff_param').click(function(){
    if($(this).attr('checked')){
        //$('input.delete:checkbox').attr('checked',false);
		$('#'+$(this).attr('targer_select')).show(500);
    }
    else{ 
		//$('input.delete:checkbox').attr('checked',true);
		$('#'+$(this).attr('targer_select')).hide(500);
    } 
});
 
//====== - - - - -  =======

	$('.f_tab').click(function() {
		
		var blocked = $(this).attr('blocked') 
		var clicked_id = $(this).attr('id'); 
		if(blocked == 'false') { 
			 $(".activ").addClass("neactiv");
		 $("#"+clicked_id).attr("blocked", "false");
		 $("#"+clicked_id).removeClass("neactiv");
		 
		 $("#"+clicked_id).addClass("activ");
		 $(".form_tab_block").hide(200);
		 $("#"+clicked_id+"_block").show(200);
		} 
		return false;
	});
	//=======================
});	
 //====== - - - - -  =======
 function show_plases_is(){ 
		if($("select[name='tour_date'] option:selected").attr("places") != ''){ 
		 $('.places_is').html($("select[name='tour_date'] option:selected").attr("places"));
      }  
 }
//====== - - - - -  =======
//------
	function order_form(){	
	 $('#button').hide(500);
	  
                $.ajax({  
                    type: "POST",  
                    url:   "/<?=lang('main_lang')?>/shop/order_done",
					// url:   serverName+"/<?=lang('main_lang')?>/shop/order_done",
					cache: false,
					data: $('#order_form_u').serialize(),
			     	 success: function(response){
				     if(response == '1'){ 
					  $(".visible_on").removeClass("visible_on");
					   $('#order_form_u')[0].reset();	
					   $(".info_try").html('OK!');
					  		$("#step_2").removeClass("neactiv");
							$("#step_2").attr("blocked", "false");
							
							$(".activ").addClass("neactiv");
							$(".activ").removeClass("activ");
							$("#step_2").addClass("activ");
							
							$(".form_tab_block").hide(200);
							$("#step_2_block").show(200);
							$('#button').show(500);
					 // alert('готово');
					  $(".info_try").html('');
					  $('.info_try').hide(500); 
					 }
					 else{  
					$('#button').show(500);
						 $(".info_try").html(response);
						 $('.info_try').show(800); 
					 }
						}				
                });  
	}
//************************************************	
	function load_tour_dates_q_00000(){	 
                $.ajax({  
				// /<?=lang('main_lang')?>
                    type: "POST",  
                    url:   "/<?=lang('main_lang')?>/shop/data_load_tour_dates",
					cache: false,
					data: { id: $("#tour").val()},
			     	success: function(response){ 
						$("#tour_date").html(response); 
						}				
                }); 
				return false; 
	}	
//************************************************
</script>
<script type="text/javascript" > 
function load_tour_dates_q() {
	
	window.location.hash = "mytour"+$("#tour").val();
	
 $('.places_is').html('');
		$.post("<?=base_url()?><?=lang('main_lang')?>/shop/data_load_tour_dates/", {id: ""+$("#tour").val()+""}, function(data) {    
	 
			$('#tour_date').html(data); // Fill the suggestions box
		});
	 
}

//preventSelection(document); // blockiruet copy
</script>
<div id="step_1_block" class="form_tab_block visible_on">
  <form enctype="multipart/form-data"  id="order_form_u" name="order_form_u" onsubmit="order_form(this); return false"> 
    <div class="sdf"><?=lang('main_user_form_zayavka_zapolni')?></div> 
    <div class="ins">
      
      <div class="fio">
        <ul>
          
          <li><?=lang('main_user_viberite_tur')?> * 
         <?php $tours = $this->model_user_shop->load_tours(); ?>
            <select id="tour" name="tour" onchange="load_tour_dates_q(this)"> 
            <option value="" selected="selected"  required ><?=lang('main_user_viberite_tur')?> </option>
             <?php if (!empty($tours)): ?>
				  <?php foreach($tours as $tour):?> 
                  <option value='<?=$tour['id']?>' ><?=$tour['menu_name']?></option>
             <?php  endforeach ?><?php endif ?> 
             </select>   
 
</li>
                   <li><?=lang('main_user_viberite_tur_data')?> * <select id="tour_date" name="tour_date" onchange="show_plases_is(this);">
                   <option value="" selected="selected" ><?=lang('main_user_snachala_viberi_tur')?> </option>
                   </select>
                     <div class="places_is"></div>
                   </li> 
                   <li class="comments"><br><?=lang('main_user_osobie_pozhelania')?> <textarea name="comments" ></textarea> </li>
                   
                   <li><?=lang('main_form_surname')?> *  <input name="surname" type="text" value=""  /> </li>
          <li><?=lang('main_form_name')?> * <input name="name" type="text"  value="" />
          <input name="byfather" type="hidden" value="" /> </li> 
          <li><?=lang('main_enter_email')?> * <input name="email" type="text" value=""  /></li>
          
                   <!--<li><br><?=lang('main_user_skolko_chelovek')?>*  
                   <input name="people" type="text" value=""  /> </li> -->
          </ul>
        </div>
        
        <div class="fio">
        <ul>
   <!--       <li><?=lang('main_user_ekipirovka')?> * <br> 
           <label><input name="equipment" type="radio" value="1" id="eq_need" onclick="$('#inp_size').show(500);" /><?=lang('main_user_need_ekip')?> </label><br>
          <label><input name="equipment" type="radio" value="2" onclick="$('#inp_size').hide(500); $('#inp_size input').val('');" checked="checked"  /><?=lang('main_user_i_need_ekip')?>  </label>
      <br>    
</li>
                   <li id="inp_size" style="display:none;" ><br><?=lang('main_user_razmer_odezhdy')?> <input name="size" type="text" value="" /></li> 
                    -->
                    <input name="equipment" type="hidden" value="1" />
                    <input name="size" type="hidden" value="-" />
                   <li style="height:auto;"><br><?=lang('main_user_will_more_2_skolko')?> * <br> 
                   <label><input name="more_2" type="radio" value="2" id="more_2" onclick="$('#inp_more_2').show(500);" /><?=lang('main_user_will_more_2')?> </label><br>
          <label><input name="more_2" type="radio" value="1" onclick="$('#inp_more_2').hide(500); $('#inp_more_2 input').val('');" checked="checked"  /><?=lang('main_user_will_more_2_ya_odin')?>  </label>
      <br>    
</li>
                   <li id="inp_more_2" style="display:none;" ><br><?=lang('main_user_skolko_chelovek')?>* <!--<textarea name="people" ></textarea> -->
                   <input name="people" type="text" value="" /> </li>
                   <!--<li class="comments"><br><?=lang('main_user_osobie_pozhelania')?> <textarea name="comments" ></textarea> </li> -->
                   <li><?=lang('main_form_country')?> * <input name="country" type="text"  value="" /></li>
          <li><?=lang('main_form_town')?> * <input name="town" type="text" value=""  /></li>
          <li><?=lang('main_pay_and_shipping_enter_phone')?> * 
            <input name="phone" type="text" value=""   required  /></li>
            
                   <li class="know_from"><br><?=lang('main_user_otkuda_o_nas_uznali')?>* <textarea name="know_from" ></textarea> </li>
                   
                   
                   
          </ul>
          <br clear="all">
        </div>
        <div class="clear"></div>
<!--<div class="fio">
  <ul>
          
          </ul>
      </div> -->
  <!--    <div class="fio">
        <ul>
          
            
          </ul>
        </div> -->
        
        <br clear="all">
      </div>
    <div class="insdown">
      <div class="obyaz"> <span><?=lang('main_info_form_vse_polya_obyazatelny')?> </span>
       <div class="clear"></div>
        <div class="info_try fl"></div>
        <div class="clear"></div>
      </div>
      <div class="dalee clear" id="button" onclick="order_form();"><?=lang('main_user_dalee')?> </div>
      </div>
  </form>
</div><!-- /step_1_block -->

<div id="step_2_block" class="form_tab_block"><?php if (isset($blocks[7]) && $blocks[7]!='' && $blocks[7]['text']!=''){ ?> 
               <?=$blocks[7]['text']?> 
                <?php } ?></div> 
            </div><!-- / inside -->
            <div class="clear"></div>
            </div> <!-- /forma -->
          <div class="clear"></div>
      </div>
<br clear="all">
 
 <script>
 var url = window.location.href,
    hash = url.split('#')[1];

if (hash) {
   // alert(hash);
	var pos = hash.indexOf('mytour-');
	//alert(pos);
	//alert(' # mytour- in URL');
		if( pos >= 0) { //alert(' # tour in URL');
		 tour_arr = hash.split('-'); 
		// alert(tour_arr);
		//  alert('value must = '+tour_arr[1]); 
		  $("#tour [value='"+tour_arr[1]+"']").attr("selected", "selected");
		  
		  $.post("<?=base_url()?><?=lang('main_lang')?>/shop/data_load_tour_dates/", {id: ""+tour_arr[1]+""}, function(data) {   
			$('#tour_date').html(data);  
			});
		
		}
	
	
} else {
    // do something else
	// alert('something else');
}
 
 
 
 
 </script>	 