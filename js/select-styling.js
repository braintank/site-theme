(function(jQuery){
 jQuery.fn.extend({
 
 	customStyle : function(options) {
	  if(!jQuery.browser.msie || (jQuery.browser.msie&&jQuery.browser.version>6)){
	  return this.each(function() {
	  
			var currentSelected = jQuery(this).find(':selected');
			jQuery(this).after('<span class="customStyleSelectBox"><span class="customStyleSelectBoxInner">'+currentSelected.text()+'</span></span>').css({position:'absolute', opacity:0,fontSize:jQuery(this).next().css('font-size')});
			var selectBoxSpan = jQuery(this).next();
			var selectBoxWidth = parseInt(jQuery(this).width()) - parseInt(selectBoxSpan.css('padding-left')) -parseInt(selectBoxSpan.css('padding-right'));			
			var selectBoxSpanInner = selectBoxSpan.find(':first-child');
			selectBoxSpan.css({display:'inline-block'});
			selectBoxSpanInner.css({width:selectBoxWidth, display:'inline-block'});
			var selectBoxHeight = parseInt(selectBoxSpan.height()) + parseInt(selectBoxSpan.css('padding-top')) + parseInt(selectBoxSpan.css('padding-bottom'));
			jQuery(this).height(selectBoxHeight).change(function(){
				// selectBoxSpanInner.text(jQuery(this).val()).parent().addClass('changed');   This was not ideal
			selectBoxSpanInner.text(jQuery(this).find(':selected').text()).parent().addClass('changed');
				// Thanks to Juarez Filho & PaddyMurphy
			});
			
	  });
	  }
	}
 });
})(jQuery);

jQuery(function(){

jQuery('select#activity-filter-by, select#forums-order-by, select#members-order-by, #top-bar select#search-which').customStyle();

});
