// JavaScript Document

$(document).ready(function(){
	
	/* Data Insert Starts Here */
	$(document).on('submit', '#emp-SaveForm', function() {
	  
	   $.post("create.php", $(this).serialize())
        .done(function(data){
			$("#dis").fadeOut();
			$("#dis").fadeIn('slow', function(){
				 $("#dis").html('<div class="alert alert-info">'+data+'</div>');
			     $("#emp-SaveForm")[0].reset();
		     });	
		 });   
	     return false;
    });
	/* Data Insert Ends Here */
	
	
	/* Data Delete Starts Here */
	$(".delete-topic").click(function()
	{
		var id = $(this).attr("id");
		var del_id = id;
		var parent = $(this).parent("td").parent("tr");
		if(confirm('هل أنت متأكد أنك تريد حذف الموضوع نهائيا'))
		{
			$.post('post.php?type=delete', {'del_id':del_id}, function(data)
			{
				parent.fadeOut('slow');
			});	
		}
		return false;
	});
	/* Data Delete Ends Here */
	
	/* Data sticky Starts Here */
	$(".sticky-topic").click(function()
	{
		var id = $(this).attr("id");
		var stic_id = id;
		var parent = $(this).parent("td").parent("tr");
		if(confirm('هل أنت متأكد أنك تريد تثبيث الموضوع نهائيا'))
		{
			$.post('post.php?type=sticky', {'stic_id':stic_id}, function(data)
			{
				//parent.fadeOut('slow');
				//confirm('تم التثبيث ينجاح');
				document.location.reload(true);
			});	
		}
		return false;
	});
	/* Data sticky Ends Here */
	
	/* Data dsticky Starts Here */
	$(".dsticky-topic").click(function()
	{
		var id = $(this).attr("id");
		var dstic_id = id;
		var parent = $(this).parent("td").parent("tr");
		if(confirm('هل أنت متأكد أنك تريد إلغاء تثبيث الموضوع'))
		{
			$.post('post.php?type=dsticky', {'dstic_id':dstic_id}, function(data)
			{
				//parent.fadeOut('slow');
				//confirm('تم إلغاء التثبيث ينجاح');
				document.location.reload(true);
				
			});	
		}
		return false;
	});
	/* Data dsticky Ends Here */
	
	
	/* Data lock Starts Here */
	$(".lock-topic").click(function()
	{
		var id = $(this).attr("id");
		var lock_id = id;
		var parent = $(this).parent("td").parent("tr");
		if(confirm('هل أنت متأكد أنك تريد غلق الموضوع'))
		{
			$.post('post.php?type=lock', {'lock_id':lock_id}, function(data)
			{
				//parent.fadeOut('slow');
				//confirm('تم الغلق ينجاح');
				document.location.reload(true);
			});	
		}
		return false;
	});
	/* Data lock Ends Here */
	
	/* Data unlock Starts Here */
	$(".unlock-topic").click(function()
	{
		var id = $(this).attr("id");
		var unlock_id = id;
		var parent = $(this).parent("td").parent("tr");
		if(confirm('هل أنت متأكد أنك تريد إلغاء غلق الموضوع'))
		{
			$.post('post.php?type=unlock', {'unlock_id':unlock_id}, function(data)
			{
				//parent.fadeOut('slow');
				//confirm('تم إلغاء الغلق ينجاح');
				document.location.reload(true);
				
			});	
		}
		return false;
	});
	/* Data unlock Ends Here */
	
	
	
	
	/* Data hidd Starts Here */
	$(".hidd-topic").click(function()
	{
		var id = $(this).attr("id");
		var hidd_id = id;
		var parent = $(this).parent("td").parent("tr");
		if(confirm('هل أنت متأكد أنك تريد إخفاء الموضوع'))
		{
			$.post('post.php?type=hidd', {'hidd_id':hidd_id}, function(data)
			{
				//parent.fadeOut('slow');
				//confirm('تم الإخفاء ينجاح');
				document.location.reload(true);
			});	
		}
		return false;
	});
	/* Data hidd Ends Here */
	
	/* Data show Starts Here */
	$(".show-topic").click(function()
	{
		var id = $(this).attr("id");
		var show_id = id;
		var parent = $(this).parent("td").parent("tr");
		if(confirm('هل أنت متأكد أنك تريد إلغاء إخفاء الموضوع'))
		{
			$.post('post.php?type=show', {'show_id':show_id}, function(data)
			{
				//parent.fadeOut('slow');
				//confirm('تم إلغاء الإخفاء ينجاح');
				document.location.reload(true);
				
			});	
		}
		return false;
	});
	/* Data show Ends Here */
	
	
	
	
	
	
	/* Get Edit ID  */
	$(".edit-link").click(function()
	{
		var id = $(this).attr("id");
		var edit_id = id;
		if(confirm('Sure to Edit ID no = ' +edit_id))
		{
			$(".content-loader").fadeOut('slow', function()
			 {
				$(".content-loader").fadeIn('slow');
				$(".content-loader").load('edit_form.php?edit_id='+edit_id);
				$("#btn-add").hide();
				$("#btn-view").show();
			});
		}
		return false;
	});
	/* Get Edit ID  */
	
	/* Update Record  */
	$(document).on('submit', '#emp-UpdateForm', function() {
	 
	   $.post("update.php", $(this).serialize())
        .done(function(data){
			$("#dis").fadeOut();
			$("#dis").fadeIn('slow', function(){
			     $("#dis").html('<div class="alert alert-info">'+data+'</div>');
			     $("#emp-UpdateForm")[0].reset();
				 $("body").fadeOut('slow', function()
				 {
					$("body").fadeOut('slow');
					window.location.href="index.php";
				 });				 
		     });	
		});   
	    return false;
    });
	/* Update Record  */
});
