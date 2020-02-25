$(document).on('ready', function() {
  $('table').closest('.card').each(function(index, card) {
    const $card = $(card);

    const $checkboxes = $card.find('.checkbox_js');
    const $widget_checkboxes = $card.find('.widget_checkbox_js');
    const $widget_all_checkboxes = $card.find('.widgets_select_all_js');

    if($widget_checkboxes.length > 0) {
      count_checked_length($widget_checkboxes) === $widget_checkboxes.length 
        && !$widget_all_checkboxes.is(':checked') 
        && $widget_all_checkboxes.trigger('click');
    } else {
      const $view_checkboxes = $card.find('.view_checkbox_js');
      const $edit_checkboxes = $card.find('.edit_checkbox_js');
      const $create_checkboxes = $card.find('.create_checkbox_js');
      const $delete_checkboxes = $card.find('.delete_checkbox_js');
    
      const $view_all_checkboxes = $card.find('.view_checkbox_all_js');
      const $edit_all_checkboxes = $card.find('.edit_checkbox_all_js');
      const $create_all_checkboxes = $card.find('.create_checkbox_all_js');
      const $delete_all_checkboxes = $card.find('.delete_checkbox_all_js');
  
      check_length_and_trigger($checkboxes, $card.find('.select_all_js'));
      check_length_and_trigger($view_checkboxes, $view_all_checkboxes);
      check_length_and_trigger($edit_checkboxes, $edit_all_checkboxes);
      check_length_and_trigger($create_checkboxes, $create_all_checkboxes);
      check_length_and_trigger($delete_checkboxes, $delete_all_checkboxes);
    }
  })
});

function selectAll($checkboxes) {
  $checkboxes.each(function(index, checkbox) {
    const $checkbox = $(checkbox);
    !$checkbox.is(':checked') && $checkbox.prop('checked', true);
  });
};

function deselectAll($checkboxes) {
  $checkboxes.each(function(index, checkbox) {
    const $checkbox = $(checkbox);
    $checkbox.is(':checked') && $checkbox.prop('checked', false);
  });
};

function selectAllChecked($select_all_checkbox) {
  !$select_all_checkbox.is(':checked') && $select_all_checkbox.prop('checked', true);
};

function deselectAllChecked($select_all_checkbox) {
  $select_all_checkbox.is(':checked') && $select_all_checkbox.prop('checked', false);
};

function count_checked_length($checkboxes) {
  return $checkboxes.filter(function(index, checkbox) {
    return $(checkbox).is(':checked')
  }).length;
};

function has_class_select(checkbox_length, $has_access) {
  if(checkbox_length !== 0 && !$has_access.is(':checked')) {
    $has_access.trigger('click');
  } else if(checkbox_length === 0 && $has_access.is(':checked')) {
    $has_access.trigger('click');
  }
}

function check_length_and_trigger($checkboxes, $all_checked) {
  if(count_checked_length($checkboxes) === $checkboxes.length) {
    !$all_checked.is(':checked') && $all_checked.trigger('click')
  }
}



$('body').on('change', '.widgets_select_all_js', function(ev) {
  const $target = $(ev.target);
  const $card = $target.closest('.card');
  const $tbody = $($card.find('tbody')[0]);
  const $checkboxes = $tbody.find('.widget_checkbox_js');
  if($target.is(':checked')) {
    selectAll($checkboxes);
  } else {
    deselectAll($checkboxes);
  }
});

$('body').on('change', '.widget_checkbox_js', function(ev) {
  const $target = $(ev.target);
  const $tbody = $target.closest('tbody');
  const $checkboxes = $tbody.find('.widget_checkbox_js');
  const $select_all_checkbox = $target.closest('.card').find('.widgets_select_all_js');
  const checked_length = count_checked_length($checkboxes);
  if(checked_length === $checkboxes.length) {
    selectAllChecked($select_all_checkbox)
  } else {
    deselectAllChecked($select_all_checkbox)
  }
});

$('body').on('change', '.select_all_js', function(ev) {
  const $target = $(ev.target);
  const $card = $target.closest('.card');
  const $tbody = $card.find('tbody');
  const $has_access = $card.find('.has_access');
  const $table = $($card.find('table')[0]);
  const $checkboxes_table = $table.find('input[type="checkbox"]');
  if($target.is(':checked')) {
    selectAll($checkboxes_table);
  } else {
    deselectAll($checkboxes_table);
  }

  has_class_select(count_checked_length($tbody.find('input[type="checkbox"]')), $has_access)  
});

$('body').on('change', 'tbody .checkbox_js', function(ev) {
  const $target = $(ev.target);
  const $card = $target.closest('.card');
  const $tbody = $target.closest('tbody');
  const $checkboxes_body = $tbody.find('.checkbox_js');
  const $select_all_checkbox = $card.find('.select_all_js');
  const checked_length = count_checked_length($checkboxes_body);
  const $has_access = $card.find('.has_access');
  if(checked_length === $checkboxes_body.length) {
    selectAllChecked($select_all_checkbox)
  } else {
    deselectAllChecked($select_all_checkbox)
  }

  has_class_select(count_checked_length($tbody.find('input[type="checkbox"]')), $has_access)

  const _view = $target.hasClass('view_checkbox_js');
  const _edit = $target.hasClass('edit_checkbox_js');
  const _create = $target.hasClass('create_checkbox_js');
  const _delete = $target.hasClass('delete_checkbox_js');

  const $view_checkboxes = $card.find('.view_checkbox_js');
  const $edit_checkboxes = $card.find('.edit_checkbox_js');
  const $create_checkboxes = $card.find('.create_checkbox_js');
  const $delete_checkboxes = $card.find('.delete_checkbox_js');

  const $view_all_checkboxes = $card.find('.view_checkbox_all_js');
  const $edit_all_checkboxes = $card.find('.edit_checkbox_all_js');
  const $create_all_checkboxes = $card.find('.create_checkbox_all_js');
  const $delete_all_checkboxes = $card.find('.delete_checkbox_all_js');

  if(!$target.is(':checked')) {
    $target.closest('td').nextAll('td').each(function(index, td) {
      $(td).find('input').is(':checked') && $(td).find('input').trigger('click');
    })
  }

  if($target.is(':checked')) {
    $target.closest('td').prevAll('td').each(function(index, td) {
      !$(td).find('input').is(':checked') && $(td).find('input').trigger('click');
    })
  }

  if(_view) {
    if(count_checked_length($view_checkboxes) === $view_checkboxes.length) {
      $view_all_checkboxes.prop('checked', true);
    } else {
      $view_all_checkboxes.prop('checked', false);
    }
  }

  if(_edit) {
    // count_checked_length($view_checkboxes) === $view_checkboxes.length ? $card.find('.view_checkbox_all_js').prop('checked', true) : $card.find('.view_checkbox_all_js').prop('checked', false);
    if(count_checked_length($edit_checkboxes) === $edit_checkboxes.length) {
      $edit_all_checkboxes.prop('checked', true)
      !$view_all_checkboxes.is(':checked') && $view_all_checkboxes.trigger('click');
    } else {
      $edit_all_checkboxes.prop('checked', false);
    }
  }

  if(_create) {
    if(count_checked_length($create_checkboxes) === $create_checkboxes.length) {
      $create_all_checkboxes.prop('checked', true)
      !$view_all_checkboxes.is(':checked') && $view_all_checkboxes.trigger('click')
      !$edit_all_checkboxes.is(':checked') && $edit_all_checkboxes.trigger('click')
    } else {
      $create_all_checkboxes.prop('checked', false);
    }
  }

  if(_delete) {
    if(count_checked_length($delete_checkboxes) === $delete_checkboxes.length) {
      $delete_all_checkboxes.prop('checked', true)
      !$view_all_checkboxes.is(':checked') && $view_all_checkboxes.trigger('click')
      !$edit_all_checkboxes.is(':checked') && $edit_all_checkboxes.trigger('click')
      !$create_all_checkboxes.is(':checked') && $create_all_checkboxes.trigger('click')
    } else {
      $delete_all_checkboxes.prop('checked', false);
    }
  }
});

function selectColumn($target, $tbody, all_name, name) {
  if($target.hasClass(all_name)) {
    if($target.is(':checked')) {
      $tbody.find(name).each(function(index, checkbox) {
        const $checkbox = $(checkbox);
        !$checkbox.is(':checked') && $checkbox.trigger('click');
      });
    } else {
      $tbody.find(name).each(function(index, checkbox) {
        const $checkbox = $(checkbox);
        $checkbox.is(':checked') && $checkbox.trigger('click');
      });
    }
  }
}

$('body').on('change', 'thead .select_column_js', function(ev) {
  const $target = $(ev.target);
  const $thead = $target.closest('thead');
  const $tbody = $target.closest('table').find('tbody');
  const $checkboxes_head = $thead.find('.select_column_js');
  
  const $select_all_checkbox = $target.closest('.card').find('.select_all_js');
  const checked_length = count_checked_length($checkboxes_head);
  selectColumn($target, $tbody, 'view_checkbox_all_js', '.view_checkbox_js')
  selectColumn($target, $tbody, 'edit_checkbox_all_js', '.edit_checkbox_js')
  selectColumn($target, $tbody, 'create_checkbox_all_js', '.create_checkbox_js')
  selectColumn($target, $tbody, 'delete_checkbox_all_js', '.delete_checkbox_js')

  if(checked_length === $checkboxes_head.length) {
    selectAllChecked($select_all_checkbox)
  } else {
    deselectAllChecked($select_all_checkbox)
  }

  if($target.hasClass('delete_checkbox_all_js') && $target.is(':checked')) {
    !$select_all_checkbox.is(':checked') && $select_all_checkbox.trigger('click');
  }
});

