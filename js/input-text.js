jQuery(document).ready(function()
{
    jQuery(".hoverText").focus(function(srcc)
    {
        if (jQuery(this).val() == jQuery(this)[0].title)
        {
            jQuery(this).removeClass("hoverTextActive");
            jQuery(this).val("");
        }
    });
    
    jQuery(".hoverText").blur(function()
    {
        if (jQuery(this).val() == "")
        {
            jQuery(this).addClass("hoverTextActive");
            jQuery(this).val(jQuery(this)[0].title);
        }
    });
    
    jQuery(".hoverText").blur();        
});