const selectProductModalInit = function () {
  const search = $('#search-product');
  const brands = $('#brand_select');
  const categories = $('#category_select');

  if($('.search_option_js').val() === 'general') {
      brands.removeClass('d-inline');
      brands.addClass('d-none');
      categories.removeClass('d-inline');
      categories.addClass('d-none');
      search.removeClass('d-none');
      search.addClass('d-inline');
      search.val('');
      var value = '';
      $("ul.all-list .option-elm-modal").filter(function() {
        $(this).find('div.searchable').data('name') && $(this).toggle($(this).find('div.searchable').data('name').toLowerCase().indexOf(value) > -1)
      });
  } else if($('.search_option_js').val() === 'brand') {
    search.removeClass('d-inline');
    search.addClass('d-none');
    categories.removeClass('d-inline');
    categories.addClass('d-none');
    brands.removeClass('d-none');
    brands.addClass('d-inline');
    $(brands.find('option')[0]).prop('selected', true);
    var value = '';
    $("ul.all-list .option-elm-modal").filter(function() {
      $(this).find('div.searchable').data('name') && $(this).toggle($(this).find('div.searchable').data('name').toLowerCase().indexOf(value) > -1)
    });
  } else if($('.search_option_js').val() === 'category') {
    search.removeClass('d-inline');
    search.addClass('d-none');
    brands.removeClass('d-inline');
    brands.addClass('d-none');
    categories.removeClass('d-none');
    categories.addClass('d-inline');
    $(categories.find('option')[0]).prop('selected', true)
    var value = '';
    $("ul.all-list .option-elm-modal").filter(function() {
      $(this).find('div.searchable').data('name') && $(this).toggle($(this).find('div.searchable').data('name').toLowerCase().indexOf(value) > -1)
    });
  }
}

$("body").on('click', '.select-products, .select_product_for_url_js', function (ev) {
  let arr = [];
  const action = $(ev.target).data('action');
  const url = action ? action : "/admin/get-stocks";
  $(".get-all-products-tab")
      .children()
      .each(function () {
          arr.push($(this).attr("data-id"));
      });
      console.log(action)
  AjaxCall(url, {arr: arr, promotion: 0}, function (res) {
      if (!res.error) {
          $("#productsModal .modal-body .all-list").empty();
          res.data.forEach(item => {
            let categories_ids = '-';
            item.categories && item.categories.map((cat) => {
              categories_ids = categories_ids + cat.id + '-';
            })
            let html = `<li data-id="${item.id}" class="option-elm-modal">
                          <div class="btn btn-primary add-related-event searchable" data-name="${item.name}" data-brand-id="${item.brand_id}" data-categories-ids="${categories_ids}"
                            data-id="${item.id}" data-product-url="${item.page_link}"><input type="checkbox" class="select_product_js"/>
                          </div>
                          <a href="#">${item.name}</a>
                        </li>`;
            $("#productsModal .modal-body .all-list").append(html);
          });
          $('#category_select').append(`<option value="" disabled selected>Select Category</option>`)
          res.categories.forEach(category => {
            let html = `<option value="${category.id}">${category.name}</option>`;
            $('#category_select').append(html)
          });
          $('#brand_select').append(`<option value="" disabled selected>Select Brand</option>`)
          res.brands.forEach(brand => {
            let html = `<option value="${brand.id}">${brand.name}</option>`;
            $('#brand_select').append(html)
          });
          selectProductModalInit();
          if($(ev.target).hasClass('select_product_for_url_js')) {
            console.log(1111)
            $(".all_select_products_js").closest('div').removeClass('d-flex');
            $(".all_select_products_js").closest('div').addClass('d-none');
            $("#productsModal").attr('data-url', 'url');
            $("#productsModal").attr('data-url-key', $(ev.target).data('key'));
          } else {
            $(".all_select_products_js").closest('div').removeClass('d-none');
            $(".all_select_products_js").closest('div').addClass('d-flex');
            $("#productsModal").attr('data-url', '');
            $("#productsModal").attr('data-url-key', '');
          }
          $("#productsModal").modal();
      }
  });
});

$('body').on('change', '.all_select_products_js', function(ev) {
  let flag;

  $(ev.target).prop('checked') ? (flag = true) : (flag = false);
  $('.all-list').find('.select_product_js').each(function(index, product) {
    const $product = $(product);
    flag ? $product.prop('checked', true) : $product.prop('checked', false);
  });
});

$('body').on('change', '.select_product_js', function(ev) {
  let flag = 0;
  const length = $('.select_product_js').length;
  if($(ev.target).closest("#productsModal").attr("data-url") === "url") {
    console.log(444)
    $('.select_product_js').each(function(index, product) {
      const $product = $(product);
      product !== ev.target && $product.prop('checked', false);
    });
  } else {
    $('.select_product_js').each(function(index, product) {
      const $product = $(product);
      if($product.prop('checked')) {
        flag += 1;
      }
    });
    if(flag < length) {
      $('.all_select_products_js').prop('checked', false);
    } else if(flag === length) {
      $('.all_select_products_js').prop('checked', true);
    }
  }
});

$('body').on('change', '.search_option_js', function() {
  selectProductModalInit();
});

$("body").on("keyup", '.search-attr', function() {
  console.log($(this).val())
  var value = $(this).val().toLowerCase();
  $("ul.all-list .option-elm-modal").filter(function() {
    $(this).find('div.searchable').data('name') && $(this).toggle($(this).find('div.searchable').data('name').toLowerCase().indexOf(value) > -1)
  });
});

$('body').on('change', '#brand_select', function() {
  var value = $(this).val();
  $("ul.all-list .option-elm-modal").filter(function() {
    console.log(Number($(this).find('div.searchable').data('brand-id')), Number(value))
    $(this).find('div.searchable').data('brand-id') && $(this).toggle(Number($(this).find('div.searchable').data('brand-id')) === Number(value))
  });
});

$('body').on('change', '#category_select', function() {
  var value = $(this).val();
  $("ul.all-list .option-elm-modal").filter(function() {
    $(this).find('div.searchable').data('categories-ids') && $(this).toggle($(this).find('div.searchable').data('categories-ids').indexOf('-' + value + '-') > -1)
  });
});


$("body").on('click', '.select-stickers', function () {
  let arr = [];
  $(".get-all-stickers-tab")
      .children()
      .each(function () {
          arr.push($(this).attr("data-id"));
      });
  AjaxCall("/admin/tools/stickers/get-all", {arr}, function (res) {
      if (!res.error) {
          $("#stickerModal .modal-body .all-list").empty();
          res.data.forEach(item => {
              let html = `<li data-id="${item.id}" class="option-elm-modal">
                            <div class="btn btn-primary add-related-event searchable" data-name="${item.name}"
                              data-id="${item.id}"><input type="checkbox" class="select_product_js"/>
                            </div>
                            <a href="#">${item.name}</a>
                          </li>`;
              // let html = `<li data-id="${item.id}" class="option-elm-modal"><a
              //                         href="#">${item.name}
              //                         </a> <a class="btn btn-primary add-related-event searchable" data-name="${item.name}"
              //                         data-id="${item.id}">ADD</a></li>`;
              $("#stickerModal .modal-body .all-list").append(html);
          });
          $("#stickerModal").modal();
      }
  });
});


$("body").on("click", ".done_select_product_js", function (ev) {
  if($(ev.target).data('ajax')) {
    const products = [];
    const table = $('#stocks-table').DataTable();
    const shop_id = $('#current-shop').val()
    $('#productsModal .select_product_js').each(function(index, product) {
      if($(product).prop('checked')) {
          const id = $(product).closest('.add-related-event').data('id');
          const name =  $(product).closest('.add-related-event').data('name');
          products.push(id)
          // $(".get-all-products-tab")
          // .append(`<li style="display: flex" data-id="${id}" class="option-elm-attributes"><a
          //             href="#">${name}</a>
          //             <div class="buttons">
          //             <a href="javascript:void(0)" class="remove-all-attributes btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
          //             </div>
          //             <input type="hidden" name="related_products[]" value="${id}" />
          //             </li>`);
          
      }
    })
    AjaxCall("/admin/app/products/add-product", {products, shop_id}, function (res) {
      if (!res.error) {
          $("#productsModal .modal-body .all-list").empty();
          table.ajax.reload();
          // res.data.forEach(item => {
          //     let html = `<li data-id="${item.id}" class="option-elm-modal">
          //                   <div class="btn btn-primary add-related-event searchable" data-name="${item.name}"
          //                     data-id="${item.id}"><input type="checkbox" class="select_product_js"/>
          //                   </div>
          //                   <a href="#">${item.name}</a>
          //                 </li>`;
             
          //     $("#stickerModal .modal-body .all-list").append(html);
          // });
          // $("#stickerModal").modal();
      }
    });
  } else {
    if($('#productsModal').attr('data-url') !== 'url') {
      $('#productsModal .select_product_js').each(function(index, product) {
        if($(product).prop('checked')) {
            const id = $(product).closest('.add-related-event').data('id');
            const name =  $(product).closest('.add-related-event').data('name');
            $(".get-all-products-tab")
            .append(`<li style="display: flex" data-id="${id}" class="option-elm-attributes"><a
                        href="#">${name}</a>
                        <div class="buttons">
                        <a href="javascript:void(0)" class="remove-all-attributes btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        </div>
                        <input type="hidden" name="related_products[]" value="${id}" />
                        </li>`);
        }
      })
    } else {
      $('#productsModal .select_product_js').each(function(index, product) {
        if($(product).prop('checked')) {
            const id = $(product).closest('.add-related-event').data('id');
            const product_url =  $(product).closest('.add-related-event').data('product-url');
            const key = $('#productsModal').attr('data-url-key');
  
            $(`.other_images-item[data-key="${key}"]`).length !== 0 
              ? $(`.other_images-item[data-key="${key}"]`)
                  .find('.product_id_hidden_js').val(id)
              : $(`.banner-item[data-key="${key}"]`)
                  .find('.product_id_hidden_js').val(id);
            
            $(`.other_images-item[data-key="${key}"]`).length !== 0 
            ? $(`.other_images-item[data-key="${key}"]`)
                .find('.url_feald').val(product_url)
            : $(`.banner-item[data-key="${key}"]`)
                .find('.url_feald').val(product_url);
        }
      })
    }
  }
});

$("body").on("click", ".done_select_attributes_js", function () {
  $('.select_product_js').each(function(index, product) {
    if($(product).prop('checked')) {
        const id = $(product).closest('.add-related-event').data('id');
        const name =  $(product).closest('.add-related-event').data('name');
        $(".get-all-attributes-tab")
        .append(`<li style="display: flex" data-id="${id}" class="option-elm-attributes">
                  <a href="#" class="stick--link">${name}</a>
                  <div class="buttons">
                      <a href="javascript:void(0)" class="remove-all-attributes btn btn-sm btn-danger">
                          <i class="fa fa-trash"></i></a>
                  </div>
                  <input type="hidden" name="stocks[]" value="${id}">
                </li>`)
    }
  })
});

$("body").on("click", ".done_select_stickers_js", function () {
  $('.select_product_js').each(function(index, product) {
    if($(product).prop('checked')) {
        const id = $(product).closest('.add-related-event').data('id');
        const name =  $(product).closest('.add-related-event').data('name');
        $(".get-all-stickers-tab")
                .append(`<div class="inventory-attr-item" data-id="${id}">
                              <h3 class="text">${name}</h3>
                              <button  type="button" class="btn btn-danger remove-all-attributes "><i class="fa fa-close"></i></button>
                              <input type="hidden" name="stickers[]" value="${id}">
                          </div>`);

    }
  })
});

$("body").on("click", ".remove-all-attributes", function(ev) {
  ev.stopImmediatePropagation();
  let id = $(this)
      .closest("li")
      .attr("data-id");
  $("body")
      .find(`.attributes-container-${id}`)
      .remove();
  $(this)
      .closest("li")
      .remove();
});


$('body').on('click', '.edit_price_js', function(ev) {
  const edit_button = $(ev.target);
  const id = edit_button.data('id');
  const name = edit_button.data('name');
  const price = edit_button.data('price');

    $('#editPriceModal .modal-body').html(`
    <div class="form-group row"> 
        <label class="col-md-9 col-form-label">${name}</label>
        <div class="col-md-3">
            <input type="number" class="form-control price_input" value="${price}" aria-label="Small" aria-describedby="inputGroup-sizing-sm" data-name="${name}" data-id="${id}">
        </div>
    </div>
`)
    console.log(id, name, price)
  $('#editPriceModal').modal('show');
})

$('body').on('click', '.done_edit_price_js', function() {
  const data = [];
  const table = $('#stocks-table').DataTable();
  $('#editPriceModal .price_input').each(function() {
    const price_input = $(this);
    data.push({
      id: price_input.data('id'),
      price: price_input.val()
    })
  })

  console.log(data)
  AjaxCall("/admin/app/products/multi-edit-price", {data}, function (res) {
    if (!res.error) {
        table.ajax.reload();
        $('#editPriceModal').modal('hide');
    }
  });
})
