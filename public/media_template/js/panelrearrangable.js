$(function(){
  
  if ($('[data-panelrearrangable="true"]').length > 0) { 
    $('[data-panelrearrangable="true"]').sortable({
        handle: ".panel-heading"  
    });
   } 
})